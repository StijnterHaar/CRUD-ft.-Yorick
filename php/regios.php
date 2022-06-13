<?php


     
$sql = "SELECT DISTINCT * FROM `reizen`";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $value) {
            echo $value['regio']; ?> <br> <?php
}

            ?> 