<?php
// Include config file
require_once "includes/connect.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT gebruikerID FROM gebruikers WHERE username = ?";
        $link = mysqli_connect($host, $user, $pass, $db);
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO gebruikers (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


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

            </div>
        </nav>

        <nav class="header-bottom">

            <ul class="header-bottom-box">

            </ul>
        </nav>
    </header>
    <div class="form-popup" id="myForm">
    </div>
    <div class="top-box">
        <div class="box-container" style="padding-top: 10px;">
            <div class="locations-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
            <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
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
                        <p><i class="fa-solid fa-location-dot"></i> 30/20, Heyendaal, Nijmegen, The Netherlands</p>
                        <p><i class="fa-solid fa-phone"></i> +31 6 13 26 34 33</p>
                        <p><i class="fa-solid fa-envelope-circle-check"></i> Revera@gmail.com</p>
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
                            <a href="overons.php" class="footer-column-menu-item-link">Over ons</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="termsofuse.php" class="footer-column-menu-item-link">Terms of Use</a>
                        </li>
                        <li class="footer-column-menu-item">
                            <a href="legalinformation.php" class="footer-column-menu-item-link" role="menuitem">Legal Information</a>
                        </li>
                        <li class="footer-column-menu-item" role="menuitem">
                            <a href="klantenservice.php" class="footer-column-menu-item-link">Stuur ons een
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
 
