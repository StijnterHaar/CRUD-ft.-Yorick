<?php


     
$sql = "SELECT DISTINCT * FROM `reizen`";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $value) {
            echo $value['regio']; ?> <br> <?php
}

<<<<<<< HEAD
=======
                $producten = $stmt2->fetchAll();
                foreach ($producten as $product) {
                    ?> <li><?php echo $product['stad']; ?>, <?php echo $product['land']; ?> </a></li> <?php
                }

            
>>>>>>> cb9b7f223c500a56888868d674cbcb82e9e0364b
            ?> 