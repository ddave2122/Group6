<?php include_once("../include/header.php"); ?>

<ul class="nav nav-pills nav-justified">
  <li class="active"><a data-toggle="pill" href="#view">View Employees</a></li>
  <li><a data-toggle="pill" href="#add">Add Employees</a></li>
  
</ul>

<div class="tab-content">
  <div id="view" class="tab-pane fade in active">
  	<br>

    <h3 class="text-center">View Employees</h3>

    <br><br>

    <?php
	    include_once('../../../db.config');

		$servername = DB_ENDPOINT;
		$username = DB_USERNAME;
		$password = DB_PASSWORD;
		$dbname = DB_NAME;

		// Create connection
		$conn = new mysqli($servername, $username, $password);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM $dbname.user";

		$result = $conn->query($sql);
		
		echo '<table class="table table-hover table-striped">';
		echo '

			<thead>
		      <tr>
		        <th>First Name</th>
		        <th>Last Name</th>
		        <th>Username</th>
		        <th>Status</th>
		      </tr>
		    </thead>
		';
		while ($row = $result->fetch_assoc()) {

			echo "<tr>";
	        echo '<td>'.$row['first_name'].'</td>';
	        echo '<td>'.$row['last_name'].'</td>';
	        echo '<td>'.$row['username'].'</td>';

	        if ($row['is_manager'] == 1){
	        	echo '<td>Manager</td>';
	        } else {
	        	echo '<td>Employee</td>';
	        }
	        
	      	echo "</tr>";
		}
		echo "</table>";
		
		$conn->close();
	?>

  </div>
  <div id="add" class="tab-pane fade">
  	<br>

    <h3 class="text-center">Add New Employees</h3>

    <br><br>

    <div class="panel-body">
	  <form class="form-horizontal row-border" id="addForm">
	    
	    <div class="form-group">
	      <div class="col-md-2"></div>	
	      <label class="col-md-3 control-label">First Name</label>
	      <div class="col-md-3">
	        <input class="form-control" type="text" name="firstname" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div>	
	      <label class="col-md-3 control-label">Last Name</label>
	      <div class="col-md-3">
	        <input class="form-control" type="text" name="lastname" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div> 	
	      <label class="col-md-3 control-label">Username</label>
	      <div class="col-md-3">
	        <input class="form-control" type="text" name="username" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div> 
	      <label class="col-md-3 control-label">Password</label>
	      <div class="col-md-3">
	        <input class="form-control" type="password" name="password" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	    	<div class="col-md-2"></div> 
	      <label class="col-md-3 control-label">Status</label>
	      <div class="col-md-3">
	        <select class="form-control" name="status">
	          <option>Employee</option>	
			  <option>Manager</option>
			</select>
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-5"></div>
	      <div class="col-md-3">
	        <button type="submit" name="addUser" class="btn btn-lg btn-primary" style="width:100%;">Submit</button>
	      </div>
	      <div class="col-md-4"></div>
	    </div>
	    

	  </form>
  	</div>

  	<div id="submitMsg" class="text-center" style="display:none;">
  		<h3>New employee created successfully.</h3>
  	</div>

  </div>
  
</div>






<?php include_once("../include/bottomwrapper.php") ?>

