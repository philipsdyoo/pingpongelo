<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">NJ Sooryen Elo App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="php/update_match.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Start/Join a Match</a></li>
                    <li><a href="leaderboard.php"><i class="fa fa-users" aria-hidden="true"></i> Leaderboard</a></li>
                <?php endif ?>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="login-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php"><i class="fa fa-user" aria-hidden="true"></i> Log Out</a></li>
                <?php else: ?>
                    <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user" aria-hidden="true"></i> Log In</a></li>
                <?php endif ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>