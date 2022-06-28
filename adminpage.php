
<?php


include 'includes/connect.php';
session_start();


if(isset($_SESSION['admin']) == 1){
    echo "Admin!";
}
else{
    header("Location:index.php");
}

if (isset($_SESSION['username']) == true) {
} else {
    header("Location:index.php");
} 

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <title>Admin</title>
    <script src="https://kit.fontawesome.com/cfd87a559f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="rightbar">
        <div class="leftbar">
            <a style="margin-left: 20px; color: white;">Admin Page</a>
            <div class="line"></div>
            <div class="leftitems">
                <i class="fa-solid fa-house-chimney"><a style="color: white; margin-left: 5px;"
                        href="index.php">Home</a></i>
                <i class="fa-solid fa-envelope"
                    style="background-color: #db2068; box-shadow: -0.55rem 0 0 #db2068, 3.35rem 0 0 #db2068; padding: .18em 0;"><a
                        style="color: white; margin-left: 5px;">Dashboard</a></i>
                <i class="fa-solid fa-cart-flatbed"><a style="color: white; margin-left: 5px;">Products</a></i>
                <i class="fa-solid fa-lock-open" style="margin-top: 350px;"><a style="color: white; margin-left: 5px;"
                        href="php/logout.php">logout</a></i>
            </div>
        </div>
        <div class="topbar">
            <div class="box2">
                <div class="boxh" style="background-color: red;">
                
                </div>
                <div class="boxd">View Details</div>
            </div>
            <div class="box2"></div>
            <div class="box2"></div>
            <div class="box2"></div>
        </div>
        <div class="middlecontainer">
            <div class="middlebar1">
            <form method="post" action="createProduct.php" enctype="multipart/form-data">
                <h3>Add new item</h3>
                <div class="form-group" style="padding-top: 30px;">
                    <label>Foto URL</label>
                    <input type="text" class="form-control" name="foto"/>
                </div>
                <div class="form-group">
                    <label>hotel</label>
                    <input type="text" class="form-control" name="hotel"/>
                </div>
                <div class="form-group">
                    <label>locatie</label>
                    <input type="text" class="form-control" name="locatie"/>
                </div>
                <div class="form-group">
                    <label">startDatum</label>
                    <input type="date" class="form-control" name="startDatum"/>
                </div>
                <div class="form-group">
                    <label>eindDatum</label>
                    <input type="date" class="form-control" name="eindDatum"/>
                </div>
                <div class="form-group">
                    <label>beginplek</label>
                    <input type="text" class="form-control" name="beginplek"/>
                </div>
                <div class="form-group">
                    <label>eindplek</label>
                    <input type="text" class="form-control" name="eindplek"/>
                </div>
                <div class="form-group">
                    <label>regio</label>
                    <input type="text" class="form-control" name="regio"/>
                </div>
                <div class="form-group">
                    <label>Retour</label>
                    <input type="text" class="form-control" name="retour" placeholder="1 = Ja, 0 = Nee"/>
                </div>
                <div class="form-group">
                    <label>kosten</label>
                    <input type="number" min="0" class="box" name="kosten" placeholder="enter the product price">
                </div>
                <input type="submit" class="submitbtn" name="add_product" value="hotel toevoegen">            </form>
            </div>
        <div class="middlebar2">
                <?php

            $sql = "SELECT * FROM reizen";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
   
   ?>
        <div class="product-display">
                    
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>Locatie</th>
                        <th>Hotel</th>
                        <th>Regio</th>
                        <th>Start Datum</th>
                        <th>Eind Datum</th>
                        <th>Kosten</th>
                        <th>Begin Plek</th>
                        <th>Eind Plek</th>
                        <th>actie</th>
                    </tr>
                </thead>
                <?php foreach($result as $value){ ?>
                <tr>
                    <td>
                        <?php echo $value['locatie']; ?>
                    </td>
                    <td>
                        <?php echo $value['hotel']; ?>
                    </td>
                    <td>
                        <?php echo $value['regio']; ?>
                    </td>
                    <td>
                        <?php echo $value['startDatum']; ?>
                    </td>
                    <td>
                        <?php echo $value['eindDatum']; ?>
                    </td>
                    <td>
                        <?php echo $value['kosten']; ?>
                    </td>
                    <td>
                        <?php echo $value['beginplek']; ?>
                    </td>
                    <td>
                        <?php echo $value['eindplek']; ?>
                    </td>
                    <td>
                        <a href="product_update.php?edit=<?php echo $value['reisID']; ?>" class="btn"> <i
                                class="fas fa-edit"></i> bewerk </a>
                        <a href="deletepage.php?delete=<?php echo $value['reisID']; ?>" class="btn"> <i
                                class="fas fa-trash"></i> verwijder </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
                </div>
            </div>
        </div>


</body>

</html>
