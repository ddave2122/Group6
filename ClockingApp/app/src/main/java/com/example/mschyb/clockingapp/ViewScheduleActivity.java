package com.example.mschyb.clockingapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.TextView;

import java.util.HashMap;

public class ViewScheduleActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_schedule);

        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
        }

        Button backButton = (Button) findViewById(R.id.backButton);
        //set the onClick listener for the button
        backButton.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {
                  startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
              }
          }
        );//end backButton.setOnClickListener

        //Get schedule
       // Utilities utilities = new Utilities();
        //final HashMap<String, String[]> schedule = utilities.getSchedule(Config.getUserId(), "2010-01-01", "2020-01-01");

        CalendarView calendar = (CalendarView) findViewById(R.id.calendarView);

        calendar.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            public void onSelectedDayChange(CalendarView view, int year, int month, int day)
            {

               Intent intent = new Intent(getApplicationContext(), ScheduleDateActivity.class);
                intent.putExtra("scheduleyear", year);
                intent.putExtra("scheduleday",day);
                intent.putExtra("schedulemonth",month);
                startActivity(intent);

/*                //Only used for testing
                TextView startTime = (TextView) findViewById(R.id.textView8);
                startTime.setVisibility(View.INVISIBLE);
                TextView endTime = (TextView) findViewById(R.id.textView9);
                endTime.setVisibility(View.INVISIBLE);

                String monthString, dayString;
                if(++month < 10)
                    monthString = "0" + month;
                else
                    monthString = String.valueOf(month);
                if(day < 10)
                    dayString = "0" + day;
                else
                    dayString = String.valueOf(day);

                String key = year + "-" + monthString + "-" + dayString;
                Intent intent= new Intent(getApplicationContext(), ScheduleDateActivity.class);
                intent.putExtra("scheduledYear", year);
                intent.putExtra("scheduledMonth", month);
                intent.putExtra("scheduledDay", day);
                if(schedule.containsKey(key))
                {
                    String[] startAndStopTimes = schedule.get(key);
                    intent.putExtra("startTime", startAndStopTimes[0].split(" ")[1]);
                    intent.putExtra("endTime", startAndStopTimes[1].split(" ")[1]);

                }

                startActivity(intent);
*/
            }
        });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_view_schedule, menu);
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
