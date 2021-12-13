<?php 
      session_start();
     if( !isset($_SESSION['validUser']) ) {
        header('Location: home.php');		//PHP redirect for invalid users
        exit();
    } 
    
    if(!isset($_GET['postID'])) {
        header ("Location: selectUserPosts.php");
        exit();
    }
    else {
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
    <div class="container">
    <?php
    //Setting up php.ini configuration for error logging
    ini_set('log_errors',1);
    ini_set('error_log','php_error_log.txt');
        try{
            include 'dbConnection.php';   //Connection page to the database
            $postId = $_GET['postID'];
            $dbObject = new Dbconnection;
            //prepare the statement
            $stmt = $dbObject->connect()->prepare("DELETE FROM posts WHERE post_id = ?");
            //execute the query
            $stmt->execute([$postId]);
            if($stmt)
            {
                header("Location: selectUserPosts.php");
                 exit();
            }
            else{
                echo "<script>alert(\"Delete unsuccessful\")</script>";
                echo "<a href='selectUserPosts.php'>Back to View Posts</a>";
            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log(var_dump(debug_backtrace()));//Clean up any variables or connections that have been left hanging by this error.
            header('Location: 505_error_response_page.php');//sends control to a User friendly page		
        }
    }
?>
    <div><!--end of container-->
</body>
</html>
