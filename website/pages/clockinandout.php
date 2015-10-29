<?php include_once("../include/header.php"); ?>



<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Clock In and Out</h3>
        </div>



        <div class="jumbotron" style="border-radius: 20px; padding: 20px 15px">
            You will be automatically clocked in if you are clocked out and vice-versa!
            Isn't software great :)
        </div>



        <form role="form" method="post" action="clockinandout.php">
            <div class="form-group">
                <label>Please Enter Your User ID</label>
                <input name="locationoferror" id="locationoferror" type="text" class="form-control" placeholder="123456789">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div><!-- /.box -->
</div>



<?php include_once("../include/bottomwrapper.php") ?>

