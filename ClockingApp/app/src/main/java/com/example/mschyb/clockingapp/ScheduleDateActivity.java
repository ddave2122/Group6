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
import java.util.HashMap;

public class ScheduleDateActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_schedule_date);

        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
        }
        else
        {}

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
            //dateText.setText(getMonthForInt(extras.getInt("scheduledMonth")-1) + " " + extras.getInt("scheduledDay") + ", " + extras.getInt("scheduledYear"));
            //dateText.setPaintFlags(Paint.UNDERLINE_TEXT_FLAG);

            String month="";
            String sDate="", eDate="";
            HashMap<String, String[]> times= new HashMap<String, String[]>();
            Date startDateTime=new Date();
            Date endDateTime=new Date();

            month = getMonthForInt(extras.getInt("schedulemonth"));
            dateText.setText(month + " " + extras.getInt("scheduleday") + ", " + extras.getInt("scheduleyear"));
            dateText.setPaintFlags(Paint.UNDERLINE_TEXT_FLAG);

            sDate=extras.getInt("scheduleyear")+"-"+extras.getInt("schedulemonth")+"-"+extras.getInt("scheduleday");
            eDate=extras.getInt("scheduleyear")+"-"+extras.getInt("schedulemonth")+"-"+(extras.getInt("scheduleday")+1);

            times = new Utilities().getSchedule(Config.getUserId(),sDate,eDate);

            if(times.containsKey(sDate))
            {
                try {
                    SimpleDateFormat parseFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");//"yyyy-MM-dd HH:mm:ss");
                    SimpleDateFormat printFormat = new SimpleDateFormat("h:mm a");
                    String times2[]=times.get(sDate);
                    startDateTime = parseFormat.parse(times2[0]);
                    endDateTime = parseFormat.parse(times2[1]);

                    startTimeText.setText("Shift Start Time: " + printFormat.format(startDateTime));
                    endTimeText.setText("Shift End Time: " + printFormat.format(endDateTime));

//                    new SimpleDateFormat("hh:mm a").format(new Date("1/12/2011 16:00:00"))

//                    startTimeText.setText("Shift Start Time: " + parseFormat.format(new Date("1/12/2011 " + times[0])));
  //                  endTimeText.setText("Shift End Time: " + parseFormat.format(new Date("1/12/2011 " + times[1])));

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
