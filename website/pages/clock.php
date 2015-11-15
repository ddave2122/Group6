<?php include_once("../include/header.php"); ?>
<?php include_once("../js/timeclock.js"); ?>


<div class="clockStyle"> 

	<div class="row">
		<div class="col-md-12"> 
			<h1 id="clock">&nbsp;</h1>
		</div>
		
	</div>
	<br>

	<script type="text/javascript">
		    var x = "In";
			var y = "Out";
			
	</script>

	<div class="row">
		<div class="col-md-4">
		</div> 
		<form class="form-horizontal row-border" id="clockForm">
			<div class="col-md-4"> 
				<div id="buttonBox">
					<a href="#" class="btn btn-lg btn-primary btn-block" onclick="updateAlert(x)">Clock In</a>

					<br><br>

					<a href="#" class="btn btn-lg btn-primary btn-block"  onclick="updateAlert(y)">Clock Out</a>
				</div>

			</div>
		</form>

		<div class="col-md-4">
		</div>

	</div>

	<div class="row">
		<div class="col-md-2">
		</div>

		<div class="col-md-8"> 
			<div id="alertBox" class="jumbotron"> 
				Did You Know You're Awesome?!
				<span id="time">&nbsp;</span>

			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>

</div>


<?php include_once("../include/bottomwrapper.php") ?>