<?php

// Include config file
require_once("../includes/connect.php");
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Set parameters
        $param_password = password_hash($new_password, PASSWORD_DEFAULT);
        $param_id = $_SESSION["id"];

        
        $sql = "UPDATE gebruikers SET password = :password WHERE gebruikerID = :gebruikerID";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":password", $param_password);
        $stmt->bindParam(":gebruikerID", $param_id);
        $stmt->execute();
        
        echo $param_id;
        echo $param_password;

        session_destroy();
        header("location: ../persoonlijk.php");
        exit();
    }
    
    // Close connection
    $link = mysqli_connect($host, $user, $pass, $db);
    mysqli_close($link);
}

?>