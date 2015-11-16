<?php include_once("../include/header.php"); ?>

<div class="welcome">

	<h1 id="welcome">Welcome <?php echo $_SESSION['firstname'] . "!"; ?></h1>

</div>
	<div class="row" id="dashboard">
        
        <div class="col-md-3">
        	<img id="playimg" src="../img/play-store-download.png" class="img-responsive">
        </div>
        <div class="col-md-6">
        	<h1 class="text-center" id="tag">Don't Be Late<br>Download The App Now</h1>
        </div>
        <div class="col-md-3">
        	<img id="tagimg" src="../img/androidrun2.png" class="img-responsive">
        </div>

    </div>


<?php include_once("../include/bottomwrapper.php") ?>

