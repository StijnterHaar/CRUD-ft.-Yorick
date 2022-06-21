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
    <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="login-box">
                <h1>Login</h1>
                <div class="progress">
                    <div class="progress-value"></div>
                </div>

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
            <div class="contactform">
                <h2>Terms Of Use</h2>
                <p>Why does revera.com collect and use your personal data?
We use the information collected about you for a variety of purposes. Your personal data may be used in the following ways:

Trip Reservations: First and foremost, we use your personal data to complete and administer your online Trip Reservation – which is essential for us to provide this service for you. This includes sending you communications that relate to your Trip Reservation, such as confirmations, modifications and reminders. In some cases, this may also include processing your personal data to enable online check-in with the Trip Provider or processing personal data in relation to possible damage deposits.

Customer service: We provide international customer service from our local offices in more than 20 languages, and we’re here to help 24 hours a day, 7 days a week. Sharing relevant details, such as reservation information or information about your user account with our global customer service staff allows us to respond when you need us. This includes helping you to contact the right Trip Provider and responding to any questions you might have about your Trip Reservation (or any other queries, for that matter).

Account facilities: revera.com users can create an account on our website or apps. We use the information you give us to administer this account, allowing you to do a number of useful things. You can manage your Trip Reservations, take advantage of special offers, make future Trip Reservations easily and manage your personal settings.

Managing personal settings gives you the ability to keep and share lists, share photos, easily see Trip Services you’ve searched for and check travel-related information you’ve provided. You can also see any reviews you’ve written.

If you want to, you can share certain information as part of your user account, by creating a public profile under your own first name or a screen name you choose.

If you’re a revera.com for Business account holder, you can also save contact details under that account, manage business reservations and link other account holders to the same revera.com for Business account.

Online groups: We give account holders the chance to connect and interact with each other through online groups or forums, such as travel communities.

Marketing activities: We use your information for marketing activities. These activities include:

Using your contact information to send you regular news about travel-related products and services. You can unsubscribe from email marketing communications quickly, easily and at any time. All you need to do is click on the ‘Unsubscribe’ link included in each newsletter or other communication.

Based on your information, individualised offers might be shown to you on the revera.com website, in mobile apps or on third-party websites/apps (including social media sites) and the content of the site displayed to you might be personalised. These could be offers that you can book directly on the revera.com website, on co-branded sites, or other third-party offers or products we think you might find interesting.

When you participate in other promotional activities (such as sweepstakes, referral programmes or competitions), only relevant information will be used to administer these promotions.

Communicating with you: There might be other times when we get in touch, including by email, by chatbot, by post, by phone or by texting you. Which method we choose depends on the contact information you’ve previously shared.

We process the communications you send to us. There could be a number of reasons for this, including:

Responding to and handling any requests you or your booked Trip Provider have made. revera.com also offers customers and Trip Providers various ways to exchange information, requests and comments about Trip Providers and existing Trip Reservations via revera.com. For more information, read the section titled ‘How does revera.com process communications that you and your Trip Provider send through revera.com?’.

If you have started but not finished a Trip Reservation online, we might contact you to invite you to continue with your reservation. We believe that this additional service benefits you as it allows you to pick up the process where you left off without having to search for a Trip Provider or fill in your reservation details again.

When you use our services, we might send you a questionnaire or invite you to provide a review about your experience with revera.com or the Trip Provider.

We also send you other material related to your Trip Reservations, such as how to contact revera.com if you need assistance while you’re away, and information that we feel might be useful to you in planning or getting the best out of your Trip. We might also send you material related to upcoming Trip Reservations or a summary of previous Trip Reservations you made through revera.com.

Even if you don’t have an upcoming Trip Reservation, we may still need to send you other administrative messages, which could include security alerts.

In case of misconduct, we may send you a notice and/or warning.

Market research: We sometimes invite our customers to take part in market research. Please see the information that accompanies this kind of invitation to understand what personal data will be collected and how that data is used.

Improving our services: We also use personal data for analytical purposes and product improvement. This is part of our commitment to making our services better and enhancing the user experience.

In this case, we use data for testing and troubleshooting purposes, as well as to generate statistics about our business. The main goal here is to get insights into how our services perform, how they are used, and ultimately to optimise and customise our website and apps, making them easier and more meaningful to use. As much as possible, we strive to use anonymised and de-identified personal data for this analytical work.

Providing the best price applicable to you, depending on where you are based: When you search our apps or website, for example to find an accommodation, a rental car or a flight, we process your IP address to confirm whether you are in the European Economic Area (EEA) or in another country. We do this to offer you the best price for the region (EEA) or country (non-EEA) where you are based.

Customer reviews and other destination-related information: During and after your Trip, we might invite you to submit a review. We can also make it possible for the people you’re travelling with or whom you’ve booked a reservation for to do this instead. This invite asks for information about the Trip Provider or the destination.

If you have a revera.com account, you can choose to display a screen name next to your review, instead of your real name. If you’d like to set a screen name, you can do that in your account settings. Adding an avatar is also possible.

By completing a review, you’re agreeing that it can be displayed (as described in detail in our Terms and Conditions) on, for example, the relevant Trip Provider information page on our websites, on our mobile apps, on our social media accounts and social media apps, or on the online platform of the relevant Trip Provider or business partner’s website. This is to inform other travellers about the quality of the Trip Service you used, the destination you have chosen or any other experiences you choose to share.

Call monitoring: When you make calls to our customer service team, revera.com uses an automated telephone number detection system to match your telephone number to your existing reservations. This can help save time for both you and our customer service staff. However, our customer service staff may still ask for authentication, which helps to keep your reservation details confidential.

During calls with our customer service team, live listening might be carried out or calls might be recorded for quality control and training purposes. This includes the usage of the recordings for the handling of complaints, legal claims and for fraud detection.

We do not record all calls. In the case that a call is recorded, each recording is kept for a limited amount of time before being automatically deleted. This is unless we have determined that it’s necessary to keep the recording for fraud investigation or legal purposes. You can read more about this below.

Promotion of a safe and trustworthy service: To create a trustworthy environment for you, the people you bring with you on your Trip, revera.com’s business partners and our Trip Providers, we continuously analyse and use certain personal data to detect and prevent fraud and other illegal or unwanted activities.

Similarly, we use personal data for risk assessment and security purposes, including when you report a safety concern, or for the authentication of users and reservations. When we do this we may have to stop or put certain Trip Reservations on hold until we’ve finished our assessment.

Legal purposes: Finally, in certain cases, we may need to use your information to handle and resolve legal claims and disputes, for regulatory investigations and compliance, to enforce the revera.com online reservation service terms of use or to comply with lawful requests from law enforcement.

Providing your personal data to revera.com is voluntary. However, we may only be able to provide you with certain services if we can collect some personal data. For instance, we can’t process your Trip Reservation if we don’t collect your name and contact details.

If we use automation to process personal data which produces legal effects or similarly significantly affects you, we’ll always implement the necessary measures to safeguard your rights and freedoms. This includes the right to obtain human intervention.

To process your personal data as described above, we rely on the following legal bases:
As applicable, for purpose A and B, revera.com relies on the legal basis that the processing of personal data is necessary for the performance of a contract, specifically to finalise and administer your Trip Reservation.

If the required personal data is not provided, revera.com cannot finalise the Trip Reservation, nor can we provide customer service. In view of purposes C to L, revera.com relies on its (or third parties’) legitimate interest, to provide and improve services and to prevent fraud and other illegal acts (as set out more specifically under C to L).

When using personal data to serve revera.com’s or a third party's legitimate interest, revera.com will always balance your rights and interests in the protection of your personal data against revera.com’s rights and interests or those of the third party. For purposes M, revera.com also relies, where applicable, on compliance with legal obligations (such as lawful law enforcement requests).

Finally, where needed under applicable law, revera.com will obtain your consent prior to processing your personal data, including for email marketing purposes or as otherwise required by law.

If you wish to object to the processing set out under C to L and no opt-out mechanism is available to you directly (for example, in your account settings), please contact us at dataprotectionoffice@revera.com.
                </p>
                
               
            </div>
        </div>
    </div>
    </div>

    

</body>

</html>

<script src="javascript/code.js"></script>