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

        JsonObject jsonResult = null;
        try
        {
            JsonParser jsonParser = new JsonParser();
            jsonResult = (JsonObject)jsonParser.parse(transporter.get());
        }
        catch(InterruptedException | ExecutionException e)
        {
            Log.e(Config.TAG, "Error when trying to get result from Transporter");
        }

        if(jsonResult == null)
        {
            Log.e(Config.TAG, "Result from credentials check is null");
            return false;
        }

        return jsonResult.get("authenticated").toString().equals("true");
    }
}
