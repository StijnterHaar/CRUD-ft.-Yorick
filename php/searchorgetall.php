<?php
if (isset($_POST["search"])) {
    $sql = "SELECT * FROM voorraad WHERE regio=:term";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(":term", $_POST['term']);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $value) {
    ?>       
                   <p>resultaat</p>
     <?php
    }
} else {
    include_once ('php/reizen.php');
}
?>