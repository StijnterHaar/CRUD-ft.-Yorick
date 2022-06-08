<!DOCTYPE html>
<?php include('includes/connect.php'); ?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/cfd87a559f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sccs/test.scss">
    <title>Revera.com</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
</head>

<body>
    <header class="main-header">
        <nav class="header-top">
            <div class="header-left">
                <a href="index.php">
                    <img class="header-image" src="images/logo.png">
                </a>
            </div>
            <div class="header-right">
                <div class="header-group-item"><a href="verblijven.html"><b>Bestemmingen</b></a></div>
                <div class="header-group-item"><a href="klantenservice.html">Klantenservice</a></div>
                <div class="header-group-item"><a href="index.php">Home</a></div>
                <div class="header-group-item login marginleft"><a onclick="openForm()">Login</a></div>
                <div class="header-group-item login"><a onclick="openForm()">Register</a></div>
            </div>
        </nav>
        <nav class="header-bottom">
            <ul class="header-bottom-box">
                <li class="header-bottom-item"><i class="fa-solid fa-bed"></i><a href="index.html">Hotels</a>
                </li>
                <li class="header-bottom-item "><i class="fa-solid fa-plane-departure"></i><a href="#">Vluchten</a></i>
                <li class="header-bottom-item"><i class="fa-solid fa-car"></i><a href="autoverhuur.html">Autoverhuur</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="form-popup" id="myForm">
        <form action="validate.php" method="post">
            <div class="login-box">
                <h1>Login</h1>
                <div class="progress">
                    <div class="progress-value"></div>
                </div>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" placeholder="Username" name="adminname" value="">
                </div>
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Password" name="password" value="">
                </div>
                <input class="button" type="submit" name="login" value="Sign In">
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </div>
        </form>
    </div>
    <div class="top-box">
        <div class="box-container">
            <div class="box-title">
                <h1>Populaire vliegmaatschapijen</h1>
            </div>
            <ul class="locations-container2" id="scrollbarlijstauto">
                <li class="autolijst">
                    <div class="autoverhuurlogos">
                        <img  src="https://i0.wp.com/insideflyer.nl/wp-content/uploads/2019/05/KLM-logo.png?ssl=1">
                    </div>
                </li>
                <li class="autolijst">
                    <div class="autoverhuurlogos">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Ryanair_logo_new.svg/1024px-Ryanair_logo_new.svg.png" style="width: 150px; height: 30px; margin-top: 10px;">
                    </div>
                </li>
                <li class="autolijst">
                    <div class="autoverhuurlogos">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/EasyJet_logo.svg/1280px-EasyJet_logo.svg.png" style="width: 150px; height: 30px; margin-top: 10px;">
                    </div>
                </li>
                <li class="autolijst">
                    <div class="autoverhuurlogos">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/TUI_Logo_2016.svg/2560px-TUI_Logo_2016.svg.png">
                    </div>
                </li>
                <li class="autolijst">
                    <div class="autoverhuurlogos">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Lufthansa_Logo_2018.svg/1280px-Lufthansa_Logo_2018.svg.png" style="width: 150px; height: 30px; margin-top: 10px;">
                    </div>
                </li>
                <li class="autolijst">
                    <div class="autoverhuurlogos">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Transavia_logo.svg/2560px-Transavia_logo.svg.png" style="width: 150px; height: 30px; margin-top: 10px;">
                    </div>
                </li>
                

            </ul>
        </div>
    <div class="stays-all">
        <div class="stays">
            <div class="popular-stays">
                <div class="sugg">
                    <img src="https://i.ibb.co/pK6TVYR/losangeles.png" alt="LA" style="width:100%">
                    <p>Los Angeles, USA</p>
                </div>
                <div class="sugg">
                    <img src="https://i.ibb.co/pK6TVYR/losangeles.png" alt="LA" style="width:100%">
                    <p>Los Angeles, USA</p>
                </div>
                <div class="sugg">
                    <img src="https://i.ibb.co/pK6TVYR/losangeles.png" alt="LA" style="width:100%">
                    <p>Los Angeles, USA</p>
                </div>
                <div class="sugg">
                    <img src="https://i.ibb.co/pK6TVYR/losangeles.png" alt="LA" style="width:100%">
                    <p>Los Angeles, USA</p>
                </div>
                <div class="sugg">
                    <img src="https://i.ibb.co/pK6TVYR/losangeles.png" alt="LA" style="width:100%">
                    <p>Los Angeles, USA</p>
                </div>
            </div>
            <div class="stays2">
                <div class="left">
                    <p>Zoeken op locatie</p>
                    <div class="left-search">
                        <input class="reverainput" id="name" placeholder="Locatie of omgeving"> <button
                            class="reverabutton" id="send">Zoek</button>
                    </div>
                    <ul class="flightlist">
                    <p><b>Wij vliegen zowel naar:</b> </p>
                         <?php include('php/regios.php'); ?> 
                    </ul>
                </div>
                <div class="right">
                <ul>
                <li>
                <?php include('php/reizen.php'); ?> 
                </li>    
                </ul>
                
                </div>
            </div>
</body>

</html>
<script src="javascript/code.js"></script>