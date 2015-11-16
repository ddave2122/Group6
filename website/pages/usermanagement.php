<?php
include_once("../include/header.php"); 
include_once('../include/transporter.php');

	
	

    
	

?>



<div>
	<ul class="nav nav-pills nav-justified"  id="tabs">
	  <li class="active"><a data-toggle="pill" href="#view">View Employees</a></li>
	  <li><a data-toggle="pill" href="#edit">Edit Employees</a></li>
	  <li><a data-toggle="pill" href="#add">Add Employees</a></li>
	  
	</ul>
</div>

<div class="tab-content tab-content-pane">
  <div id="view" class="tab-pane fade in active">
  	

    <h3 class="text-center">View Employees</h3>

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

  <div id="edit" class="tab-pane fade">
  	
    <h3 class="text-center">Edit Employees</h3>
   

    <div class="panel-body">
	  <form class="form-horizontal row-border" id="editForm">
	    
	  	<div class="form-group">
	      <div class="col-md-2"></div>	
	      <label class="col-md-3 control-label">Select Employee</label>
	      <div class="col-md-3">
	      	<select class="form-control" id="empid" name="empid" onchange="myFunction(this.value)">
	      	<?php

	      		// Create connection
			    $transporter = new Transporter();
			    $conn = $transporter->getConnection();


				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT * FROM user";

				$result = $conn->query($sql);

				echo '<option id="empId"></option>';
	
	      		while ($row = $result->fetch_assoc()) {

	      			echo "hi";
			        echo '<option id="empId" value="'.$row['id'].'">'.$row['last_name'].', '.$row['first_name'].'</option>';
				}

				$conn->close();
	      	?>

	        </select>
	      
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div>	
	      <label class="col-md-3 control-label">First Name</label>
	      <div class="col-md-3">
	        <input class="form-control" type="text" name="firstname" id="firstname" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div>	
	      <label class="col-md-3 control-label">Last Name</label>
	      <div class="col-md-3">
	        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div> 	
	      <label class="col-md-3 control-label">Username</label>
	      <div class="col-md-3">
	        <input class="form-control" type="text" name="username" id="username" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	      <div class="col-md-2"></div> 
	      <label class="col-md-3 control-label">Password</label>
	      <div class="col-md-3">
	        <input class="form-control" type="password" name="password" id="password" placeholder="" required="true">
	      </div>
	      <div class="col-md-4"></div>
	    </div>

	    <div class="form-group">
	    	<div class="col-md-2"></div> 
	      <label class="col-md-3 control-label">Status</label>
	      <div class="col-md-3">
	        <select class="form-control" name="status" id="status">
	          <option>Employee</option>	
			  <option>Manager</option>
			</select>
	      </div>
	      <div class="col-md-4"></div>
	    </div> 

	    <div id="submitMsg" class="text-center" style="display:none;padding-bottom:50px;">
	  		<h3>Employee Record Updated Successfully.</h3>
	  	</div>

	    <div class="form-group">
	      <div class="col-md-5"></div>
	      <div class="col-md-3">
	        <button type="submit" name="editUser" class="btn btn-lg btn-primary" style="width:100%;">Submit</button>
	      </div>
	      <div class="col-md-4"></div>
	    </div>
	    

	  </form>
  	</div>

  	

  </div>


  <div id="add" class="tab-pane fade">
  	
    <h3 class="text-center">Add New Employees</h3>
   

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

  	<div id="submitMsg" class="text-center" style="display:none;padding-bottom:50px;">
  		<h3>New employee created successfully.</h3>
  	</div>

  </div>
  
</div>






<?php include_once("../include/bottomwrapper.php") ?>

