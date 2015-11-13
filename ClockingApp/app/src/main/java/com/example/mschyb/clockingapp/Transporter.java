package com.example.mschyb.clockingapp;

import android.os.AsyncTask;
import android.util.Log;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.Reader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.util.LinkedHashMap;
import java.util.Map;


public class Transporter extends AsyncTask<String, String, String>{

    @Override
    protected String doInBackground(String... uri) {

        try
        {
            URL url = new URL(uri[0]);
            Map<String,Object> params = new LinkedHashMap<>();
            for(String item : uri[2].split("&"))
            {
                params.put(item.split("=")[0], item.split("=")[1]);
            }

            StringBuilder postData = new StringBuilder();
            for (Map.Entry<String,Object> param : params.entrySet()) {
                if (postData.length() != 0) postData.append('&');
                postData.append(URLEncoder.encode(param.getKey(), "UTF-8"));
                postData.append('=');
                postData.append(URLEncoder.encode(String.valueOf(param.getValue()), "UTF-8"));
            }
            byte[] postDataBytes = postData.toString().getBytes("UTF-8");

            HttpURLConnection conn = (HttpURLConnection)url.openConnection();
            conn.setRequestMethod(uri[1]);
            conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
            conn.setRequestProperty("Content-Length", String.valueOf(postDataBytes.length));
            conn.setDoOutput(true);
            conn.getOutputStream().write(postDataBytes);

            BufferedReader in =
                    new BufferedReader(new InputStreamReader(conn.getInputStream(), "UTF-8"));
            String page = "";
            String inLine;

            while ((inLine = in.readLine()) != null) {
                page += inLine;
            }

            in.close();

            return page;
        }
        catch(Exception e)
        {
            Log.e(Config.TAG, "Exception when trying to send request");
            Log.e(Config.TAG, e.getMessage());
            return null;
        }
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        Log.i(Config.TAG, result);
    }
}