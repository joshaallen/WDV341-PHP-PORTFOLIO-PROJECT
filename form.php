<?php 
     session_start();

     include 'emailer.php';

     //Setting up php.ini configuration for error logging
    ini_set('log_errors',1);
    ini_set('error_log','php_error_log.txt');
     
    //Setting up data model
    $errorMsg = "";

    $inFirstName;
    $inLastName;
    $inEmail;
    $inComment;
    $mailTo;

    $validForm = false;
    
    if(isset($_POST['submit'])){
        //Processing form data
        $inFirstName = strip_tags($_POST['firstName']);
        $inLastName = strip_tags($_POST['lastName']);
        $inEmail = $_POST['email'];
        $inComment = strip_tags($_POST['comment']);
        $mailTo = "$inEmail, joshuaa2003@joshuaallen.info";

        //Validate Form data
        $validForm = true;
        
        //Check for empty fields
        if(empty($inFirstName) || empty($inLastName) || empty($inEmail) || empty($inComment))
        {
            $validForm = false;
            $errorMsg = "Please do not leave blank";
        }
        else {
            if(!filter_var($inEmail, FILTER_VALIDATE_EMAIL))
            {
                $validForm = false;
                $errorMsg = "Please enter a valid email format";
            }
            else {
                $subject = "$inFirstName $inLastName";
                $email = new Emailer();
                $email->set_sendersAddress("$inEmail");
                $email->set_subjectLine("$subject");
                $email->set_message("$inComment");
                $email->sendEmail($mailTo);
            }
        }
    }//end if submit statement
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
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
</head>
<body>
    <div class="container">
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
        <?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
                echo "<h1 style='text-align:center;color:white;'>$inFirstName your Email has been Sent Correctly! </h1>";
			}
			else	//display form
			{
        ?>
        <div class="jumbotron">
            <h1>Contact Us</h1>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateMyForm()" method="post">
                    <!-- honeypot field start-->
	                <div style="display:none;">
                        <label>Keep this field blank</label>
                        <input type="text" name="honeypot" id="honeypot" />
                    </div>
                    <!-- honeypot field end -->
                    <?php echo "<h2 style=\"color:red;\">$errorMsg</h2>";?>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="John" required autocomplete="off"></input>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Smith" required autocomplete="off"></input>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="JohnSmith@abc.com" required autocomplete="off"></input>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" name="comment"id="comment" required autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </form>
                <?php
			    }//end else
                ?> 
            </div>
        </div>
    </div>
    <!--end of container-->
    <footer>
    <img src="images/squareHelmet1.png">       
    <span style="color:red; font-size: 2rem;">Giants</span>
    <span style="color:white; font-size: 2rem;">FanPage</span>
    <p class="copyright">&#169;<span style="color:white; font-size: 2rem;"><?php echo " ". date("Y") . " "; ?></span> WDV341</p>
    </footer>
</body>
</html>