<?php

            $sql = "SELECT * FROM `reizen`";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $value) {
            ?>

                    <div  class="stay-item">
                        <img src=<?php echo $value['foto']; ?>>

                        <div class="stay-info">
                        <div class="stay-info-left">

                            <h1><?php echo $value['locatie']; ?></h1>
                            <p>Kosten: €<?php echo $value['kosten']; ?></p>
                            <p>Vanaf vliegveld: <?php echo $value['beginplek']; ?></p>
                            <p>Naar vliegveld: <?php echo $value['eindplek']; ?></p>
                            </div>
                            <div    class="stay-info-right">
                            
                            <?php 
                            if ($value['retour'] == 1)  
                               echo "Retour: Ja <br>" . "Startdatum: " . $value['startDatum'] . "<br>" . "Einddatum: " . $value['eindDatum'];
                            else    
                               echo "Retour: Nee <br>" . "Startdatum: " . $value['startDatum'] 
                            ?>


                         
                        </div>
                        <a href="reisinformatie.php?id=<?php echo $value['reisID']; ?>">
                                        <span style="display: block;">
                                            <button class="reverabutton">Informatie / Boeken</button>
                                        </span>
                             </a>
                    </div>
                    </div>
                               
                 <?php
                }
                
                
            ?> 