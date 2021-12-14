<?php 
     session_start();
     include 'dbConnection.php';   //Connection page to the database

     //Setting up php.ini configuration for error logging
    ini_set('log_errors',1);
    ini_set('error_log','php_error_log.txt');
     
    //Setting up data model
    $errorMsg = "";

    $validForm = false;

    $inUserName = "";
    $inUserPassword = "";

    if(isset($_POST['login'])){
        //Processing form data
        $inUserName = $_POST['userName'];
        $inUserPassword = $_POST['userPassword'];

        //Validate Form data
        $validForm = true;
        
        //Check for empty fields
        if(empty($inUserName) || empty($inUserPassword))
        {
            $validForm = false;
            $errorMsg = "Please do not leave blank";
        }
        else {
            //Check if input characters are valid
            if(!preg_match("/^[a-zA-Z0-9]*$/", $inUserName) || !preg_match("/^[a-zA-Z0-9]*$/", $inUserPassword)){
                $validForm = false;
                $errorMsg = "Please only enter numbers or letters";
            }
            else{
                try{
                     //Vaidate user name and password exist in database
                    $dbObject = new Dbconnection;
                    $stmt = $dbObject->connect()->prepare("SELECT * FROM posts_user WHERE posts_user_name =? AND posts_user_password =?");
                    $stmt->bindParam(1, $inUserName);
                    $stmt->bindParam(2, $inUserPassword);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    if(!($row['posts_user_name']==$inUserName) || !($row['posts_user_password']==$inUserPassword)){
                        $validForm = false;
                        $errorMsg = "Please try again";
                    }
                    else {
                        $_SESSION['validUser'] = ucfirst($row['posts_user_name']);
                        $_SESSION['validUserId'] = $row['posts_user_id'];
                       
                    }
                }
                catch(PDOException $e) {
                    error_log($e->getMessage());//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
                    error_log(var_dump(debug_backtrace()));//Clean up any variables or connections that have been left hanging by this error.	
                    header('Location: 505_error_response_page.php');//sends control to a User friendly page	
                }
            }
        }
    }//end if submit statement
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
				Final Project
				Author: Joshua Allen
				Date: December 28, 2018
	-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <link rel="stylesheet" href="cssFiles/reset2.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="cssFiles/finalProject.css" type="text/css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
    <?php
        if($validForm)
            {
                header("Location: home.php?loginSuccess");
        ?>
        <?php
            }
            else {
        ?>
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
                        <span style="color:white;font-size: 2rem;">FanPage</span>
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
            <h1>Log In</h1>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return validateMyForm()" method="post">
                    <!-- honeypot field start-->
	                <div style="display:none;">
                        <label>Keep this field blank</label>
                        <input type="text" name="honeypot" id="honeypot" />
                    </div>
                    <!-- honeypot field end -->
                    <?php echo "<h2 style=\"color:red;\">$errorMsg</h2>";?>
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" name="userName" id="userName" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Password</label>
                        <input type="password" class="form-control" name="userPassword" id="userPassword"></input>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="login" value="Login"></input>
                        <input type="reset" class="btn btn-primary" value="Reset"></input>
                    </div>
                </form>
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
    <?php
    }
?><!--end of valid form else statement-->
</body>
</html>