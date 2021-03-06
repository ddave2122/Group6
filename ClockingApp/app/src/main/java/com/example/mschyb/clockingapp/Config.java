package com.example.mschyb.clockingapp;

public class Config
{
    public final static String TAG = "Group6";
    public final static String ENDPOINT = "http://group6project.com/Group6/website/";
    public final static String CHECK_CREDENTIALS_ENDPOINT = ENDPOINT + "include/checkcredentials.php";
    public final static String LOG_TIME_ENDPOINT = ENDPOINT + "pages/logtime.php";
    public final static String GET_SCHEDULE_ENDPOINT = ENDPOINT + "pages/readschedule.php";
    public final static String GET_HOURS_ENDPOINT = ENDPOINT + "include/gethoursworked.php";
    public final static String SET_GPS_COORDINATES = ENDPOINT + "include/setgpslocation.php";
    public final static String GET_USERS_ENDPOINT = ENDPOINT + "include/getusers.php";
    public final static String SAVE_SCHEDULE_ENDPOINT = ENDPOINT + "pages/writeschedule.php";

    //GPS bounding box
    private static double eastEndpoint = 0;
    private static double westEndpoint = 0;
    private static double southEndpoint = 0 ;
    private static double northEndpoint = 0;

    private static String userFirstName;
    private static int userId;

    private static boolean userIsLoggedIn = false;
    private static boolean isManager;

    public static boolean isUserIsLoggedIn() {
        return userIsLoggedIn;
    }

    public static void setUserIsLoggedIn(boolean userIsLoggedIn) {
        Config.userIsLoggedIn = userIsLoggedIn;
    }

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

    public static boolean isManager() {
        return isManager;
    }

    public static void setIsManager(boolean isManager) {
        Config.isManager = isManager;
    }

    public static String getUserFirstName() {
        return userFirstName;
    }

    public static void setUserFirstName(String userFirstName) {
        Config.userFirstName = userFirstName;
    }

    public static int getUserId() {
        return userId;
    }

    public static void setUserId(int userId) {
        Config.userId = userId;
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
