package com.example.mschyb.clockingapp;

import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.os.IBinder;
import android.os.Looper;
import android.provider.Settings;
import android.util.Log;

import java.security.Security;
import java.util.Date;
import java.util.Timer;
import java.util.TimerTask;

public class GPSTrackingService extends Service {

    private static final String TAG = Config.TAG;

    private LocationManager locationManager;// = (LocationManager)getSystemService(Context.LOCATION_SERVICE);
    private MyLocationListener myLocationListener = new MyLocationListener();

    private TimerTask gpsStartTask = new TimerTask() {
        private Handler mHandler = new Handler(Looper.getMainLooper());

        @Override
        public void run() {
            mHandler.post(new Runnable() {
                @Override
                public void run() {

                    try {
                        Settings.Secure.setLocationProviderEnabled(getContentResolver(), LocationManager.GPS_PROVIDER, true);
                    } catch (Exception e) {
                        Log.e(TAG, "Problem trying to turn on GPS:" + e.toString());
                    }

                    try {
                        Criteria criteria = new Criteria();
                        criteria.setAccuracy(Criteria.ACCURACY_FINE);
                        locationManager = (LocationManager)getSystemService(Context.LOCATION_SERVICE);
                        String bestProvider = locationManager.getBestProvider(criteria, true);
                        locationManager.requestLocationUpdates(bestProvider, 100, .0f, myLocationListener);

                    } catch (SecurityException e) {
                        Log.e(TAG, e.toString());
                    }
                }
            });
        }
    };

    @Override
    public IBinder onBind(Intent intent) {
        // TODO Auto-generated method stub
        return null;
    }

    private void turnGPSOn(){
        String provider = Settings.Secure.getString(getContentResolver(), Settings.Secure.LOCATION_PROVIDERS_ALLOWED);

        if(!provider.contains("gps")){ //if gps is disabled
            final Intent poke = new Intent();
            poke.setClassName("com.android.settings", "com.android.settings.widget.SettingsAppWidgetProvider");
            poke.addCategory(Intent.CATEGORY_ALTERNATIVE);
            poke.setData(Uri.parse("3"));
            sendBroadcast(poke);
        }
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId)
    {

        turnGPSOn();
        super.onStartCommand(intent, flags, startId);
        try {
            Log.i(TAG, "Made it to onStartCommand");
        } catch (java.lang.IllegalStateException e) {
            Log.d(TAG, e.getMessage());
        }

        Runnable runnable = new Runnable() {
            @Override
            public void run() {
                try {
                    Settings.Secure.setLocationProviderEnabled(getContentResolver(), LocationManager.GPS_PROVIDER, true);
                } catch (Exception e) {
                    Log.e(TAG, "Problem trying to turn on GPS:" + e.toString());
                }

                try {
                    Criteria criteria = new Criteria();
                    criteria.setAccuracy(Criteria.ACCURACY_FINE);
                    locationManager = (LocationManager)getSystemService(Context.LOCATION_SERVICE);
                    String bestProvider = locationManager.getBestProvider(criteria, true);
                    locationManager.requestLocationUpdates(bestProvider, 100000, 0.000f, myLocationListener);

                } catch (SecurityException e) {
                    Log.e(TAG, "Security Exception");
                    Log.e(TAG, e.toString());
                }
            }
        };
        runnable.run();

        return START_STICKY;
    }

    @Override
    public void onCreate() {
        super.onCreate();
        Log.i(TAG, "GpsTrackingService onCreate");

    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        Log.i(TAG, "Service destroying");
    }

    public class MyLocationListener implements LocationListener {

        @Override
        public void onLocationChanged(Location location) {
            if (location != null) {
                Log.i(TAG, "LOCATION CHANGED: " + location);

                if(Config.isGPSDefault())
                {
                    Log.e(Config.TAG, "GPS hasn't been setup");
                    return;
                }

                if(location.getLatitude() > Config.getWestEndpoint()
                        && location.getLatitude() < Config.getEastEndpoint()
                        && location.getLongitude() > Config.getSouthEndpoint()
                        && location.getLongitude() < Config.getNorthEndpoint()
                        )
                {
                    Utilities.clockUser(1);     //Clock in the user
                }
                else
                {
                    Utilities.clockUser(0);     //Clock out the user
                }
            }
        }

       @Override
        public void onProviderDisabled(String provider) {
            Log.i(TAG, "PROVIDER DISABLED:" + provider);
        }

        @Override
        public void onProviderEnabled(String provider) {
            Log.i(TAG, "PROVIDER ENABLED:" + provider);
        }

        @Override
        public void onStatusChanged(String provider, int status, Bundle extras) {
            Log.i(TAG, "EXTRAS: " + extras);
            Log.i(TAG, "Provider status: " + status);
        }
    }
}
