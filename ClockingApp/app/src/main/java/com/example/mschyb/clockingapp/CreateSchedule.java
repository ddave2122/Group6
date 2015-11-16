package com.example.mschyb.clockingapp;

import android.content.Context;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import java.util.HashMap;
import java.util.Map;

public class CreateSchedule extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create_schedule);

        final Spinner dropdown = (Spinner)findViewById(R.id.spinner1);
        final HashMap<String, String> items = new Utilities().getUsers();

        if(items != null)
        {
            String[] userNames = new String[items.size()];
            int counter = 0;
            for(Map.Entry<String, String> entry : items.entrySet())
            {
                userNames[counter++] = entry.getKey();
            }

            ArrayAdapter<String> adapter = new ArrayAdapter<>(
                    this, android.R.layout.simple_spinner_dropdown_item, userNames);
            dropdown.setAdapter(adapter);



        Button clockOutButton = (Button) findViewById(R.id.setSchedule);
        clockOutButton.setOnClickListener(new View.OnClickListener() {


            public void onClick(View v)
            {
                TimePicker startTime = (TimePicker) findViewById(R.id.timePicker1);
                TimePicker endTime = (TimePicker) findViewById(R.id.timePicker2);
                DatePicker date = (DatePicker) findViewById(R.id.datePicker1);
                startTime.clearFocus();
                endTime.clearFocus();
                String startTimeAndDate =
                        date.getYear() + "-" +
                        date.getMonth() + "-" +
                        date.getDayOfMonth() + " ";

                String shiftStart = startTimeAndDate +
                        startTime.getCurrentHour() + ":" +
                        startTime.getCurrentMinute() + ":00";

                String shiftEnd = startTimeAndDate +
                        endTime.getCurrentHour() + ":" +
                        endTime.getCurrentMinute() + ":00";

                Utilities utilities = new Utilities();

                utilities.saveSchedule(shiftStart, shiftEnd,
                        items.get(dropdown.getSelectedItem().toString()));

                Context context = getApplicationContext();
                CharSequence text = "Schedule has been saved!";
                int duration = Toast.LENGTH_SHORT;

                Toast toast = Toast.makeText(context, text, duration);
                toast.show();

            }
        });



        }



        dropdown.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                TextView helloText = (TextView) findViewById(R.id.username);
                helloText.setText(dropdown.getSelectedItem().toString());
            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // your code here
            }

        });



//        dropdown.onClick(helloText.setText(dropdown.getSelectedItem().toString()));
    }
}
