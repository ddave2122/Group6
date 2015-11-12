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

	$options = '<option id="empId"></option>';
	
	while ($row = $result->fetch_assoc()) {
        $options = $options.'<option id="empId" value="'.$row['id'].'">'.$row['last_name'].', '.$row['first_name'].'</option>';
	}

	$conn->close();
    
?>

<ul class="nav nav-tabs" style="border-bottom: none !important;">
    <li class="active"><a href="#tab1" data-toggle="tab" style="display: none;"></a></li>
    <li><a href="#tab2" data-toggle="tab" style="display: none;"></a></li>
    <li><a href="#tab3" data-toggle="tab" style="display: none;"></a></li>
    <li><a href="#tab4" data-toggle="tab" style="display: none;"></a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <a class="btn btn-primary btnNext" >>></a>
        <a class="btn btn-primary btnNext" style="float:right;visibility: hidden;" >>></a>
        <h3 class="text-center" style="margin-top: -31px;margin-bottom: 35px;">Week 1</h3>
        <div class="tab-pane-block">
        <?php

        	$day = "";

        	for($i = 0; $i < 7; $i++){
        		switch ($i){
        			case "0":
        				$day = "Sunday";
        				break;
        			case "1":
        				$day = "Monday";
        				break;
        			case "2":
        				$day = "Tuesday";
        				break;
        			case "3":
        				$day = "Wednesday";
        				break;
        			case "4":
        				$day = "Thursday";
        				break;
        			case "5":
        				$day = "Friday";
        				break;
        			case "6":
        				$day = "Saturday";
        				break;					
        			default:
        				$day = "";
        		}

        		echo '
                    
        			<div class="row form-style-2">

				        <form class="form-horizontal row-border" id="week1_'.$i.'"">
					    	
						    <h3 style="padding-left:15px;">'.$day.'</h3>
						    
						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label" for="employees">Employee</label>
							        <select class="form-control" id="employees'.$i.'" name="employees">'.$options.'</select>
							    </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">Start Date:</label>
							        <input class="form-control" type="datetime-local" id="startdate'.$i.'" name="startdate" required="true">
							     </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">End Date:</label>
							        <input class="form-control" type="datetime-local" id="enddate'.$i.'" name="enddate" placeholder="" required="true">
							     </div>
						    </div>

						</form>
					</div>

        		';
        	}
        	
        ?>
        </div>
       <div class="row">
       		<div class="col-md-4">
       		</div> 
			<div class="col-md-4">
                <form class="form-horizontal row-border" id="submitWeek1">
			     <button type="submit" name="submitWeek1" class="btn btn-lg btn-primary" style="width:100%;margin-top:30px;margin-bottom:30px;">Submit</button>
		        </form>
            </div>
		    <div class="col-md-4">
       		</div> 
		</div>
	    
    </div> <!-- End of Tab1 -->

    <div class="tab-pane" id="tab2">
    	<a class="btn btn-primary btnNext" style="float:right;" >>></a>
        <a class="btn btn-primary btnPrevious" ><<</a>
        <h3 class="text-center" style="margin-top: -31px;margin-bottom: 35px;">Week 2</h3>
        <div class="tab-pane-block">
        <?php

        	$day = "";

        	for($i = 0; $i < 7; $i++){
        		switch ($i){
        			case "0":
        				$day = "Sunday";
        				break;
        			case "1":
        				$day = "Monday";
        				break;
        			case "2":
        				$day = "Tuesday";
        				break;
        			case "3":
        				$day = "Wednesday";
        				break;
        			case "4":
        				$day = "Thursday";
        				break;
        			case "5":
        				$day = "Friday";
        				break;
        			case "6":
        				$day = "Saturday";
        				break;					
        			default:
        				$day = "";
        		}

        		echo '

        			<div class="row form-style-2">

				        <form class="form-horizontal row-border" id="week2_'.$i.'">
					    	
						    <h3 style="padding-left:15px;">'.$day.'</h3>
						    
						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label" for="employees">Employee</label>
							        <select class="form-control" id="employees'.$i.'" name="employees">'.$options.'</select>
							    </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">Start Date:</label>
							        <input class="form-control" type="datetime-local" id="startdate'.$i.'" name="startdate" placeholder="" required="true">
							     </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">End Date:</label>
							        <input class="form-control" type="datetime-local" id="enddate'.$i.'" name="enddate" placeholder="" required="true">
							     </div>
						    </div>

						</form>
					</div>

        		';
        	}
        	
        ?>
        </div>
       <div class="row">
       		<div class="col-md-4">
       		</div> 
			<div class="col-md-4">
                <form class="form-horizontal row-border" id="submitWeek2">
                 <button type="submit" name="submitWeek2" class="btn btn-lg btn-primary" style="width:100%;margin-top:30px;margin-bottom:30px;">Submit</button>
                </form>
            </div>
		    <div class="col-md-4">
       		</div> 
		</div>

    </div>
    
    <div class="tab-pane" id="tab3">
    	<a class="btn btn-primary btnNext" style="float:right;" >>></a>
        <a class="btn btn-primary btnPrevious" ><<</a>
        <h3 class="text-center" style="margin-top: -31px;margin-bottom: 35px;">Week 3</h3>
        <div class="tab-pane-block">
        <?php

        	$day = "";

        	for($i = 0; $i < 7; $i++){
        		switch ($i){
        			case "0":
        				$day = "Sunday";
        				break;
        			case "1":
        				$day = "Monday";
        				break;
        			case "2":
        				$day = "Tuesday";
        				break;
        			case "3":
        				$day = "Wednesday";
        				break;
        			case "4":
        				$day = "Thursday";
        				break;
        			case "5":
        				$day = "Friday";
        				break;
        			case "6":
        				$day = "Saturday";
        				break;					
        			default:
        				$day = "";
        		}

        		echo '

        			<div class="row form-style-2">

				        <form class="form-horizontal row-border" id="week3_'.$i.'">
					    	
						    <h3 style="padding-left:15px;">'.$day.'</h3>
						    
						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label" for="employees">Employee</label>
							        <select class="form-control" id="employees'.$i.'" name="employees">'.$options.'</select>
							    </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">Start Date:</label>
							        <input class="form-control" type="datetime-local" id="startdate'.$i.'" name="startdate" placeholder="" required="true">
							     </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">End Date:</label>
							        <input class="form-control" type="datetime-local" id="enddate'.$i.'" name="enddate" placeholder="" required="true">
							     </div>
						    </div>

						</form>
					</div>

        		';
        	}
        	
        ?>
        </div>
       <div class="row">
       		<div class="col-md-4">
       		</div> 
			<div class="col-md-4">
                <form class="form-horizontal row-border" id="submitWeek3">
                 <button type="submit" name="submitWeek3" class="btn btn-lg btn-primary" style="width:100%;margin-top:30px;margin-bottom:30px;">Submit</button>
                </form>
            </div>
		    <div class="col-md-4">
       		</div> 
		</div>

    </div>

    <div class="tab-pane" id="tab4">
    	<a class="btn btn-primary btnPrevious" style="visibility: hidden;">Null</a>
        <a class="btn btn-primary btnPrevious" style="float:right;" ><<</a>
        <h3 class="text-center" style="margin-top: -31px;margin-bottom: 35px;">Week 4</h3>
        <div class="tab-pane-block">
        <?php

        	$day = "";

        	for($i = 0; $i < 7; $i++){
        		switch ($i){
        			case "0":
        				$day = "Sunday";
        				break;
        			case "1":
        				$day = "Monday";
        				break;
        			case "2":
        				$day = "Tuesday";
        				break;
        			case "3":
        				$day = "Wednesday";
        				break;
        			case "4":
        				$day = "Thursday";
        				break;
        			case "5":
        				$day = "Friday";
        				break;
        			case "6":
        				$day = "Saturday";
        				break;					
        			default:
        				$day = "";
        		}

        		echo '

        			<div class="row form-style-2">

				        <form class="form-horizontal row-border" id="week4_'.$i.'">
					    	
						    <h3 style="padding-left:15px;">'.$day.'</h3>
						    
						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label" for="employees">Employee</label>
							        <select class="form-control" id="employees'.$i.'" name="employees">'.$options.'</select>
							    </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">Start Date:</label>
							        <input class="form-control" type="datetime-local" id="startdate'.$i.'" name="startdate" placeholder="" required="true">
							     </div>
						    </div>

						    <div class="col-md-4">
							    <div class="form-group" style="padding-left:15px;padding-right:15px;">
							      <label class="control-label">End Date:</label>
							        <input class="form-control" type="datetime-local" id="enddate'.$i.'" name="enddate" placeholder="" required="true">
							     </div>
						    </div>

						</form>
					</div>

        		';
        	}
        	
        ?>
        </div> 
       <div class="row">
       		<div class="col-md-4">
       		</div> 
			<div class="col-md-4">
                <form class="form-horizontal row-border" id="submitWeek4">
                 <button type="submit" name="submitWeek4" class="btn btn-lg btn-primary" style="width:100%;margin-top:30px;margin-bottom:30px;">Submit</button>
                </form>
            </div>
		    <div class="col-md-4">
       		</div> 
		</div>

    </div>

    <div id="submitScheduleMsg" class="text-center" style="margin-bottom:100px;display:none;">
        <h3>Schedule updated successfully.</h3>
    </div>

</div>

   



<?php include_once("../include/bottomwrapper.php") ?>

