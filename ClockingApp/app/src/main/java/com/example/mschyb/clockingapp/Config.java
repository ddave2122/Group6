package com.example.mschyb.clockingapp;

public class Config
{
    public final static String TAG = "Group6";
    public final static String ENDPOINT = "http://group6project.com/api/";
    public final static String CHECK_CREDENTIALS_ENDPOINT = ENDPOINT + "checkcredentials.php";
    public final static String GET_SCHEDULE_ENDPOINT = ENDPOINT + "readschedule.php";
    public final static String LOG_TIME_ENDPOINT = ENDPOINT + "logtime.php";

    //GPS bounding box
    private static double eastEndpoint = 0;
    private static double westEndpoint = 0;
    private static double southEndpoint = 0 ;
    private static double northEndpoint = 0;

    private static int userId;
    private static String fullName;

    /**
     * Sanity check to see if the GPS is still set at default values
     * @return true if anything is default
     */
    public static boolean isGPSDefault()
    {
        return(eastEndpoint == 0
                || westEndpoint == 0
                || southEndpoint == 0
                || northEndpoint == 0);
    }


    public static int getUserId() {
        return userId;
    }

    public static void setUserId(int userId) {
        Config.userId = userId;
    }
    public static String getFullName() {
        return fullName;
    }

    public static void setFullName(String name) {
        Config.fullName = fullName;
    }
    public static double getEastEndpoint() {
        return eastEndpoint;
    }

    public static void setEastEndpoint(double eastEndpoint) {
        Config.eastEndpoint = eastEndpoint;
    }

    public static double getWestEndpoint() {
        return westEndpoint;
    }

    public static void setWestEndpoint(double westEndpoint) {
        Config.westEndpoint = westEndpoint;
    }

    public static double getSouthEndpoint() {
        return southEndpoint;
    }

    public static void setSouthEndpoint(double southEndpoint) {
        Config.southEndpoint = southEndpoint;
    }

    public static double getNorthEndpoint() {
        return northEndpoint;
    }

    public static void setNorthEndpoint(double northEndpoint) {
        Config.northEndpoint = northEndpoint;
    }

}
