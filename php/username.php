<?php

// Include config file
require_once("includes/connect.php");

 
// Define variables and initialize with empty values
$new_username = $confirm_username = "";
$new_username_err = $confirm_username_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new username
    if(empty(trim($_POST["new_username"]))){
        $new_username_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_username"])) < 6){
        $new_username_err = "Password must have atleast 6 characters.";
    } else{
        $new_username = trim($_POST["new_username"]);
    }
        
    // Check input errors before updating the database
    if(empty($new_username_err)){
        // Set parameters
        $param_username = $new_username;
        $param_id = $_SESSION["id"];

        
        $sql = "UPDATE gebruikers SET username = :username WHERE gebruikerID = :gebruikerID";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":username", $param_username);
        $stmt->bindParam(":gebruikerID", $param_id);
        $stmt->execute();
        
        echo $param_id;
        echo $param_username;

        session_destroy();
        header("location: ../persoonlijk.php");
        exit();
    }
    
    // Close connection
    $link = mysqli_connect($host, $user, $pass, $db);
    mysqli_close($link);
}

?>