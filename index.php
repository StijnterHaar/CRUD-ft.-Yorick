<?php
// Initialize the session
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
                <div class="header-group-item"><a href="index.php"><b>Home</b></a></div>

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
                ?>
            </div>

            </div>
        </nav>

        <nav class="header-bottom">

            <ul class="header-bottom-box">
                <li class="header-bottom-item selected"><i class="fa-solid fa-bed"></i><a href="index.php">Hotels</a>
                </li>
                <li class="header-bottom-item "><i class="fa-solid fa-plane-departure"></i><a
                        href="reizen.php">Vluchten</a></i>
                <li class="header-bottom-item"><i class="fa-solid fa-car"></i><a href="autoverhuur.php">Autoverhuur</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="cover">
        <h1 class="coverlabel" style="color: white; margin-bottom: 10px;">Ontdek wat er is</h1>
        <form class="flex-form">
            <label for="from">
                <i class="ion-location"><i class="fa-solid fa-magnifying-glass"></i></i>
            </label>
            <input type="search" placeholder="Waar wil je naar toe?">
            <input type="submit" value="Zoeken">
        </form>
    </div>
    <div class="form-popup" id="myForm">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="login-box">
                <h1>Login</h1>
                <div class="progress">
                    <div class="progress-value"></div>
                </div>

                <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>

                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Password" name="password" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                <input class="button" type="submit" name="login" value="Sign In">
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </div>
        </form>
    </div>
    <div class="top-box">
        <div class="box-container">
            <div class="box-title">
                <h1>Populaire Reizen</h1>
                <p>Deze populaire bestemmingen hebben van alles te bieden</p>
            </div>
            <ul class="locations-container">
            <?php
            $sql = "SELECT * FROM `reizen`";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $value) {
            ?>
                <article class="card card--1">
                    <div class="card__info-hover">

                    </div>
                    <div class="card__img">
                        <img href="#asd" src=<?php echo $value['foto']; ?>>
                    </div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title"><?php echo $value['locatie']; ?></a></h3>
                        <span class="card__by">Door <a  class="card__author" title="author">D-reizen
                            </a></span>
                            <a href="reisinformatie.php?id=<?php echo $value['reisID']; ?>">
                                        <span style="display: block;">
                                            <button style=" width:130px; float:right; margin-top:-30px; margin-bottom:30px;" class="reverabutton rightbtn">
                                                Informatie
                                            </button>
                                        </span>
                             </a>
                    </div>

                </article>

                <?php
                }
                
            ?> 

            </ul>
        </div>
        <div class="box-container2">
        
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