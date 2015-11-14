package com.example.mschyb.clockingapp;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class LoginScreenActivity extends AppCompatActivity {

    public String login, password;


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        //Start the GPS Service
        //Intent intent = new Intent(getApplicationContext(), GPSTrackingService.class);
        //startService(intent);

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_screen);

        if(Config.getUserId() == 0)
        {}
        else
        {
            startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
        }

        Button loginButton = (Button) findViewById(R.id.loginButton);
        //set the onClick listener for the button
        loginButton.setOnClickListener(new View.OnClickListener() {
               @Override
               public void onClick(View v) {
                   TextView loginError = (TextView) findViewById(R.id.loginErrorBox);
                   loginError.setText(R.string.signing_into_program);

                   EditText loginET = (EditText) findViewById(R.id.editLogin);
                   EditText passwordET = (EditText) findViewById(R.id.editPassword);

                   login = loginET.getText().toString();
                   password = passwordET.getText().toString();

                   //new Utilities().checkCredentials(login, password)
                   if (new Utilities().checkCredentials(login, password))
                   {
                       Config.setUserId(2);
                       loginError.setText("Success!");
                       Intent intent = new Intent(getApplicationContext(), HomeScreenActivity.class);
                       startActivity(intent);
                   } else {
                       loginError.setText("Login or password is incorrect, please re-enter");
                   }
               }
           }
        );//end loginButton.setOnClickListener
    }

    @Override
    public void onResume() {
        super.onResume();

        if(Config.getUserId() == 0)
        {}
        else
        {
            startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_login_screen, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

}
