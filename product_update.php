<?php

@include 'includes/connect.php';

$reisID = $_GET['edit'];

if(isset($_POST['update_product'])){

   $hotel = $_POST['hotel'];
   $kosten = $_POST['kosten'];
   $locatie = $_POST['locatie'];
   $startDatum = $_POST['startDatum'];
   $eindDatum = $_POST['eindDatum'];
   $regio = $_POST['regio'];
   $beginplek = $_POST['beginplek'];
   $eindplek = $_POST['eindplek'];
   $foto = $_POST['foto'];

   if(empty($hotel) || empty($kosten) ){
      $message[] = 'please fill out all!';    
   }else{

      $sql = "UPDATE reizen SET hotel='$hotel', kosten='$kosten', locatie='$locatie', eindDatum='$eindDatum', startDatum='$startDatum', regio='$regio', beginplek='$beginplek', eindplek='$eindplek', foto='$foto' WHERE reisID = '$reisID'";
      $stmt = $connect->prepare($sql);
      $stmt->execute();

      if($stmt){
         header('location:adminpage.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>
  <div class="card-body">
      <div class="alert alert-danger">

      <?php
      $select = "SELECT * FROM reizen WHERE reisID = :reisID";
      $stmt = $connect->prepare($select);
      $stmt->bindParam('reisID', $_POST['reisID']);
      $stmt->execute();
      $result = $stmt->fetch();
   ?>
      </div><br/>
      <form method="post" action="">
          <div class="form-group">
              <label>Foto URL</label>
              <input type="text"  class="form-control" name="foto"/>
          </div>
          <div class="form-group">
              <label>hotel</label>
              <input type="text" class="form-control" value="<?php echo $result['hotel']; ?>"name="hotel"/>
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
              <label>kosten</label>
              <input type="number" min="0" class="box" name="kosten" value="<?php echo $result['kosten']; ?>" placeholder="enter the product price">
          </div>
          <button type="submit" value="update product" name="update_product" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>

   </body>
   </html>