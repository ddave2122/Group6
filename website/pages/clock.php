<?php include_once("../include/header.php"); ?>
<?php include_once("../js/timeclock.js"); ?>

<div class="clockStyle"> 

	<span id="clock">&nbsp;</span>

	<br>

	<script type="text/javascript">
		    var x = "In";
			var y = "Out";
	</script>

	<div id="buttonBox">
		<a href="#" class="btn btn-lg btn-primary btn-block" onclick="updateAlert(x)">Clock In</a>

		<br><br>

		<a href="#" class="btn btn-lg btn-primary btn-block"  onclick="updateAlert(y)">Clock Out</a>
	</div>

	<div id="alertBox"> 

		<span id="time">&nbsp;</span>

	</div>

</div>


<?php include_once("../include/bottomwrapper.php") ?>