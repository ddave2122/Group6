package com.example.mschyb.clockingapp;

import android.util.Log;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

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

        return jsonObject.get("authenticated").toString().equals("true");
    }


    public static void clockUser(int isClockingIn)
    {
        String params = "userId=" + Config.getUserId() + "&isClockingIn=" + isClockingIn;
        Transporter transporter = new Transporter();
        transporter.execute(Config.LOG_TIME_ENDPOINT, "POST", params);
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
        JsonParser jsonParser = new JsonParser();
        JsonObject jsonResult = (JsonObject)jsonParser.parse(stringToConvert);

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Unable to convert string to JsonObject");
            return null;
        }
        return  jsonResult;
    }
    public String[] getSchedule(String userID, String date) {
     /*   String[] arr = new String[2];
        String params = "user_id=" + userID + "&schedule_clock_in" + date;
        Transporter transporter = new Transporter();
        transporter.execute(Config.GET_SCHEDULE_ENDPOINT, "POST", params);

        JsonObject jsonResult = null;
        try {
            JsonParser jsonParser = new JsonParser();
            jsonResult = (JsonObject) jsonParser.parse(transporter.get());
        } catch (InterruptedException | ExecutionException e) {
            Log.e(Config.TAG, "Error when trying to get result from Transporter");
        }

        if (jsonResult == null) {
            Log.e(Config.TAG, "Result  check is null");
            arr = null;

        } else {
            arr[0] = jsonResult.get("startTime").toString();
            arr[1] = jsonResult.get("endTime").toString();

        }
        return arr;
        */

        String arr[]={"01//02/2004 03:00:00:00","22//03/2005 22:30:00:00"};
        //String arr[]=null;
        return arr;
    }
}
