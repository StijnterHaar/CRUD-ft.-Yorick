<?php
// Initialize the session 
// Check if the user is logged in, otherwise redirect to login pag
 
include('login.php');
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
    <div class="top-box">
        <div class="box-container" style="padding-top: 10px;">
            <div class="box-title" style="margin-left: 30px;">
                <h1>Persoonlijke Informatie</h1>
                <p><?php
                if (isset($_POST['username'])){
                    $username = $_POST["username"];

                    $id = $_SESSION["gebruikerID"];
                    $stmt = $con->prepare("UPDATE gebruikers SET username = ? WHERE id = ?");
                    $stmt->bind_param("si",$username,$id);
                    $stmt->execute();
                }
                ?></p>
            </div>
            <div class="locations-container" style="display: flex; flex-wrap: wrap;">
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-list-check fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <form action="php/username.php" method="POST"> 
                                <div class="form-group">
                                    <h2>New gebruikersnaam</h2>
                                    <input type="text" name="new_username" class="form-control <?php echo (!empty($new_username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_username; ?>">
                                    <span class="invalid-feedback"><?php echo $new_username_err; ?></span>
                                    <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                               
                            </form>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-sliders fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Uitloggen</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Niet je wachtwoord vergeten hé ;)</p>
                        <a href="php/logout.php" style="color: #467fd3; padding-left: 10px;">Klik om uit te loggen</a>
                    </div>
                </div>
                <div class="settings-container">
                    <div class="settings-icons"><span class="fa-solid fa-bell fa-xl settings-icon"></span></div>
                    <div class="settings-info" style="text-align: left;">
                        <h2 style="padding-top: 25px; padding-left: 10px;">Email notificaties</h2>
                        <p style="padding-left: 10px; margin-bottom: 20px;">Update je persoonlijke notificaties</p>
                        <a href="#" style="color: #467fd3; padding-left: 10px;">Beheer notificaties</a>
                    </div>
                </div>password
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
                        <div class="wrapper">
                            <form action="php/password.php" method="post"> 
                                <div class="form-group">
                                    <h2>New Password</h2>
                                    <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                                    <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                                    <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                               
                            </form>
                        </div> 
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