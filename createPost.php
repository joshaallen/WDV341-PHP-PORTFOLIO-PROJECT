<?php 
      session_start();
     if( !isset($_SESSION['validUser']) ) {
		header('Location: home.php');		//PHP redirect for invalid users
	} 
     include 'dbConnection.php';   //Connection page to the database
    //Setting up php.ini configuration for error logging
    ini_set('log_errors',1);
    ini_set('error_log','php_error_log.txt');
     
    //Setting up data model
    $errorMsg = "";

    $validForm = false;

    $inPostContent = "";
    $inPostTitle = "";

    $postID="";
    //sets current data timezone for the php ini file
    ini_set('date.timezone',date_default_timezone_set('America/Chicago'));
    //Todays Date
    $date = date("M jS, Y h:i:s A");
    
    if(isset($_POST['post'])){
        //Processing form data
        $inPostTitle = strip_tags($_POST['postTitle']);
        $inPostContent = strip_tags($_POST['postContent']);

        //Validate Form data
        $validForm = true;
        
        //Check for empty fields
        if(empty($inPostContent) || empty($inPostTitle))
        {
            $validForm = false;
            $errorMsg = "Please do not leave blank";
        }
        else {
            if(isset($_GET['postID'])) {
                try{
                    $postID = $_GET['postID'];
                    $dbObject = new Dbconnection;
                    //prepare the statement
                    $stmt = $dbObject->connect()->prepare("UPDATE posts SET post_title=?, post_content=?, post_date=? WHERE post_id=?");
                    //execute the query
                    $stmt->execute([$inPostTitle, $inPostContent, $date, $postID]);
                    if($stmt)
                    {
                        echo "<script>alert(\"Record update successfully\")</script>";
                        header("Location: selectUserPosts.php");
                        return;
                    }
                    else{
                        echo "<script>alert(\"Oops Please try again\")</script>";
                        header("Location: selectUserPosts.php");
                        return;
                    }
                }
                catch(PDOException $e) {
                    error_log($e->getMessage());//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
                    error_log(var_dump(debug_backtrace()));//Clean up any variables or connections that have been left hanging by this error.
                    header('Location: 505_error_response_page.php');//sends control to a User friendly page		
                }
            }
            else 
            {
                try{
                    //Vaidate user name and password exist in database
                    $dbObject = new Dbconnection;
                    $stmt = $dbObject->connect()->prepare("INSERT INTO posts (post_author, post_title, post_content, post_date) VALUES (:post_author, :post_title, :post_content, :post_date)");
                    $stmt->bindParam(':post_author',$_SESSION['validUserId']);
                    $stmt->bindParam(':post_title', $inPostTitle);
                    $stmt->bindParam(':post_content', $inPostContent);
                    $stmt->bindParam(':post_date', $date);
                    $stmt->execute();
                    if($stmt->execute())
                    {
                        echo "<script>alert(\"Record update successfully\")</script>";
                        header("Location: selectUserPosts.php");
                        exit();
                    }
                    else{
                        throw new exception("Something went wrong with the query");
                        header("Location: 505_error_response_page.php");
                        exit();
                    }
                }
                catch(PDOException $e) {
                    error_log($e->getMessage());//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
                    error_log(var_dump(debug_backtrace()));//Clean up any variables or connections that have been left hanging by this error.
                    header('Location: 505_error_response_page.php');//sends control to a User friendly page		
                }
                catch(exception $e) {
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
    <title>Create a Post</title>
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
                header("Location: selectUserPosts.php");
        ?>
        <?php
            }
            else {
            if(isset($_GET['postID'])) {
                try{
                    $postID = $_GET['postID'];
                    $dbObject = new Dbconnection;
                    //prepare the statement
                    $sql = "SELECT COUNT(1) FROM posts WHERE post_id=$postID ORDER BY post_id DESC";
                    if ($res = $dbObject->connect()->query($sql)) {
                        if($res->fetchColumn()>0) {
                            $stmt = $dbObject->connect()->prepare("SELECT post_title, post_content FROM posts WHERE post_id=$postID");
                            $stmt->execute();
                            //RESULT object contains an associative array
		                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $inPostTitle = $row['post_title'];	
                            $inPostContent = $row['post_content'];
                        }
                    }
                }
                catch(PDOException $e){
                    error_log($e->getMessage());//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
                    error_log(var_dump(debug_backtrace()));//Clean up any variables or connections that have been left hanging by this error.
                    header('Location: 505_error_response_page.php');//sends control to a User friendly page	
                }
            }
        ?>
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
            <h1>Create Post</h1>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <?php 
                    if(!isset($_GET['postID']))
                        {
                ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateMyForm()" method="post">
                <?php          
                        }
                    elseif(isset($_GET['postID']))
                    {
                ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?postID=$postID";?>" onsubmit="return validateMyForm()">
                <?php
                    }
                ?>
                    <!-- honeypot field start-->
	                <div style="display:none;">
                        <label>Keep this field blank</label>
                        <input type="text" name="honeypot" id="honeypot" />
                    </div>
                    <!-- honeypot field end -->
                    <?php echo "<h2 style=\"color:red;\">$errorMsg</h2>";?>
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" name="postTitle" id="postTitle" class="form-control" value="<?php echo $inPostTitle;?>">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" rows="10" id="postContent" name="postContent"><?php if(isset($_GET['postID'])){echo $inPostContent;} ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="post" value="Post"></input>
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