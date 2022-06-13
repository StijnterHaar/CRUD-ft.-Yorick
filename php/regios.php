<?php


     
                $sql2 = "SELECT DISTINCT * FROM `regio`";
                $stmt2 = $connect->prepare($sql2);
                $stmt2->execute();

                $producten = $stmt2->fetchAll();
                foreach ($producten as $product) {
                    ?> <li><?php echo $product['stad']; ?>, <?php echo $product['land']; ?> </a></li> <?php
                }

            
            ?> 