package com.example.mschyb.clockingapp;


import android.content.Context;
import android.content.Intent;
import android.support.v4.content.WakefulBroadcastReceiver;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;

public class DBAlarmReceiver extends WakefulBroadcastReceiver {
    public DBAlarmReceiver() {
    }

    @Override
    public void onReceive(Context context, Intent intent) {
        // TODO: This method is called when the BroadcastReceiver is receiving
        // an Intent broadcast
        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        //get current date time with Date()
        Date date = new Date();
        String todaysDate=dateFormat.format(date);
        Calendar c = Calendar.getInstance();
        c.setTime(date);
        c.add(Calendar.DATE, 1);
        String tomorrowsDate=dateFormat.format(c.getTime());

        HashMap<String,String[]> times =new Utilities().getSchedule(Config.getUserId(), todaysDate, tomorrowsDate);

        if(times.containsKey(todaysDate))
        {
            try {
                SimpleDateFormat parseFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");//"yyyy-MM-dd HH:mm:ss");
                SimpleDateFormat printFormat1 = new SimpleDateFormat("h");
                SimpleDateFormat printFormat2 = new SimpleDateFormat("mm");
                String times2[]=times.get(todaysDate);
                Date startDateTime = parseFormat.parse(times2[0]);

                SetAlarmsActivity.shiftStartTimeHour = Integer.parseInt(printFormat1.format(startDateTime));
                SetAlarmsActivity.shiftStartTimeMinute = Integer.parseInt(printFormat2.format(startDateTime));

            } catch (Exception e) {
                e.printStackTrace();
            }
        }
        else
        {
            //Disable alarm since employee is not schedule today
        }
    }
}
