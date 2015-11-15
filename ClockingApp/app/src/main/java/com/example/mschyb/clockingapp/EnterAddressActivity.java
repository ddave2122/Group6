package com.example.mschyb.clockingapp;

import android.location.Address;
import android.location.Geocoder;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.mysql.jdbc.Util;

import java.io.IOException;
import java.util.List;

public class EnterAddressActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_enter_address);
        Button gc = (Button) findViewById(R.id.GetAddressCoordinatesButton);
        gc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                TextView addressMessage = (TextView) findViewById(R.id.addressErrorText);

                EditText street = (EditText) findViewById(R.id.editTextStreetName);
                EditText city = (EditText) findViewById(R.id.editTextCityName);
                EditText state = (EditText) findViewById(R.id.editTextStateName);
                EditText zip = (EditText) findViewById(R.id.editTextZipcode);
                String address = street.getText().toString() + ", "+city.getText().toString()+", "+state.getText().toString()+" "+zip.getText().toString();
                List<Address> addresses = null;
                Geocoder geo = new Geocoder(EnterAddressActivity.this);
                try {
                    int counter = 0;
                    while(counter < 8)  //Try to get the address several times
                    {
                        addresses = geo.getFromLocationName(address, 5);
                        if(!(address == null))
                            break;
                        counter++;
                    }
                }
                catch (IOException e) {
                    // TODO Auto-generated catch block
                    e.printStackTrace();
                }
                try
                {
//                    TextView lo = (TextView) findViewById(R.id.textViewLo);
//                    TextView la = (TextView) findViewById(R.id.textViewLa);
//                    lo.setText(String.valueOf(addresses.get(0).getLatitude()));
//                    la.setText(String.valueOf(addresses.get(0).getLongitude()));
                    TextView distance = (TextView) findViewById(R.id.distance);
                    if(Utilities.saveGpsCoordinates(String.valueOf(addresses.get(0).getLatitude())
                            , String.valueOf(addresses.get(0).getLatitude()), distance.getText().toString()))
                    addressMessage.setText("Coordinates have been saved!");
                }
                catch(NullPointerException e)
                {
                    Log.e(Config.TAG, "Null pointer when trying to get address information");
                    addressMessage.setText("Error when getting coordinates from Android...");
                }
            }
        });
    }
}
