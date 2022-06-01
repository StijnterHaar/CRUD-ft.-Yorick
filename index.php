
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
                <a href="index.html">
                    <img class="header-image" src="images/logo.png">
                </a>
            </div>
            <div class="header-right">
                <div class="header-group-item"><a href="verblijven.html">Bestemmingen</a></div>
                <div class="header-group-item"><a href="klantenservice.html">Klantenservice</a></div>
                <div class="header-group-item"><a href="index.html"><b>Home</b></a></div>

                <div class="header-group-item login marginleft"><a onclick="openForm()">Login</a></div>
                <div class="header-group-item login"><a onclick="openForm()">Register</a></div>

            </div>
        </nav>

        <nav class="header-bottom">

            <ul class="header-bottom-box">
                <li class="header-bottom-item selected"><i class="fa-solid fa-bed"></i><a href="index.html">Hotels</a>
                </li>
                <li class="header-bottom-item "><i class="fa-solid fa-plane-departure"></i><a
                        href="vluchten.html">Vluchten</a></i>
                <li class="header-bottom-item"><i class="fa-solid fa-car"></i><a href="autoverhuur.html">Autoverhuur</a>
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
    <?php
                include('php/validate.php'); // Includes Login Script
                if(isset($_SESSION['login_user']))
                echo "<a href='adminpage.php' style='color:white; padding-top: 15px; font-size: 15px;'>","Ingelogd als:  " . $_SESSION['login_user'] . "</a>";
            else
                echo '<a class="catolag-list-items" onclick="openForm()">Login</a>';
                ?> 
        <form action="validate.php" method="post">
            <div class="login-box">
                <h1>Login</h1>
                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="progress">
                    <div class="progress-value"></div>
                </div>

                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" placeholder="Username" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $gebruikersnaam; ?></span>
                </div>

                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>>
                </div>

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
                <article class="card card--1">
                    <div class="card__info-hover">

                    </div>
                    <div class="card__img">
                        <img src="cardimages/amsterdam.jpg">
                    </div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title">Amsterdam</h3>
                        <span class="card__by">Door <a href="#" class="card__author" title="author">D-reizen
                            </a></span>
                    </div>
                </article>


                <article class="card card--1">
                    <div class="card__info-hover">
                        <svg class="card__like" viewBox="0 0 24 24">
                            <path fill="#000000"
                                d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>

                    </div>
                    <div class="card__img">
                        <img src="cardimages/berlin.jpg">
                    </div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title">Germany ~ berlin</h3>
                        <span class="card__by">Door <a href="#" class="card__author" title="author">Lufthansa</a></span>
                    </div>
                </article>

                <article class="card card--1">
                    <div class="card__info-hover">
                        <svg class="card__like" viewBox="0 0 24 24">
                            <path fill="#000000"
                                d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>

                    </div>
                    <div class="card__img"> <img src="cardimages/ibiza.jpg"></div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title">Ibiza</h3>
                        <span class="card__by">Door <a href="#" class="card__author" title="author">TUI </a></span>
                    </div>
                </article>

                <article class="card card--1">
                    <div class="card__info-hover">
                        <svg class="card__like" viewBox="0 0 24 24">
                            <path fill="#000000"
                                d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>

                    </div>
                    <div class="card__img"> <img src="cardimages/amsterdam.jpg"></div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title">Discover the sea</h3>
                        <span class="card__by">Door <a href="#" class="card__author" title="author">John Doe</a></span>
                    </div>
                </article>

            </ul>
        </div>
        <div class="box-container2">
            <ul class="locations-container">
                <article class="big-card card--1">
                    <div class="card__info-hover">

                    </div>
                    <div class="card__img"> <img src="cardimages/amsterdam.jpg"></div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title">The Netherlands ~ Amsterdam</h3>
                        <span class="card__by">by <a href="#" class="card__author" title="author">D-reizen
                            </a></span>
                    </div>
                </article>


                <article class="big-card card--2">
                    <div class="card__info-hover">
                        <svg class="card__like" viewBox="0 0 24 24">
                            <path fill="#000000"
                                d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>

                    </div>
                    <div class="card__img"> <img src="cardimages/berlin.jpg"></div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Reizen</span>
                        <h3 class="card__title">Germany ~ berlin</h3>
                        <span class="card__by">by <a href="#" class="card__author" title="author">Lufthansa</a></span>
                    </div>
                </article>

            </ul>
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