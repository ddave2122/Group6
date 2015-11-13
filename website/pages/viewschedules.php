<?php
include_once("../include/header.php");
include_once('../include/transporter.php');


	// Create connection
    $transporter = new Transporter();
    $conn = $transporter->getConnection();


	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM user";

	$result = $conn->query($sql);

	
	
	while ($row = $result->fetch_assoc()) {
       
	}

	$conn->close();
    
?>
	<div class="row">

		<form class="form-horizontal row-border" id="viewForm">
			<div class="row">
				<div class="col-md-4" style="">
				    <div class="form-group" style="padding-left:15px;padding-right:15px;">
				      <label class="control-label">ID:</label>
				        <input class="form-control" type="text" id="userId" value="10" name="userId">
				     </div>
			    </div>

				<div class="col-md-4">
				    <div class="form-group" style="padding-left:15px;padding-right:15px;">
				      <label class="control-label">Start Date:</label>
				        <input class="form-control" type="datetime-local" id="startDate" name="startDate" >
				     </div>
			    </div>

			    <div class="col-md-4">
				    <div class="form-group" style="padding-left:15px;padding-right:15px;">
				      <label class="control-label">End Date:</label>
				        <input class="form-control" type="datetime-local" id="endDate" name="endDate" placeholder="" >
				     </div>
			    </div>

		    </div>

		    <div class="row">
		    	<div class="col-md-4">
		    	</div>
		    	<div class="col-md-4">
		    		<button type="submit" id="daterange" name="daterange" class="btn btn-lg btn-primary" style="width:100%;margin-top:30px;margin-bottom:30px;">Submit</button>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</form>
	</div>


	<div class="row" id="content" style="padding-bottom:60px;">

			
	</div>



<?php include_once("../include/bottomwrapper.php") ?>