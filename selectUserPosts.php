<?php 
     session_start();
     
     //Setting up php.ini configuration for error logging
    ini_set('log_errors',1);
    ini_set('error_log','php_error_log.txt');

     if( !isset($_SESSION['validUser']) ) {
        header('Location: home.php');		//PHP redirect for invalid users
        exit();
	} 
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
                <form style="text-align:center;"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return validateMyForm()" method="post">
                <?php 
                    include 'dbConnection.php';   //Connection page to the database
                    try{
                        $dbObject = new Dbconnection;
                        $userId = $_SESSION['validUserId'];
                        $posts ="";
                        $sql = "SELECT COUNT(1) FROM posts WHERE post_author=$userId ORDER BY post_id DESC";
                        if ($res = $dbObject->connect()->query($sql)) {
                            if($res->fetchColumn()>0) {
                                $stmt = $dbObject->connect()->prepare("SELECT * FROM posts WHERE post_author=? ORDER BY post_id DESC");
                                $stmt->bindParam(1, $userId);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $title = $row['post_title'];
                                    $author = $_SESSION['validUser'];
                                    $date = $row['post_date'];
                                    $posts .= "<div style='background: rgba(255, 255, 255, 0.6);border-radius: 15px;margin-top: 4rem;margin-bottom: 4rem;'><h2><a href='readPost.php?postID=".$row['post_id']."'>$title</a></h2><h4>Submitted by &#58; <span style='color: red;'>$author</span></h4><h6 style='color: red;'>$date</h6><a style='text-decoration:none;background-color:#4373a7;border:1px solid #660000;border-radius:5px;color:#fff;margin-right:5px;padding:5px 5px 5px 5px;' href='createPost.php?postID=". $row['post_id'] ."'>Update</a><a style='text-decoration:none;background-color:#cc0000;border:1px solid #660000;border-radius:5px;color:#fff;margin-right:10px;padding:5px 5px 5px 5px;' href='deletePost.php?postID=". $row['post_id'] ."'>Delete</a></div><br>";
                                }
                                echo $posts;
                            }
                            else {
                                echo "<h3 style=\"color: white;\">There are no posts to display</h3><h3><a onMouseOver=\"this.style.color='red'\" onMouseOut=\"this.style.color='#4373a7'\"href=\"createPost.php\">Create a post</a></h3>";
                            }
                        }
                    }
                    catch(PDOException $e) {
                        error_log($e->getMessage());//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
                        error_log(var_dump(debug_backtrace()));//Clean up any variables or connections that have been left hanging by this error.
                        header('Location: 505_error_response_page.php');//sends control to a User friendly page		
                    }
                ?>
                </form>
    </div>
    <!--end of container-->
</body>
</html>