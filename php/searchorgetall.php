<?php
if (isset($_GET["search"])) {
    $sql = "SELECT * FROM `reizen` WHERE `locatie` LIKE :zoek";
    $stmt = $connect->prepare($sql);
    $zoek = "%" . $_GET['search'] . "%";
    $stmt->bindParam(":zoek", $zoek);

    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<p>Resultaten voor zoekactie: </p>";
    foreach ($result as $value) {
    ?>  



            <div class="stay-item">
                <img src=<?php echo $value['foto']; ?>>

                <div class="stay-info">
                <div class="stay-info-left">

                    <h1><?php echo $value['locatie']; ?></h1>
                    <p>Kosten: €<?php echo $value['kosten']; ?></p>
                    <p>Vanaf vliegveld: <?php echo $value['beginplek']; ?></p>
                    <p>Naar vliegveld: <?php echo $value['eindplek']; ?></p>
                    </div>
                    <div class="stay-info-right">
                    
                    <?php 
                    if ($value['retour'] == 1)  
                       echo "Retour: Ja <br>" . "Startdatum: " . $value['startDatum'] . "<br>" . "Einddatum: " . $value['eindDatum'];
                    else    
                       echo "Retour: Nee <br>" . "Startdatum: " . $value['startDatum'] 
                    ?>

                    </div>

                </div>
            </div>
         <?php
    }
}


if (isset($_POST["search"])) {

            $sql = "SELECT * FROM `reizen` WHERE `locatie` LIKE :term";
            $stmt = $connect->prepare($sql);
            $term = "%" . $_POST['term'] . "%";
            $stmt->bindParam(":term", $term);

            $stmt->execute();
            $result = $stmt->fetchAll();
            echo "<p><Resultaten voor zoekactie: </p>";
            foreach ($result as $value) {
            ?>  



                    <div class="stay-item">
                        <img src=<?php echo $value['foto']; ?>>

                        <div class="stay-info">
                        <div class="stay-info-left">

                            <h1><?php echo $value['locatie']; ?></h1>
                            <p>Kosten: €<?php echo $value['kosten']; ?></p>
                            <p>Vanaf vliegveld: <?php echo $value['beginplek']; ?></p>
                            <p>Naar vliegveld: <?php echo $value['eindplek']; ?></p>
                            </div>
                            <div class="stay-info-right">
                            
                            <?php 
                            if ($value['retour'] == 1)  
                               echo "Retour: Ja <br>" . "Startdatum: " . $value['startDatum'] . "<br>" . "Einddatum: " . $value['eindDatum'];
                            else    
                               echo "Retour: Nee <br>" . "Startdatum: " . $value['startDatum'] 
                            ?>

                            </div>
                            <a href="reisinformatie.php?id=<?php echo $value['reisID']; ?>">
                                        <span style="display: block;">
                                            <button class="reverabutton rightbtn">
                                                <span class="material-symbols-outlined">
                                                     flight
                                                </span>
                                            </button>
                                        </span>
                             </a>
                        
                        </div>
                    </div>
                <?php
                }
            } else {
                
            $sql = "SELECT * FROM `reizen`";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            echo "<p>Alle reizen: </p>";
            foreach ($result as $value) {
            ?>  



                    <div class="stay-item">
                        <img src=<?php echo $value['foto']; ?>>

                        <div class="stay-info">
                        <div class="stay-info-left">

                            <h1><?php echo $value['locatie']; ?></h1>
                            <p>Kosten: €<?php echo $value['kosten']; ?></p>
                            <p>Vanaf vliegveld: <?php echo $value['beginplek']; ?></p>
                            <p>Naar vliegveld: <?php echo $value['eindplek']; ?></p>
                            </div>
                            <div class="stay-info-right">
                            
                            <?php 
                            if ($value['retour'] == 1)  
                               echo "Retour: Ja <br>" . "Startdatum: " . $value['startDatum'] . "<br>" . "Einddatum: " . $value['eindDatum'];
                            else    
                               echo "Retour: Nee <br>" . "Startdatum: " . $value['startDatum'] 
                            ?>

                            </div>
                            <a href="reisinformatie.php?id=<?php echo $value['reisID']; ?>">
                                        <span style="display: block;">
                                            <button class="reverabutton rightbtn">
                                                <span class="material-symbols-outlined">
                                                     flight
                                                </span>
                                            </button>
                                        </span>
                             </a>
                        
                        </div>
                    </div>
                    <?php 
            }}
                        ?>
            