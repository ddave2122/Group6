package com.example.mschyb.clockingapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.app.AlertDialog;
import android.content.DialogInterface;


import java.text.SimpleDateFormat;
import java.util.Calendar;


public class ClockInOutActivity extends AppCompatActivity {

    public static boolean clockOutCheck = false;


    @Override
    protected void onCreate(Bundle savedInstanceState) {


        Config.setUserIsLoggedIn(true);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_clock_in_out);

        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
        }
        else
        {}

        Button clockOutButton = (Button) findViewById(R.id.clockoutButton);
        clockOutButton.setOnClickListener(new View.OnClickListener() {


            public void onClick(View v) {

                //For testing purposes comment bottom if statement block out and uncomment these two lines
                //Utilities.clockUser(0);
                //showClockOutAlert(null);

                if (Config.isUserIsLoggedIn()) {
                    Utilities Util = new Utilities();
                    Util.clockUser(0);
                    showClockOutAlert(null);
                    clockOutCheck = true;
                    Config.setUserIsLoggedIn(false);

                } else
                    clockOutCheckAlert(null);

            }
        });
        Button clockInButton = (Button) findViewById(R.id.clockinButton);
        clockInButton.setOnClickListener(new View.OnClickListener() {

        public void onClick(View v) {

            //For testing purposes comment bottom if statement block out and uncomment these two lines
           // Utilities.clockUser(1);
            //showClockInAlert(null);


            if(clockOutCheck) {
                Utilities Util = new Utilities();
                Util.clockUser(1);
                showClockInAlert(null);
                clockOutCheck = false;
                Config.setUserIsLoggedIn(true);
            }

            else
                clockInCheckAlert(null);

        }
      });


        Button backButton = (Button) findViewById(R.id.backButton);
        //set the onClick listener for the button
        backButton.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {
                  startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
              }
          }
        );//end backButton.setOnClickListener
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_clock_in_out, menu);
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


    public void showClockOutAlert(View view){
        AlertDialog.Builder myAlert = new AlertDialog.Builder(this);
        Calendar c = Calendar.getInstance();
        System.out.println("Current time =&gt; "+c.getTime());

        SimpleDateFormat df = new SimpleDateFormat("h:mm:ss a");
        String formattedDate = df.format(c.getTime());
        myAlert.setMessage("You have successfully clocked out for lunch at " + formattedDate)
                .setPositiveButton("Continue", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();

                    }
                })
                .create();
        myAlert.show();


    }
    public void showClockInAlert(View view){
        AlertDialog.Builder myAlert = new AlertDialog.Builder(this);
        Calendar c = Calendar.getInstance();
        System.out.println("Current time =&gt; "+c.getTime());

        SimpleDateFormat df = new SimpleDateFormat("h:mm:ss a");
        String formattedDate = df.format(c.getTime());
        myAlert.setMessage("You have successfully clocked in from lunch at " + formattedDate)
                .setPositiveButton("Continue", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        dialog.dismiss();

                    }
                })
                .create();
        myAlert.show();
    }
    public void clockInCheckAlert(View view){
        AlertDialog.Builder myAlert = new AlertDialog.Builder(this);
        myAlert.setMessage("You have not clocked out for lunch yet, you must clock out for lunch first")
                .setPositiveButton("Continue", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                })
                .create();
        myAlert.show();

    }
    public void clockOutCheckAlert(View view){
        AlertDialog.Builder myAlert = new AlertDialog.Builder(this);
        myAlert.setMessage("You have not clocked in for your shift yet so you can not clock out for lunch")
                .setPositiveButton("Continue", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                })
                .create();
        myAlert.show();


    }


}
