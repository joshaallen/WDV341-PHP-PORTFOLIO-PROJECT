<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rivalries</title>
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
         #rival {
            background: rgba(255, 255, 255, 0.6);
            margin: 1rem;
        }
    </style>
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
        <div class="jumbotron">
            <h1>Rivalries</h1>
        </div>

        <div class="row">
            <div class="col-lg-12" id="rival">
                <h3>Philadelphia Eagles</h3>
                <p>The rivalry between the New York Giants and the Philadelphia Eagles is one of the oldest in the NFL, dating back to 1933. The two teams have frequently fought for playoff contention, NFC East titles, and respect. While the Giants have dominated this rivalry throughout most of its history, the series began to even in the 1980s, with the series lead to the Eagles 22–21 through the 1990s and 2000s. The Giants lead the series 84–82–2. The two teams have met four times in the postseason, with each team winning two games. Three of those four playoff meetings were held in the 2000s decade. New York City and Philadelphia have a strong geographic rivalry, as seen in other professional sports such as the Mets-Phillies rivalry in Major League Baseball, and the Flyers-Rangers and Devils-Flyers rivalries in the National Hockey League.</p>
            </div>
            <div class="col-lg-12" id="rival">
                <h3>Washington Redskins</h3>
                <p>The Giants have an old and storied rivalry with the Redskins, dating back to 1932. While this rivalry is typically given less significance than the rivalries with the Eagles and Cowboys, there have been periods of great competition between the two. In the 1980s the Giants and Redskins clashed as both struggled against each other for division titles and even Super Bowl Championships. Most notable among these is the 1986 NFC Championship game in which the Giants defeated the Redskins 17–0 to earn their first ever trip to the Super Bowl. Wellington Mara always felt this was the Giants oldest and truest rival, and after passing away in 2005, the Giants honored their longtime owner by defeating the Redskins 36–0 at home. The Giants lead this series 100–68–4. The Giants 100 wins against the Redskins are the most wins against another franchise in NFL history.
                </p>
            </div>
            <div class="col-lg-12" id="rival">
                <h3>Dallas Cowboys</h3>
                <p>The Giants have maintained a fierce divisional rivalry with the Dallas Cowboys since the Cowboys first began play in 1960. The two teams have a combined nine Super Bowl victories between them, and have played many games in which the NFC East title was at stake. The rivalry is unique among professional sports as it is the only divisional rivalry between sports teams from New York City and Dallas, partially due to the large distance between the two cities. The Cowboys lead the regular season series 64–45–2, while the Giants hold the lone playoff victory between the two teams, held at the conclusion of the 2007 season.</p>
            </div>
            <div class="col-lg-12" id="rival">
            <h3>San Francisco 49ers</h3>
                <p>Despite never being in the same division, the Giants and 49ers have developed a heated rivalry over the years. The two teams have met eight times in the playoffs (including two NFC Championship Games, both won by New York) since 1982, which is the most of any two teams in that span. The overall series is tied 16–16, as is the postseason series, 4–4.
                </p>
            </div>
            <div class="col-lg-12" id="rival">
            <h3>New York Jets</h3>
                <p>The Giants and Jets for many years had the only intracity rivalry in the NFL, made even more unusual by sharing a stadium. They have met annually in the preseason since 1969. Since 2011, this meeting has been known as the "MetLife Bowl", after the naming sponsor of the teams' stadium. Regular season matchups between the teams occur once every four years, as they follow the NFL scheduling formula for interconference games. Since the two teams play each other so infrequently in the regular season, some, including players on both teams, have questioned whether the Giants and Jets have a real rivalry. A memorable regular season game was in 1988, when the Giants faced off against the Jets in the last game of the season, needing a victory to make the playoffs. The Jets played spoiler, however, beating the Giants 27–21 and ruining the latter's playoff hopes. A different scenario unfolded during the penultimate regular season game of 2011 as the "visiting" Giants defeated the Jets 29–14. The victory simultaneously helped eliminate the Jets from playoff contention and propel the Giants to their own playoff run and eventual win in Super Bowl XLVI. The Giants lead the overall regular season series 8–5 and have won five of the past six meetings.
                </p>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
    <footer>
    <img src="images/squareHelmet1.png">       
    <span style="color:red; font-size: 2rem;">Giants</span>
    <span style="color:white; font-size: 2rem;">FanPage</span>
    </footer>
</body>

</html>