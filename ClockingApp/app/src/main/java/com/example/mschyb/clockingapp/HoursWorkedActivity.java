package com.example.mschyb.clockingapp;

import android.content.Intent;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

import java.util.List;

public class HoursWorkedActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hours_worked);

        if(Config.getUserId() == 0)
        {
            startActivity(new Intent(getApplicationContext(), LoginScreenActivity.class));
        }
        else
        {}

        Button submitButton = (Button) findViewById(R.id.submitButton);
        submitButton.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View v) {
                  EditText startDateBox = (EditText) findViewById(R.id.startDate);
                  String startDate = startDateBox.getText().toString();
                  startDate+="00:00:00";

                  EditText endDateBox = (EditText) findViewById(R.id.endDate);
                  String endDate = endDateBox.getText().toString();
                  endDate+="00:00:00";

                  List<String[]> stuff = new Utilities().getHoursWorked(Config.getUserId(), startDate, endDate);

                  // reference the table layout
                  TableLayout tbl = (TableLayout)findViewById(R.id.hoursTable);

                  for(int i=0;i<stuff.size();i++) {
                      //create new row for table
                      TableRow newRow = new TableRow(getApplicationContext());
                      newRow.setLayoutParams(new TableRow.LayoutParams(
                              TableRow.LayoutParams.MATCH_PARENT,
                              TableRow.LayoutParams.MATCH_PARENT));
                      newRow.setBackground(ContextCompat.getDrawable(getApplicationContext(), R.drawable.border));

                      for (int j = 0; j < 2; j++) {

                          //Create date textview and add to row
                          TextView tv = new TextView(getApplicationContext());
                          tv.setBackground(ContextCompat.getDrawable(getApplicationContext(), R.drawable.border));
                          tv.setText(stuff.get(i)[j]);
                          newRow.addView(tv);

                      }
                      // add row to table
                      tbl.addView(newRow);
                  }
                  tbl.setVisibility(View.VISIBLE);

              }
          }
        );//end submitButton.setOnClickListener

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
        getMenuInflater().inflate(R.menu.menu_hours_worked, menu);
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
