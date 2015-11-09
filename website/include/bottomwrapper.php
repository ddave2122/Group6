</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


</body>


<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<!-- User Management Form Handler -->
<script>
  $(function () {

    $('#addForm').on('submit', function (e) {

      e.preventDefault();

      $("#addForm input[required=true]").each(function(){
            $(this).css('border-color',''); 
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
      });

      
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