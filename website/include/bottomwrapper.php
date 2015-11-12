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

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>



</html>