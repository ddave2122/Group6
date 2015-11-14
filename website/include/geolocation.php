<?php
error_reporting(E_ALL & ~E_NOTICE);
/**
 * <p>Represents a point on the surface of a sphere. (The Earth is almost
 * spherical.)</p>
 *
 * <p>To create an instance, call one of the static methods fromDegrees() or
 * fromRadians().</p>
 *
 * <p>This is a PHP port of Java code that was originally published at
 * <a href="http://JanMatuschek.de/LatitudeLongitudeBoundingCoordinates#Java">
 * http://JanMatuschek.de/LatitudeLongitudeBoundingCoordinates#Java</a>.</p>
 *
 * Many thanks to the original author: Jan Philip Matuschek
 *
 * @author Anthony Martin
 * @version November 21 2012
 */
class GeoLocation {

    public $radLat;  // latitude in radians
    public $radLon;  // longitude in radians

    public $degLat;	 // latitude in degrees
    public $degLon;  // longitude in degrees

    public function __construct() {
        define('MIN_LAT', deg2rad(-90));  // -PI/2
        define('MAX_LAT', deg2rad(90));   //  PI/2
        define('MIN_LON', deg2rad(-180)); // -PI
        define('MAX_LON', deg2rad(180));  //  PI
    }

    /**
     * @param latitude the latitude, in degrees.
     * @param longitude the longitude, in degrees.
     * @return GeoLocation
     */
    public static function fromDegrees($latitude, $longitude) {
        $location = new GeoLocation();
        $location->radLat = deg2rad($latitude);
        $location->radLon = deg2rad($longitude);
        $location->degLat = $latitude;
        $location->degLon = $longitude;
        $location->checkBounds();
        return $location;
    }

    /**
     * @param latitude the latitude, in radians.
     * @param longitude the longitude, in radians.
     * @return GeoLocation
     */
    public static function fromRadians($latitude, $longitude) {
        $location = new GeoLocation();
        $location->radLat = $latitude;
        $location->radLon = $longitude;
        $location->degLat = rad2deg($latitude);
        $location->degLon = rad2deg($longitude);
        $location->checkBounds();
        return $location;
    }

    protected function checkBounds() {
        if ($this->radLat < MIN_LAT || $this->radLat > MAX_LAT ||
            $this->radLon < MIN_LON || $this->radLon > MAX_LON)
            throw new Exception("Invalid Argument");
    }

    /**
     * Computes the great circle distance between this GeoLocation instance
     * and the location argument.
     * @param radius the radius of the sphere, e.g. the average radius for a
     * spherical approximation of the figure of the Earth is approximately
     * 6371.01 kilometers.
     * @return the distance, measured in the same unit as the radius
     * argument.
     */
    public function distanceTo(GeoLocation $location, $radius) {
        return acos(sin($this->radLat) * sin($location->radLat) +
            cos($this->radLat) * cos($location->radLat) *
            cos($this->radLon - $location->radLon)) * $radius;
    }

    /**
     * @return the latitude, in degrees.
     */
    public function getLatitudeInDegrees() {
        return $this->degLat;
    }

    /**
     * @return the longitude, in degrees.
     */
    public function getLongitudeInDegrees() {
        return $this->degLon;
    }

    /**
     * @return the latitude, in radians.
     */
    public function getLatitudeInRadians() {
        return $this->radLat;
    }

    /**
     * @return the longitude, in radians.
     */
    public function getLongitudeInRadians() {
        return $this->radLon;
    }

    public function __toString() {
        return "(" . $this->degLat . ", " . $this->degLong . ") = (" .
        $this->radLat . " rad, " . $this->radLon . " rad";
    }


    /**
     * <p>Computes the bounding coordinates of all points on the surface
     * of a sphere that have a great circle distance to the point represented
     * by this GeoLocation instance that is less or equal to the distance
     * argument.</p>
     * <p>For more information about the formulae used in this method visit
     * <a href="http://JanMatuschek.de/LatitudeLongitudeBoundingCoordinates">
     * http://JanMatuschek.de/LatitudeLongitudeBoundingCoordinates</a>.</p>
     * @param distance the distance from the point represented by this
     * GeoLocation instance. Must me measured in the same unit as the radius
     * argument.
     * @param radius the radius of the sphere, e.g. the average radius for a
     * spherical approximation of the figure of the Earth is approximately
     * 6371.01 kilometers.
     * @return an array of two GeoLocation objects such that:<ul>
     * <li>The latitude of any point within the specified distance is greater
     * or equal to the latitude of the first array element and smaller or
     * equal to the latitude of the second array element.</li>
     * <li>If the longitude of the first array element is smaller or equal to
     * the longitude of the second element, then
     * the longitude of any point within the specified distance is greater
     * or equal to the longitude of the first array element and smaller or
     * equal to the longitude of the second array element.</li>
     * <li>If the longitude of the first array element is greater than the
     * longitude of the second element (this is the case if the 180th
     * meridian is within the distance), then
     * the longitude of any point within the specified distance is greater
     * or equal to the longitude of the first array element
     * <strong>or</strong> smaller or equal to the longitude of the second
     * array element.</li>
     * </ul>
     */
    public function boundingCoordinates($distance, $radius) {
        if ($radius < 0 || $distance < 0) throw new Exception('Arguments must be greater than 0.');

        // angular distance in radians on a great circle
        $radDist = $distance / $radius;

        $minLat = $this->radLat - $radDist;
        $maxLat = $this->radLat + $radDist;

        $minLon = 0;
        $maxLon = 0;
        if ($minLat > MIN_LAT && $maxLat < MAX_LAT) {
            $deltaLon = asin(sin($radDist) /
                cos($this->radLat));
            $minLon = $this->radLon - $deltaLon;
            if ($minLon < MIN_LON) $minLon += 2 * pi();
            $maxLon = $this->radLon + $deltaLon;
            if ($maxLon > MAX_LON) $maxLon -= 2 * pi();
        } else {
            // a pole is within the distance
            $minLat = max($minLat, MIN_LAT);
            $maxLat = min($maxLat, MAX_LAT);
            $minLon = MIN_LON;
            $maxLon = MAX_LON;
        }

        return array(
            GeoLocation::fromRadians($minLat, $minLon),
            GeoLocation::fromRadians($maxLat, $maxLon)
        );
    }
}

/* 
 *
 * Example Usage 
 *
*/

//
//	$edison = GeoLocation::fromDegrees(40.5187154, -74.4120953);
//	$brooklyn = GeoLocation::fromDegrees(40.65, -73.95);
//
//	echo "distance from edison to brooklyn: " . $edison->distanceTo($brooklyn, 3958.762079) . " miles \n";
//	echo "distance from edison to brooklyn: " . $edison->distanceTo($brooklyn, 6371.01) . " kilometers \n";

//	$edison = GeoLocation::fromDegrees(40.5187154, -74.4120953);
//
//        // get bounding coordinates 40 kilometers from location;
//	$coordinates = $edison->boundingCoordinates(0.05,  6371.01);
//
////	print_r($coordinates);
//	echo "min latitude: " . $coordinates[0]->degLat . " \n";
//	echo "min longitude: " . $coordinates[0]->degLon . " \n";
//
//	echo "max latitude: " . $coordinates[1]->degLat . " \n";
//	echo "max longitude: " . $coordinates[1]->degLon . " \n";
