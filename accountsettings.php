<?php
// Initialize the session
session_start();

// Include config file
require_once "includes/connect.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT gebruikerID, username, password FROM gebruikers WHERE username = ?";
        $link = mysqli_connect($host, $user, $pass, $db);
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    $link = mysqli_connect($host, $user, $pass, $db);
    mysqli_close($link);
}
?>

<!DOCTYPE html>
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
                <div class="header-group-item"><a href="reizen.php">Bestemmingen</a></div>
                <div class="header-group-item"><a href="klantenservice.php">Klantenservice</a></div>
                <div class="header-group-item"><a href="index.php">Home</a></div>

                <div class="header-group-item login marginleft"><?php
                include('includes/connect.php'); // Includes Login Script
                if(isset($_SESSION['username']))
                echo "<a href='accountsettings.php'>" . $_SESSION['username'] . "</a>";
            else
                echo '<a class="catolag-list-items" onclick="openForm()">Login</a>';
                ?> </div>
                <div class="header-group-item login"><?php
                include('includes/connect.php'); // Includes Login Script
                if(isset($_SESSION['username']))
                echo "<a style='display:none'>" . $_SESSION['username'] . "</a>";
            else
                echo '<a class="catolag-list-items" href="register.php">Register</a>';
                ?></div>

            </div>
        </nav>

        <nav class="header-bottom">

            <ul class="header-bottom-box">
                <li class="header-bottom-item"><i class="fa-solid fa-bed"></i><a href="index.php">Hotels</a>
                </li>
                <li class="header-bottom-item "><i class="fa-solid fa-plane-departure"></i><a
                        href="vluchten.php">Vluchten</a></i>
                <li class="header-bottom-item"><i class="fa-solid fa-car"></i><a href="autoverhuur.php">Autoverhuur</a>
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
        <div class="box-container" style="padding-top: 10px;">
            <div class="box-title" style="margin-left: 30px;">
                <h1>Account Instellingen</h1>
                <p>Beheer je instellingen</p>
            </div>
            <div class="locations-container" style="display: flex; flex-wrap: wrap;">
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-list-check fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Persoonlijke informatie</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Update je persoonlijke informatie</p>
                        <a href="#" style="color: #467fd3; padding-left: 10px;">Beheer informatie</a>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-sliders fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Voorkeuren</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Update je persoonlijke vookeuren</p>
                        <a href="#" style="color: #467fd3; padding-left: 10px;">Beheer vookeuren</a>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-bell fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Email notificaties</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Update je persoonlijke notificaties</p>
                        <a href="#" style="color: #467fd3; padding-left: 10px;">Beheer notificaties</a>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-credit-card fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Betalings instellingen</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Update je persoonlijke betalings
                            instellingen</p>
                        <a href="#" style="color: #467fd3; padding-left: 10px;">Beheer betalings instellingen</a>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-egg fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Easteregg</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">:)</p>
                        <a href="#" style="color: blue; padding-left: 10px;"></a>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-lock fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Beveiliging</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Update je persoonlijke beveiliging</p>
                        <a href="#" style="color: blue; padding-left: 10px;">Beheer beveiliging</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="box-container"></div>
    </div>

    <div class="footer">
        <footer id="site-footer">
            <section class="horizontal-footer-section" id="footer-middle-section">
                <div id="footer-about" class="footer-columns footer-columns-large">
                    <h1>Ons adress</h1>
                    <address>
                        <p><i class="fa-solid fa-location-dot"></i> 30/20, Verkhy street, Moscow, Russia</p>
                        <p><i class="fa-solid fa-phone"></i> 7 (800) 555–35–35</p>
                        <p><i class="fa-solid fa-envelope-circle-check"></i> noreply@reply.io</p>
                        <p><i class="fa-solid fa-clock"></i> 8:00 AM – 8:00 PM</p>
                    </address>
                </div>
                <div class="footer-columns">
                    <h1>Overzicht</h1>
                    <ul class="footer-column-menu" role="menu">
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Services </a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Pricing</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Portfolio</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">News</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-columns">
                    <h1>Bronnen</h1>
                    <ul class="footer-column-menu" role="menu">
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">FAQ</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Media</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Guides</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Free Resources</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Testimonials</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-columns">
                    <h1>Informatie</h1>
                    <ul class="footer-column-menu" role="menu">
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Over ons</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Terms of Use</a>
                        </li>
                        <li class="footer-column-menu-item">
                            <a href="#" class="footer-column-menu-item-link" role="menuitem">Legal Information</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="klantenservice.html" class="footer-column-menu-item-link">Stuur ons een
                                berichtje</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="#" class="footer-column-menu-item-link">Laat feedback achter</a>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="horizontal-footer-section" id="footer-bottom-section">
                <div id="footer-copyright-info">
                    &copy; ROC Nijmegen Inc. 2022. All rights reserved.
                </div>
                <div id="footer-social-buttons">
                    <img src="https://img.icons8.com/ios-filled/25/999999/facebook--v1.png" />
                    <img src="https://img.icons8.com/ios-filled/25/999999/telegram-app.png" />
                    <img src="https://img.icons8.com/ios-filled/25/999999/pinterest--v1.png" />
                    <img src="https://img.icons8.com/ios-filled/25/999999/instagram--v1.png" />
                </div>
            </section>

        </footer>

    </div>



</body>

</html>
<script src="javascript/code.js"></script>