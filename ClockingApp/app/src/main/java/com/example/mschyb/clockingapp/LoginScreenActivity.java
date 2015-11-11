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
    public boolean isUser;


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        //Start the GPS Service
        Intent intent = new Intent(getApplicationContext(), GPSTrackingService.class);
        startService(intent);

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_screen);


        if(SaveSharedPreference.getUserName(LoginScreenActivity.this).length() == 0)
        {}
        else
        {
            // SaveSharedPreference.removeUserName(getApplicationContext());
            startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
        }

        Button loginButton = (Button) findViewById(R.id.loginButton);
        //set the onClick listener for the button
        loginButton.setOnClickListener(new View.OnClickListener() {
               @Override
               public void onClick(View v) {
                   TextView loginError = (TextView) findViewById(R.id.loginErrorBox);
                   loginError.setText("Signing in...");

                   EditText loginET = (EditText) findViewById(R.id.editLogin);
                   EditText passwordET = (EditText) findViewById(R.id.editPassword);

                   login = loginET.getText().toString();
                   password = passwordET.getText().toString();

                   if(new Utilities().checkCredentials(login, password))
                   {

                       loginError.setText("Success!");
                       Intent intent = new Intent(getApplicationContext(), HomeScreenActivity.class);
//                      // intent.putExtras(bundle);
                       startActivity(intent);
                   }
                   else
                   {
                       loginError.setText("Login or password is incorrect, please re-enter");
                   }

//
//                   new checkDatabase().execute();
//
//                   try {
//                       Thread.sleep(2000);
//                   }
//                   catch(Exception e)
//                   {}
//
//                   if (isUser == true) {
//
//                       Intent intent = new Intent(getApplicationContext(), HomeScreenActivity.class);
//                      // intent.putExtras(bundle);
//                       startActivity(intent);
//                   }
//                   else {
//                       loginError.setText("Login or password is incorrect, please re-enter");
//                   }
               }
           }
        );//end loginButton.setOnClickListener
    }
/*
    @Override
    public void onResume()
    {
        super.onResume();

        if(SaveSharedPreference.getUserName(LoginScreenActivity.this).length() == 0)
        {
            onCreate(new Bundle());

        } else
        {
             // SaveSharedPreference.removeUserName(getApplicationContext());
            startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
        }
    } */
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

//    private class checkDatabase extends AsyncTask<Void, Void, Void> {
//        protected Void doInBackground(Void... arg0)  {
//            try {
//
//                Class.forName("com.mysql.jdbc.Driver");//.newInstance();
//                Connection con = DriverManager.getConnection(database_url, database_user, database_pass);
//
//                Statement st = con.createStatement();
//
//                ResultSet rs = st.executeQuery("Select * from user where username like '" + login + "' and password_hash like '" + password + "'");
//
//                if (!rs.next() )
//                   isUser= false;
//                else {
//                    String userName = rs.getString("first_name")+" " +rs.getString("last_name");
//                    SaveSharedPreference.setUserName(getApplicationContext(), userName);
//
//                    isUser = true;
//                }
//
//            }
//            catch(Exception e)
//            {
//                e.printStackTrace();
//                isUser=false;
//            }
//
//            return null;
//        }//end database connection via doInBackground
//
//        //after processing is completed, post to the screen
//        protected void onPostExecute(Void result) {
//
//        }
//    }//end checkDatabase()

}
