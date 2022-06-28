<?php
    include 'includes/connect.php';

    if(isset($_GET['delete'])){
        $reisID = $_GET['delete'];

        $sql = "DELETE FROM reizen WHERE reisID = :reisID";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':reisID', $reisID);
        $stmt->execute();
        
        header('Location: adminpage.php');
        exit();
        }
?>