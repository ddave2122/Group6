package com.example.mschyb.clockingapp;

import android.os.AsyncTask;
import android.util.Log;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import javax.net.ssl.HttpsURLConnection;

public class Transporter extends AsyncTask<String, String, String>{

    @Override
    protected String doInBackground(String... uri) {
        String responseString = null;
        try {
            URL url = new URL(uri[0]);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();


            if(uri[1] != null && uri[1].equals("POST"))


            {
                conn = (HttpURLConnection) url.openConnection();

                String urlParameters  = uri[2];
                byte[] postData       = urlParameters.getBytes( StandardCharsets.UTF_8 );

                conn.setDoOutput( true );
                conn.setInstanceFollowRedirects( false );
                conn.setRequestMethod( "POST" );
                conn.setRequestProperty( "Content-Type", "application/x-www-form-urlencoded");
                conn.setRequestProperty( "charset", "utf-8");
                conn.setRequestProperty( "Content-Length", Integer.toString(uri[2].length()));
                conn.setUseCaches( false );

                try( DataOutputStream wr = new DataOutputStream( conn.getOutputStream())) {
                    wr.write( postData );
                }
            }

            if(conn.getResponseCode() == HttpsURLConnection.HTTP_OK)
            {
                BufferedReader in =
                        new BufferedReader(new InputStreamReader(url.openStream()));
                String page = "";
                String inLine;

                while ((inLine = in.readLine()) != null) {
                    page += inLine;
                }

                in.close();
                responseString = page;
            }
            else {
                Log.e(Config.TAG, "Unable to request from url: " + uri[0]);
            }
        } catch (IOException e) {
            //TODO Handle problems..
        }
        return responseString;
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        Log.i(Config.TAG, result);
    }
}