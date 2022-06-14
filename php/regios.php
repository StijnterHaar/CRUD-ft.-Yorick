<?php


     
$sql = "SELECT DISTINCT * FROM `reizen`";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $value) {
            echo $value['regio']; ?> <br> <?php
}

                $producten = $stmt2->fetchAll();
                foreach ($producten as $product) {
                    ?> <li><?php echo $product['stad']; ?>, <?php echo $product['land']; ?> </a></li> <?php
                }

            
            ?> 