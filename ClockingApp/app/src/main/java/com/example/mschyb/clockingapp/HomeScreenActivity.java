package com.example.mschyb.clockingapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class HomeScreenActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home_screen);

        TextView  helloText = (TextView)findViewById(R.id.helloText);
        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));

        }
        else
        {
            String textToDisplay = "Hello " + Config.getUserFirstName();
            helloText.setText(textToDisplay);
        }


        Button clockButton = (Button) findViewById(R.id.clockButton);
        clockButton.setOnClickListener(new View.OnClickListener() {
               @Override
               public void onClick(View v) {
                   startActivity(new Intent(getApplicationContext(), ClockInOutActivity.class));
               }
           }
        );//end clockButton.setOnClickListener

        Button hoursWorkButton = (Button) findViewById(R.id.hoursWorkedButton);
        hoursWorkButton.setOnClickListener(new View.OnClickListener() {
               @Override
               public void onClick(View v) {
                   startActivity(new Intent(getApplicationContext(), HoursWorkedActivity.class));
               }
           }
        );//end hoursWorkedButton.setOnClickListener

        Button setAlarmsButton = (Button) findViewById(R.id.setAlarmsButton);
        setAlarmsButton.setOnClickListener(new View.OnClickListener() {
               @Override
               public void onClick(View v) {
                   startActivity(new Intent(getApplicationContext(), SetAlarmsActivity.class));
               }
           }
        );//end setAlarmsButton.setOnClickListener

        Button viewScheduleButton = (Button) findViewById(R.id.viewScheduleButton);
        viewScheduleButton.setOnClickListener(new View.OnClickListener() {
               @Override
               public void onClick(View v) {
                   startActivity(new Intent(getApplicationContext(), ViewScheduleActivity.class));
               }
           }
        );//end viewScheduleButton.setOnClickListener

        Button logoutButton = (Button) findViewById(R.id.logoutButton);
        logoutButton.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {
                 Config.setUserId(0);
                  Config.setUserFirstName("");
                  startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
              }
          }
        );//end viewScheduleButton.setOnClickListener

        Button setLocation = (Button) findViewById(R.id.enterAddressButton);
        setLocation.setOnClickListener(new View.OnClickListener() {
                                           @Override
                                           public void onClick(View v) {
//                                               Config.setUserId(0);
//                                               Config.setUserFirstName("");
                                               startActivity(new Intent(getApplicationContext(), EnterAddressActivity.class));
                                           }
                                       }
        );//end viewScheduleButton.setOnClickListener


        Button createScheduleButton = (Button) findViewById(R.id.createSchedule);
        createScheduleButton.setOnClickListener(new View.OnClickListener() {
                                            @Override
                                            public void onClick(View v) {
                                                startActivity(new Intent(getApplicationContext(), CreateSchedule.class));
                                            }
                                        }
        );//end viewScheduleButton.setOnClickListener


        if(Config.isManager())
        {
            setLocation.setVisibility(0);
            createScheduleButton.setVisibility(0);
        }

        else
        {
            setLocation.setVisibility(View.INVISIBLE);
            createScheduleButton.setVisibility(View.INVISIBLE);
        }

    }
    @Override
    public void onResume() {
        super.onResume();

        TextView  helloText = (TextView)findViewById(R.id.helloText);
        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
        } else
        {
            helloText.setText("Hello " + Config.getUserFirstName());
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_home_screen, menu);
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
