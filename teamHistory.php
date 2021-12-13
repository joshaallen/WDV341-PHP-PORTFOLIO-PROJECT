<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team History</title>
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
        #history {
            background: rgba(255, 255, 255, 0.6);
            margin: 1rem;
            float: left;
        }
        .giantsReciever {
            float: right;
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
            <h1>Giants Team History</h1>
        </div>

        <div class="row">
            <div class="giantsReciever">
                <img src="images/giantsReciever1.jpg" alt="Giants Receiver">
            </div>
            <div class="col-lg-6" id="history">
                <h3>1925–1932: Early years and first championship</h3>
                <p>The Giants played their first game as an away game against All New Britain in New Britain, Connecticut, on October 4, 1925. They defeated New Britain 26–0 in front of a crowd of 10,000.The Giants were successful in their first season, finishing with an 8–4 record.</p>
                <p>In its third season, the team finished with the best record in the league at 11–1–1 and was awarded the NFL title. After a disappointing fourth season (1928) owner Mara bought the entire squad of the Detroit Wolverines, principally to acquire star quarterback Benny Friedman, and merged the two teams under the Giants name.</p>
                <p>In 1930, there were still many who questioned the quality of the professional game, claiming the college "amateurs" played with more intensity than professionals. In December 1930, the Giants played a team of Notre Dame All Stars at the Polo Grounds to raise money for the unemployed of New York City. It was also an opportunity to establish the skill and prestige of the pro game. Knute Rockne reassembled his Four Horsemen along with the stars of his 1924 Championship squad and told them to score early, then defend. Rockne, like much of the public, thought little of pro football and expected an easy win. But from the beginning it was a one-way contest, with Friedman running for two Giant touchdowns and Hap Moran passing for another. Notre Dame failed to score. When it was all over, Coach Rockne told his team, "That was the greatest football machine I ever saw. I am glad none of you got hurt."The game raised $100,000 for the homeless, and is often credited with establishing the legitimacy of the professional game for those who were critical. It also was the last game the legendary Rockne ever coached; he was killed in an airplane crash on March 31, 1931.</p>
            </div>
            <div class="col-lg-6" id="history">
                <h3>1983–1990: Bill Parcells era</h3>    
                <p>In 1983, Bill Parcells was promoted to head coach from defensive coordinator. One of his first moves was to change his starting quarterback, sitting the injury-prone and struggling Phil Simms (who had missed the entire 1982 season with an injury) and electing instead to go with Scott Brunner, who had gone 4-5 as the starter in place of Simms in the strike-shortened previous season. Parcells went as far as to demote Simms to the third string position, promoting Jeff Rutledge over Simms to be Brunner's backup. Parcells later said the move was a mistake and one he "nearly paid for dearly" as the team finished with a 3–12–1 record and his job security was called into question.</p>
                <p>In the offseason the Giants released Brunner and named Simms the starter. The move paid off as the team won nine games and returned to the playoffs. After beating the Los Angeles Rams in the Wild Card Round, the Giants prepared for a showdown against top-seeded San Francisco. The 49ers defeated the Giants 21–10 in the Divisional Round.</p>
                <p>The 1985 Giants compiled a 10–6 record and avenged their loss against San Francisco by beating them in the Wild Card round 17–3. However, they again lost in the Divisional Round, this time to the eventual Super Bowl champion Bears, by a score of 21–0. However, the following season would end with the Giants winning their first Super Bowl championship.</p>
                <h5>1986: First Super Bowl</h5>
                <p>After 9–7 and 10–6 finishes in 1984 and 1985 respectively, the Giants compiled a 14–2 record in 1986 led by league MVP and Defensive Player of the Year Lawrence Taylor and the Big Blue Wrecking Crew defense. As of 2017, this is the Giants' best regular season record since the NFL began playing 16-game seasons in 1978. After clinching the top seed in the NFC, the Giants defeated the 49ers 49–3 in the divisional round of the NFC playoffs and the Redskins 17–0 in the NFC championship game, advancing to their first Super Bowl, Super Bowl XXI, against the Denver Broncos at the Rose Bowl in Pasadena. Led by MVP Simms who completed 22 of 25 passes for a Super Bowl record 88% completion percentage, they defeated the Broncos 39–20, to win their first championship since 1956. In addition to Phil Simms and Lawrence Taylor, the team was led during this period by head coach Bill Parcells, tight end Mark Bavaro, running back Joe Morris, and Hall of Fame linebacker Harry Carson.</p>
                <p>The Giants struggled to a 6–9 record in the strike-marred 1987 season, due largely to a decline in the running game, as Morris managed only 658 yards[39] behind an injury-riddled offensive line. The early portion of the 1988 season was marred by a scandal involving Lawrence Taylor. Taylor had abused cocaine and was suspended for the first four games of the season for his second violation of the league's substance abuse policy. Despite the controversy, the Giants finished 10–6, and Taylor recorded 15.5 sacks after his return from the suspension. They surged to a 12–4 record in 1989, but lost to the Los Angeles Rams in their opening playoff game when Flipper Anderson caught a 47-yard touchdown pass to give the Rams a 19–13 overtime win.</p>
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