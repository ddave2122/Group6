</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


</body>


<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<script>



  /* Schedule Tabs */
  $('.btnNext').click(function(){
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
  });

  $('.btnPrevious').click(function(){
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  });

  $(document).ready(function() {


      // process the form
      $('#viewForm').submit(function(event) {
          document.getElementById("content").innerHTML = "";
          // get the form data
          var formData = {
              'userId'              : $('input[name=userId]').val(),
              'startDate'             : $('input[name=startDate]').val(),
              'endDate'    : $('input[name=endDate]').val()
          };

          // process the form
          $.ajax({
              type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
              url         : 'readschedule.php', // the url where we want to POST
              data        : formData, // our data object
              dataType    : 'json', // what type of data do we expect back from the server
                          encode          : true
          })
              // using the done promise callback
              .done(function(data) {
                  var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                  var months = ["January","February","March","April","May","June","July", "August", "September", "October", "November", "December"];
                  var msec = Date.parse("2015-11-05 02:01:00");
                  var date = new Date(msec);
                  var m = months[date.getMonth()];
                  var day = days[date.getDay()];
                  var d = date.getDay()+1;
                  var y = date.getFullYear();
                  

                  for(var i =0;i < data.length-1;i++)
                  {
                    var item = data[i];
                    

                    var start = moment(item.startTime).tz('America/Phoenix').format('YYYY-MM-DD[T]HH:mm:ss');
                    var end = moment(item.endDate).tz('America/Phoenix').format('YYYY-MM-DD[T]HH:mm:ss');
                    //var date2 = new Date(test).toISOString().substring(0,23);
                   
                    
                    //alert("Test again: " + test);
                    //alert(item.startTime + " " ; item.endTime);
                    var startvalue = start;
                    var endvalue = end;
                    //alert(insval);

                    document.getElementById("content").innerHTML += 
                      '<div class="col-md-2" style="visibility: hidden;">' +
                        '<div class="form-group" style="padding-left:15px;padding-right:15px;">' +
                        '<h1>Space</h1></div>' +
                      '</div>';

                    document.getElementById("content").innerHTML += '<div class="col-md-4">' +
                      '<div class="form-group" style="padding-left:15px;padding-right:15px;">' +
                        '<label class="control-label"></label>' +
                          '<input class="form-control" type="datetime-local" value="'+startvalue+'" id="startDate'+i+'" name="startDate" disabled>' +
                       '</div>' +
                    '</div>';

                    document.getElementById("content").innerHTML += '<div class="col-md-4">' +
                      '<div class="form-group" style="padding-left:15px;padding-right:15px;">' +
                        '<label class="control-label"></label>' +
                          '<input class="form-control" type="datetime-local" value="'+endvalue+'" id="endDate'+i+'" name="endDate" disabled>' +
                       '</div>' +
                    '</div>';

                    document.getElementById("content").innerHTML += 
                      '<div class="col-md-2" style="visibility: hidden;">' +
                        '<div class="form-group" style="padding-left:15px;padding-right:15px;">' +
                        '<h1>Space</h1></div>' +
                      '</div>';
                    
                    console.log(item.startTime + " " + item.endTime);
                  }
                  console.log(data); 

                  // here we will handle errors and validation messages

                  // here we will handle errors and validation messages
                if ( ! data.success) {
                    
                    // handle errors for name ---------------
                    if (data.errors.userId) {
                        alert(data.errors.userId);// add the actual error message under our input
                    }

                    // handle errors for email ---------------
                    if (data.errors.startDate) {
                        alert(data.errors.startDate); // add the actual error message under our input
                    }

                    // handle errors for superhero alias ---------------
                    if (data.errors.endDate) {
                        alert(data.errors.endDate); // add the actual error message under our input
                    }

                } else {

                    // ALL GOOD! just show the success message!
                     alert(data.message);

                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                    alert('success'); // for now we'll just alert the user

                }
              })

              // using the fail promise callback
              .fail(function(data) {

                  // show any errors
                  // best to remove for production
                  console.log(data);
              });

          // stop the form from submitting the normal way and refreshing the page
          event.preventDefault();
      });

  });




  $(function () {

    /* User Management Form Handler */

    $('#addForm').on('submit', function (e) {

      e.preventDefault();
      
      $.ajax({
        type: 'post',
        url: 'manageuser.php',
        data: $('#addForm').serialize(),
        success: function () {
          $("#addForm")[0].reset();
          $("#submitMsg").show();
        }
      });

    });

    /* Create Schedule Handler*/

    $('#submitWeek1').on('submit', function (e) {

      e.preventDefault();
      
      mainObj = "";
      var temp = "";

      function allWorkNoPlay(dayofweek, json) {
          
        for (j = 0; j < 7; j++){
        week = dayofweek + j;
        var object = "";
        var empArray = [];
        var x = document.forms[week];
        console.log(week);
          
          var i;
          for (i = 0; i < x.length ;i++) {
              if(x.elements[i].value == ''){
                break;
              } else{
                empArray.push(x.elements[i].value);
              }
              
          }
          
          if ( (empArray[0] != null) && (empArray[1] != null) && (empArray[2] != null) ) {
            if (json == ''){
              json += '{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }else{
              json += ',{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }
             
          }
         
      }

          return json;                
      }

      var week1 = "week1_";
      var week2 = "week2_";
      var week3 = "week3_";
      var week4 = "week4_";

      mainObj = allWorkNoPlay(week4,allWorkNoPlay(week3,allWorkNoPlay(week2,allWorkNoPlay(week1,mainObj))));
      
      if (mainObj != ''){
        empJSON = '{"schedule":['+mainObj+']}';
      }
      console.log(empJSON);
      
      $.ajax({
        type: 'post',
        url: 'writeschedule.php',
        data: {'schedule' : empJSON},
        
        success: function (data) {
          $('form').each(function() { this.reset() });
          $("#submitScheduleMsg").show();
        }
      });

    });

    $('#submitWeek2').on('submit', function (e) {

      e.preventDefault();
      
      mainObj = "";
      var temp = "";

      function allWorkNoPlay(dayofweek, json) {
          
        for (j = 0; j < 7; j++){
        week = dayofweek + j;
        var object = "";
        var empArray = [];
        var x = document.forms[week];
        console.log(week);
          
          var i;
          for (i = 0; i < x.length ;i++) {
              if(x.elements[i].value == ''){
                break;
              } else{
                empArray.push(x.elements[i].value);
              }
              
          }
          
          if ( (empArray[0] != null) && (empArray[1] != null) && (empArray[2] != null) ) {
            if (json == ''){
              json += '{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }else{
              json += ',{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }
             
          }
         
      }

          return json;                
      }

      var week1 = "week1_";
      var week2 = "week2_";
      var week3 = "week3_";
      var week4 = "week4_";

      mainObj = allWorkNoPlay(week4,allWorkNoPlay(week3,allWorkNoPlay(week2,allWorkNoPlay(week1,mainObj))));
      
      if (mainObj != ''){
        empJSON = '{"schedule":['+mainObj+']}';
      }
      console.log(empJSON);
      
      $.ajax({
        type: 'post',
        url: 'writeschedule.php',
        data: {'schedule' : empJSON},
        
        success: function (data) {
          $('form').each(function() { this.reset() });
          $("#submitScheduleMsg").show();
        }
      });

    });

    $('#submitWeek3').on('submit', function (e) {

      e.preventDefault();
      
      mainObj = "";
      var temp = "";

      function allWorkNoPlay(dayofweek, json) {
          
        for (j = 0; j < 7; j++){
        week = dayofweek + j;
        var object = "";
        var empArray = [];
        var x = document.forms[week];
        console.log(week);
          
          var i;
          for (i = 0; i < x.length ;i++) {
              if(x.elements[i].value == ''){
                break;
              } else{
                empArray.push(x.elements[i].value);
              }
              
          }
          
          if ( (empArray[0] != null) && (empArray[1] != null) && (empArray[2] != null) ) {
            if (json == ''){
              json += '{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }else{
              json += ',{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }
             
          }
         
      }

          return json;                
      }

      var week1 = "week1_";
      var week2 = "week2_";
      var week3 = "week3_";
      var week4 = "week4_";

      mainObj = allWorkNoPlay(week4,allWorkNoPlay(week3,allWorkNoPlay(week2,allWorkNoPlay(week1,mainObj))));
      
      if (mainObj != ''){
        empJSON = '{"schedule":['+mainObj+']}';
      }
      console.log(empJSON);
      
      $.ajax({
        type: 'post',
        url: 'writeschedule.php',
        data: {'schedule' : empJSON},
        
        success: function (data) {
          $('form').each(function() { this.reset() });
          $("#submitScheduleMsg").show();
        }
      });

    });

    $('#submitWeek4').on('submit', function (e) {

      e.preventDefault();
      
      mainObj = "";
      var temp = "";

      function allWorkNoPlay(dayofweek, json) {
          
        for (j = 0; j < 7; j++){
        week = dayofweek + j;
        var object = "";
        var empArray = [];
        var x = document.forms[week];
        console.log(week);
          
          var i;
          for (i = 0; i < x.length ;i++) {
              if(x.elements[i].value == ''){
                break;
              } else{
                empArray.push(x.elements[i].value);
              }
              
          }
          
          if ( (empArray[0] != null) && (empArray[1] != null) && (empArray[2] != null) ) {
            if (json == ''){
              json += '{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }else{
              json += ',{"id":"'+empArray[0]+'","clockIn":"'+empArray[1]+'","clockOut":"'+empArray[2]+':00"}';
              console.log("mainObj: " + json);
            }
             
          }
         
      }

          return json;                
      }

      var week1 = "week1_";
      var week2 = "week2_";
      var week3 = "week3_";
      var week4 = "week4_";

      mainObj = allWorkNoPlay(week4,allWorkNoPlay(week3,allWorkNoPlay(week2,allWorkNoPlay(week1,mainObj))));
      
      if (mainObj != ''){
        empJSON = '{"schedule":['+mainObj+']}';
      }
      console.log(empJSON);
      
      $.ajax({
        type: 'post',
        url: 'writeschedule.php',
        data: {'schedule' : empJSON},
        
        success: function (data) {
          $('form').each(function() { this.reset() });
          $("#submitScheduleMsg").show();
        }
      });

    });

       
});
  
</script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../bower_components/raphael/raphael-min.js"></script>
<script src="../bower_components/morrisjs/morris.min.js"></script>
<script src="../js/morris-data.js"></script>
<script src="../js/moment.js"></script>
<script src="../js/moment-timezone.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>



</html>