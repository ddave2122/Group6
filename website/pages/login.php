<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clocking Web App</title>
    <link href="../dist/css/custom.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>

<body id="loginbody">
   

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="homeStyle" style="color:white;">Clocking Web App Portal</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="webauthlogin.php" method="Post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button  name="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="tagLine">
            <div class="col-md-8">
                <h1 class="text-center homeTagline" id="homeTagline">Forgot To Set Your Alarm For Work?<br>
                    Get Clocking App Now!</h1>
            </div>
           
            <div class="col-md-4">
                <img id="tagimg" src="../img/androidrun2white.png" class="img-responsive">
            </div>
        </div>
        
    </div>


    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(function () {
            var body = $('#loginbody');
            var backgrounds = [
              'url(http://dreamworxx.com/images/bg1.jpg)', 
              'url(http://dreamworxx.com/images/bg2.jpg)'];
            var current = 0;

            function nextBackground() {
                $('#tagLine').fadeOut('slow', function () {
                    var msg = document.getElementById("homeTagline").innerHTML;
                    if (msg == "Developed By: Group 6<br> Chyeeka, David, Dhara, Jimmy, Sheldon"){
                        var text = "Forgot To Set Your Alarm For Work? Get Clocking App Now!";
                        var pic = "../img/androidrun2white.png";
                    } else {
                        var text = "Developed By: Group 6<br> Chyeeka, David, Dhara, Jimmy, Sheldon";
                        var pic = "../img/phone.png";
                    }
                    document.getElementById("homeTagline").innerHTML = text;
                    document.getElementById("tagimg").src = pic;
                    /*body.css(
                        'background-image',
                    backgrounds[current = ++current % backgrounds.length]);*/
                    $('#tagLine').fadeIn('slow');
                    setTimeout(nextBackground, 5000);

                });
            }
            setTimeout(nextBackground, 5000);
            /*body.css('background-image', backgrounds[0]);*/
        });
    </script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    


</body>

</html>
