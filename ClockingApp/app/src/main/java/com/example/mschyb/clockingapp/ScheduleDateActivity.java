package com.example.mschyb.clockingapp;

import android.content.Intent;
import android.graphics.Paint;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.text.DateFormat;
import java.text.DateFormatSymbols;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

public class ScheduleDateActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_schedule_date);

        TextView dateText = (TextView) findViewById(R.id.dateText);
        TextView startTimeText = (TextView) findViewById(R.id.startTimeText);
        TextView endTimeText = (TextView) findViewById(R.id.endTimeText);

        Button backButton = (Button) findViewById(R.id.backButton);
        //set the onClick listener for the button
        backButton.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {
                  startActivity(new Intent(getApplicationContext(), ViewScheduleActivity.class));
              }
          }
        );//end backButton.setOnClickListener



        Bundle extras = getIntent().getExtras();
        if(extras!=null)
        {
            String month="";
            String sDate="", eDate="";
            String[] times= new String[2];
            Date startDateTime=new Date();
            Date endDateTime=new Date();

            month = getMonthForInt(extras.getInt("schedulemonth"));
            dateText.setText(month + " " + extras.getInt("scheduleday") + ", " + extras.getInt("scheduleyear"));
            dateText.setPaintFlags(Paint.UNDERLINE_TEXT_FLAG);

            sDate=extras.getInt("scheduleyear")+"-"+extras.getInt("schedulemonth")+"-"+extras.getInt("scheduleday") +" 00:00:00";
            eDate=extras.getInt("scheduleyear")+"-"+extras.getInt("schedulemonth")+"-"+(extras.getInt("scheduleday")+1) +" 00:00:00";

           // SaveSharedPreference.setUserID(getApplicationContext(), "2");
            Config.setUserId(2);
            String userID= Config.getUserId()+"";
            times =new  Utilities().getSchedule(userID,sDate,eDate);//SaveSharedPreference.getUserID(getApplicationContext()), sDate,eDate);

            if(times!=null) {

                try {
                    SimpleDateFormat parseFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
                    SimpleDateFormat printFormat = new SimpleDateFormat("h:mm a");

                    startDateTime = parseFormat.parse(times[0]);
                    endDateTime = parseFormat.parse(times[1]);

                    startTimeText.setText("Shift Start Time: " + printFormat.format(startDateTime));
                    endTimeText.setText("Shift End Time: " + printFormat.format(endDateTime));
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
            else
            {
                startTimeText.setText("Not Scheduled Today");
                endTimeText.setText("");
            }
        }
        else
        {
            dateText.setText("No date chosen, please go back and choose date");
            startTimeText.setText("");
            endTimeText.setText("");
        }

    }

    public String getMonthForInt(int num) {
        String month = "";
        DateFormatSymbols dfs = new DateFormatSymbols();
        String[] months = dfs.getMonths();
        if (num >= 0 && num <= 11 ) {
            month = months[num];
        }
        return month;
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_schedule_date, menu);
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
