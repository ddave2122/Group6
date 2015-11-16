package com.example.mschyb.clockingapp;

import android.app.AlarmManager;
import android.app.PendingIntent;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.NumberPicker;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.ToggleButton;

import java.util.Calendar;

public class SetAlarmsActivity extends AppCompatActivity {

    AlarmManager alarmManager;
    private PendingIntent pendingIntentAL,pendingIntentDB;
    private TimePicker alarmTimePicker;
    private static SetAlarmsActivity inst;
    private TextView alarmTextView;
    private ToggleButton alarmToggle;
    public static boolean alarmOn;
    public static int shiftStartTimeHour=19, shiftStartTimeMinute=0, setNumPick1=-1,setNumPick2=-1,alarmHours,alarmMins;
    private NumberPicker minsNumberPicker ;
    private NumberPicker hoursNumberPicker;


    public static SetAlarmsActivity instance() {
        return inst;
    }

    @Override
    public void onStart() {
        super.onStart();
        inst = this;
        hoursNumberPicker.setValue(setNumPick1);
        minsNumberPicker.setValue(setNumPick2);
        alarmToggle.setChecked(alarmOn);
    }
    @Override
    public void onStop(){
        super.onStop();

        setNumPick1=hoursNumberPicker.getValue();
        setNumPick2=minsNumberPicker.getValue();
        alarmOn=alarmToggle.isChecked();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_set_alarms);

        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
        }
        else
        {}

        Button backButton = (Button) findViewById(R.id.backButton);
        //set the onClick listener for the button
        backButton.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {
                  startActivity(new Intent(getApplicationContext(), HomeScreenActivity.class));
              }
          }
        );


        alarmToggle = (ToggleButton) findViewById(R.id.alarmToggle);
        minsNumberPicker = (NumberPicker) findViewById(R.id.minsNumberPicker);
        hoursNumberPicker = (NumberPicker) findViewById(R.id.hoursNumberPicker);

        hoursNumberPicker.setMaxValue(6);
        hoursNumberPicker.setMinValue(0);
        hoursNumberPicker.setWrapSelectorWheel(true);
        hoursNumberPicker.setOnValueChangedListener(new NumberPicker.
                OnValueChangeListener() {
            @Override
            public void onValueChange(NumberPicker picker, int
                    oldVal, int newVal) {
                setNumPick1 = newVal;
                alarmHours = newVal;
            }
        });

        minsNumberPicker.setMaxValue(59);
        minsNumberPicker.setMinValue(0);
        minsNumberPicker.setWrapSelectorWheel(true);
        minsNumberPicker.setOnValueChangedListener(new NumberPicker.
                OnValueChangeListener() {
            @Override
            public void onValueChange(NumberPicker picker, int
                    oldVal, int newVal) {
                alarmMins=newVal;
                setNumPick2= newVal;
            }
        });
        //alarmTimePicker = (TimePicker) findViewById(R.id.alarmTimePicker);
        alarmTextView = (TextView) findViewById(R.id.alarmText);

        alarmManager = (AlarmManager) getSystemService(ALARM_SERVICE);

        //Sets Alarm for pulling info from DB
        Calendar calendar = Calendar.getInstance();
        calendar.set(Calendar.HOUR_OF_DAY, 0);
        calendar.set(Calendar.MINUTE, 0);
        Intent dbIntent = new Intent(SetAlarmsActivity.this, DBAlarmReceiver.class);
        pendingIntentDB = PendingIntent.getBroadcast(SetAlarmsActivity.this, 0, dbIntent, 0);
        /* Repeating on every day at 12am  */
        alarmManager.setInexactRepeating(AlarmManager.RTC_WAKEUP, calendar.getTimeInMillis(), AlarmManager.INTERVAL_DAY, pendingIntentDB);


        //Code to set alarm for shift start time
        if(alarmOn)
        {
            int startHours=shiftStartTimeHour-alarmHours ;
            int startMins=shiftStartTimeMinute-alarmMins;

            if(startHours<0)
                startHours+=24;
            if(startMins<0)
                startMins+=60;

            Log.d("SetAlarmActivity", "Alarm On");
            Calendar calendar2 = Calendar.getInstance();
            calendar2.set(Calendar.HOUR_OF_DAY,startHours);
            calendar2.set(Calendar.MINUTE, startMins);
            Intent myIntent = new Intent(SetAlarmsActivity.this, AlarmReceiver.class);
            pendingIntentAL = PendingIntent.getBroadcast(SetAlarmsActivity.this, 0, myIntent, 0);
            alarmManager.setInexactRepeating(AlarmManager.RTC, calendar2.getTimeInMillis(), AlarmManager.INTERVAL_DAY, pendingIntentAL);
        }
        else
        {
            alarmManager.cancel(pendingIntentAL);
            setAlarmText("");
            Log.d("SetAlarmsActivity", "Alarm Off");
        }



/*
        Button cancelButton = (Button) findViewById(R.id.btnSetAlarms);
=======
        Button backButton = (Button) findViewById(R.id.btnSetAlarms);
>>>>>>> refs/remotes/origin/master
        //set the onClick listener for the button
        backButton.setOnClickListener(new View.OnClickListener() {
                                          @Override
                                          public void onClick(View v) {
                                              Intent intent = new Intent(getApplicationContext(), AlarmReceiver.class);
                                              PendingIntent pendingIntent = PendingIntent.getBroadcast(getApplicationContext(), 1253, intent, 0);
                                              AlarmManager alarmManager = (AlarmManager) getSystemService(ALARM_SERVICE);
                                              alarmManager.cancel(pendingIntent);

                                          }
                                      }
        );//end backButton.setOnClickListener
    */
    }



    public void onToggleClicked(View view) {
        if (((ToggleButton) view).isChecked()) {

            alarmOn=true;

        } else {
            alarmOn=false;

        }
    }

    public void cancelAlarm(){
        Intent intent = new Intent(this, AlarmReceiver.class);
        PendingIntent pendingIntent = PendingIntent.getBroadcast(getApplicationContext(), 1253, intent, 0);
        AlarmManager alarmManager = (AlarmManager) getSystemService(ALARM_SERVICE);
        alarmManager.cancel(pendingIntent);


    }

    public void setAlarmText(String alarmText) {
        alarmTextView.setText(alarmText);
    }




    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_set_alarms, menu);
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
