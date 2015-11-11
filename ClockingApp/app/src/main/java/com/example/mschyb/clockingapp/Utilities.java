package com.example.mschyb.clockingapp;

import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

import org.json.JSONArray;

import java.util.ArrayList;
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
        if(jsonObject.get("authenticated").toString().equals("true"))
        {
            try
            {
                Config.setUserId(Integer.getInteger(jsonObject.get("userId").toString()));
                Config.setEastEndpoint(Double.parseDouble(jsonObject.get("eastEndpoint").toString()));
                Config.setNorthEndpoint(Double.parseDouble(jsonObject.get("northEndpoint").toString()));
                Config.setSouthEndpoint(Double.parseDouble(jsonObject.get("southEndpoint").toString()));
                Config.setWestEndpoint(Double.parseDouble(jsonObject.get("westEndpoint").toString()));
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
}
