<?php

            $sql = "SELECT * FROM `recensies`";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $value) {
            $huidigeReis = $_GET['id'];
            $recensieReis = $value['reisID'];

            if ($huidigeReis == $recensieReis) {
                ?>
                <div class="recensie">
                <h2> <?php echo $value['gebruikerNaam'];?> </h2>
                <h3> <?php echo $value['titel'];?> - <?php echo $value['rating'];?> sterren</h3>
                <p> <?php echo $value['comment'];?> </h2>
                </div>
                <?php
            }
            }   

            if (isset($_POST["plaatsRecensie"])) {
                $sql = "INSERT INTO `recensies` (`recensieID`, `titel`, `gebruikerID`, `gebruikerNaam`, `reisID`, `rating`, `comment`) VALUES (NULL, :titel, :gebruikerID, :gebruikerNaam, :reisID, :rating, :comment);";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(":gebruikerID", $_SESSION['id']);
                $stmt->bindParam(":gebruikerNaam", $_SESSION['username']);
                $stmt->bindParam(":reisID", $_GET['id']);
                $stmt->bindParam(":rating", $_POST['rating']);
                $stmt->bindParam(":comment", $_POST['recensietext']);
                $stmt->bindParam(":titel", $_POST['recensietitel']);

                $stmt->execute();

            }
            ?> 