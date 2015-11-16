package com.example.mschyb.clockingapp;

import android.util.Log;
import com.google.gson.JsonArray;
import com.google.gson.Gson;
import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.concurrent.ExecutionException;

public class Utilities
{
    public boolean checkCredentials(String username, String password)
    {

        String params = "username=" + username + "&password=" + password;
        Transporter transporter = new Transporter();
        transporter.execute(Config.CHECK_CREDENTIALS_ENDPOINT, "POST", params);

        JsonObject jsonObject = convertStringToJson(readTransporter(transporter));

        if(jsonObject == null)
        {
            Log.e(Config.TAG, "Error when trying to convert string to JSON object");
        }
        String userId = null;
        try
        {
            userId = jsonObject.get("userid").toString();
        }
        catch(NullPointerException e)
        {
            Log.e(Config.TAG, "Null pointer in json object");
        }
        if(userId != null)
        {
            try {
                Config.setUserId(Integer.parseInt(jsonObject.get("userid").toString().replace("\"", "")));
                Config.setIsManager(jsonObject.get("manager").toString().replace("\"", "").equals("1"));
                Config.setUserFirstName(jsonObject.get("firstname").toString().replace("\"", ""));
            }
            catch(Exception e) {
                return false;
            }
            try
            {
                Config.setEastEndpoint(Double.parseDouble(jsonObject.get("east").toString().replace("\"", "")));
                Config.setNorthEndpoint(Double.parseDouble(jsonObject.get("north").toString().replace("\"", "")));
                Config.setSouthEndpoint(Double.parseDouble(jsonObject.get("south").toString().replace("\"", "")));
                Config.setWestEndpoint(Double.parseDouble(jsonObject.get("west").toString().replace("\"", "")));
            }
            catch(Exception e)
            {
                Log.e(Config.TAG, "Error when trying to get values from JSON object");
            }
            return true;
        }
        else
            return false;
    }
    public HashMap<String, String[]> getSchedule(int userID, String sDate, String eDate) {
        String[] arr = new String[2];
        String params = "userId=" + userID + "&startDate=" + sDate + "&endDate=" + eDate;
        Transporter transporter = new Transporter();
        transporter.execute(Config.GET_SCHEDULE_ENDPOINT, "POST", params);

        JsonObject jsonResult = convertStringToJson(readTransporter(transporter));
        HashMap<String, String[]> resultSet = new HashMap<>();

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Result check is null");
            return null;
        }
        else
        {
            JsonArray data = jsonResult.getAsJsonArray("schedule");
            for (JsonElement el:data)
            {
                JsonObject obj=(JsonObject)el;
                String key = obj.get("startTime").toString().split(" ")[0].replace("\"", "");
                String[] clockTimes = {
                        obj.get("startTime").toString().replace("\"", "")
                        , obj.get("endTime").toString().replace("\"", "") };

                resultSet.put(key, clockTimes);
            }
        }
        return resultSet;
    }
    public List<String[]>  getHoursWorked(int userID, String sDate, String eDate) {
        List<String[]> stuff= new ArrayList<String[]>();
        String params = "userid=" + userID + "&startdate=" + sDate + "&enddate=" + eDate;
        Transporter transporter = new Transporter();
        transporter.execute(Config.GET_HOURS_ENDPOINT, "POST", params);

        JsonObject jsonResult = convertStringToJson(readTransporter(transporter));

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Result check is null");

        } else {

            //need to check for if there are no query results and return a null array
            //stuff = null;

            Set<Map.Entry<String,JsonElement>> entrySet=jsonResult.entrySet();
            for(Map.Entry<String,JsonElement> entry : entrySet){
                stuff.add(new String[]{entry.getKey(), entry.getValue().toString()});
            }

//
//            JsonArray data = jsonResult.getAsJsonArray();
//            for (JsonElement el:data)
//            {
//                JsonObject obj=(JsonObject)el;
//                stuff.add(new String[]{obj.get("date").toString(), obj.get("hours").toString() });
//            }

        }
        return stuff;

    }

    public static void clockUser(int isClockingIn)
    {
        String params = "userId=" + Config.getUserId() + "&isClockingIn=" + isClockingIn;
        Transporter transporter = new Transporter();
        transporter.execute(Config.LOG_TIME_ENDPOINT, "POST", params);
    }


    public static boolean saveGpsCoordinates(String lat, String lon, String distance)
    {
        String params = "userid=" + Config.getUserId() + "&lat=" + lat
                + "&long=" + lon + "&distance=" + distance;
        Transporter transporter = new Transporter();
        transporter.execute(Config.SET_GPS_COORDINATES, "POST", params);
        return true;
    }


    private String readTransporter(Transporter transporter)
    {
        String result = null;
        try
        {
            result = transporter.get();
        }
        catch(InterruptedException | ExecutionException e)
        {
            Log.e(Config.TAG, "Exception when trying to get result from transporter class");
        }
        return result;
    }

    private JsonObject convertStringToJson(String stringToConvert)
    {
        JsonObject jsonResult = null;
        JsonParser jsonParser = new JsonParser();
        try
        {
            jsonResult = (JsonObject)jsonParser.parse(stringToConvert);
        }
        catch (Exception e)
        {
            Log.e(Config.TAG, " JSON response cann't be read.." + stringToConvert);
        }

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Unable to convert string to JsonObject");
            return null;
        }
        return  jsonResult;
    }

    private JsonArray convertStringToJsonArray(String stringToConvert)
    {
        JsonArray jsonResult = null;
        JsonParser jsonParser = new JsonParser();
        try
        {
            jsonResult = (JsonArray)jsonParser.parse(stringToConvert);
        }
        catch (Exception e)
        {
            Log.e(Config.TAG, " JSON response cann't be read.." + stringToConvert);
        }

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Unable to convert string to JsonObject");
            return null;
        }
        return  jsonResult;
    }

    public HashMap<String, String> getUsers()
    {
        String params = "";
        Transporter transporter = new Transporter();
        transporter.execute(Config.GET_USERS_ENDPOINT, "GET", params);

        JsonArray jsonResult = convertStringToJsonArray(readTransporter(transporter));
        HashMap<String, String> resultSet = new HashMap<>();

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Result check is null");
            return null;
        }
        else
        {
            for(int i = 0; i < jsonResult.size(); i++)
            {
                Set<Map.Entry<String,JsonElement>> entrySet = jsonResult.get(i).getAsJsonObject().entrySet();
                for(Map.Entry<String,JsonElement> entry:entrySet){
                    resultSet.put(entry.getValue().toString(), entry.getKey());

                }
            }

        }
        return resultSet;
    }

}
