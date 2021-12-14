<?php
     session_start();
     //Setting up php.ini configuration for error logging
    ini_set('log_errors',1);
    ini_set('error_log','php_error_log.txt');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
				Landing Page for Final Project
				Author: Joshua Allen
				Date: December 28, 2018
        -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131561213-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-131561213-1');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="cssFiles/reset2.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="cssFiles/finalProject.css" type="text/css">
    <style>
        footer {
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container height">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
                        <span class="icon-bar" style="color:black;"></span>
                        <span class="icon-bar" style="color:black;"></span>
                        <span class="icon-bar" style="color:black;"></span>
                    </button>
                    <a href="#" navbar-brand>
                        <img src="images/squareHelmet1.png">
                        <span style="color:red; font-size: 2rem;">Giants</span>
                        <span style="color:white; font-size: 2rem;">FanPage</span>
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-right" id="mainNavbar">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a href="teamHistory.php">Team History</a>
                        </li>
                        <li>
                            <a href="rivalries.php">Team Rivalries</a>
                        </li>

                        <li>
                            <a href="form.php">Contact Us</a>
                        </li>
                        <?php 
                            if(isset($_SESSION['validUser'])){
                                echo "<li>
                                        <a href='createPost.php'>Create a Post</a>
                                    </li>";
                            }
                        ?>
                        <?php 
                            if(isset($_SESSION['validUser'])){
                                echo "<li>
                                        <a href='selectUserPosts.php'>View Your Posts</a>
                                    </li>";
                            }
                        ?>
                        <li>
                            <a href="fanPosts.php">Fan Posts</a>
                        </li>
                        <?php 
                            if(!isset($_SESSION['validUser'])){
                                echo    "<li>
                                            <a href='login.php'><i class='fa fa-fw fa-user' style='color: white;'></i>Login In</a>
                                        </li>";
                            }
                        ?>
                        <?php 
                            if(isset($_SESSION['validUser'])){
                                echo    "<li>
                                            <a href='logout.php?logout=loggedOut'><i class='fa fa-fw fa-user' style='color: white;'></i>Log Out</a> 
                                        </li>";
                            }
                        ?>
                       <li>
                            <a href="../wdv341homework.html">Homework Page</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end of coantainer-->
        </nav>
        <div class="jumbotron">
            <h1>Giants Fan Page</h1>
            <?php if(isset($_SESSION['validUser'])) {
                echo "<h2 style=\"color: #4373a7;text-align: center;\">Welcome ". $_SESSION['validUser'] . "</h2>";
            }?>
        </div>
        <div class="row">
            <div class=" col-xs-6 helmet">
                <img src="images/giantsSmallHelmet.png" alt="Giants Helmet">
            </div>
           <div class=" col-xs-6 rightHelmet">
                <!-- <img src="images/right_giantsSmallHelmet.png" alt="Giants Helmet"> -->
            </div> 
        </div><!--end of row-->
        <?php
$xml = simplexml_load_file("https://elitesportsny.com/category/nyc-teams/c-new-york-giants/feed/");
echo '<ul class="list-group">';
foreach($xml->channel->item as $item) {
  $title = $item->title;
  $link = $item->link;
  $description = $item->description; 
  echo '<li class="list-group-item"><a href='.$link.'>'.$title.'</a>'.$description.'</li>';
 
}
echo "</ul>";
?>
    </div><!--end of container-->
    <footer>
    <img src="images/squareHelmet1.png">       
    <span style="color:red; font-size: 2rem;">Giants</span>
    <span style="color:white; font-size: 2rem;">FanPage</span>
    <p class="copyright">&#169;<span style="color:white; font-size: 2rem;"><?php echo " ". date("Y") . " "; ?></span> WDV341</p>
    </footer>
</body>
</html>