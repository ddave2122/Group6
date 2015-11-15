<!-- Timeclock Script - Sheldon Gray -->

<script type="text/javascript">
<!--

function updateClock ( )
{
  var currentTime = new Date ( );

  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  // Choose either "AM" or "PM" as appropriate
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  // Convert the hours component to 12-hour format if needed
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  // Convert an hours component of "0" to "12"
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  // Compose the string for display
  var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

  // Update the time display
  document.getElementById("clock").firstChild.nodeValue = currentTimeString;


  document.getElementById("currentSchedule") = currentTimeString;

}

function updateAlert (x) {
  var status = x;
  
  if (x == "In"){
    var logstatus = 1;
  } else{
    var logstatus = 0;
  }

  console.log(logstatus);

  var mydate = moment().format('YYYY-MM-DD HH:mm:ss');
  console.log("Moment: " + mydate);

  var currentTime = new Date ( );
 
  

  $.ajax({
    type: 'post',
    url: 'updatetime.php',
    data: {'time' : mydate,
            'status' : logstatus},
    
    success: function (data) {
      console.log(data);
    }
  });







  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  // Choose either "AM" or "PM" as appropriate
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  // Convert the hours component to 12-hour format if needed
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  // Convert an hours component of "0" to "12"
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  // Compose the string for display
  var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  
  document.getElementById("alertBox").firstChild.nodeValue = "You Clocked " + status + " At ";
  document.getElementById("time").firstChild.nodeValue = currentTimeString;
  document.getElementById("alertBox").style.display = "inline-block";
}

// -->
</script>