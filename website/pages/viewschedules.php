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
	
	$options = '<select class="form-control viewBox" id="userId" name="userId"><option  value="all" id="userId">ALL</option>';
	
	
	while ($row = $result->fetch_assoc()) {
        $options = $options.'<option id="userId" name="userId" value="'.$row['id'].'">'.$row['last_name'].', '.$row['first_name'].'</option>';
	}

	$options = $options.'</select>';

	$conn->close();
	date_default_timezone_set('America/New_York');
	$date = date('Y-m-d\TH:i:s');

	
    
?>
	<div class="row">

		<form class="form-horizontal row-border" id="viewForm">
			<div class="row">
				<div class="col-md-4">
				    <div class="form-group" style="padding-left:15px;padding-right:15px;">
				      <label class="control-label" for="employees">Employee</label>
				        <?php echo $options?>
				    </div>
			    </div>

				<div class="col-md-4">
				    <div class="form-group" style="padding-left:15px;padding-right:15px;">
				      <label class="control-label">Start Date & Time:</label>
				        <?php echo '<input class="form-control viewBox" type="datetime-local" id="startDate" name="startDate" value="'.$date.'">';?>
				     </div>
			    </div>

			    <div class="col-md-4">
				    <div class="form-group" style="padding-left:15px;padding-right:15px;">
				      <label class="control-label">End Date & Time:</label>
				        <?php echo '<input class="form-control viewBox" type="datetime-local" id="endDate" name="endDate" value="'.$date.'">';?>
				        
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


	<div class="row" id="content">

			
	</div>



<?php include_once("../include/bottomwrapper.php") ?>