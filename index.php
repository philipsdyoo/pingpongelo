<?php
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    include('php/setup.php');
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $userQuery = "SELECT * FROM users WHERE id=$user_id LIMIT 1;";
        $user_info = $cxn->query($userQuery);
        $user_data = $user_info->fetch_assoc();
        $user_name = $user_data['name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="images/36x36.png"/>

    <title>NJ Sooryen Ping Pong Elo</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body role="document">
        <?php include("php/navbar.php"); ?>

        <div class="container theme-showcase" role="main">
            <?php if(isset($_GET['err']) && $_GET['err'] == 1): ?>
                <div class='alert alert-danger alert-dismissible'>
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    <strong>Error:</strong> You need a sooryen.com domain email address in order to sign in.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['err']) && $_GET['err'] == 2): ?>
                <div class='alert alert-danger alert-dismissible'>
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    <strong>Error:</strong> There was an error when processing the form.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h1>Welcome<?php if (isset($_SESSION['user_id'])) { print(', '.$user_name); } ?>!</h1>
                <p>This is the NJ Sooryen office ping pong Elo ranking app.</p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <p>Start or join a match. Win to climb the NJ Sooryen Elo leaderboard!</p>
                <?php else: ?>
                    <p>Please log in start.</p>
                <?php endif; ?>
            </div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="jumbotron" id="match-jumbotron"></div>
            <?php endif; ?>
            <!-- Login Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="POST">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Log In</h4>
                            </div>
                            <div class="modal-body">
                                <p>You are required to use a sooryen.com domain email address to log in to this app.</p>
                                <a href="login.php"><button type="button" class="btn btn-danger"><i class="fa fa-google" aria-hidden="true"></i> | Sign in through Google</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
