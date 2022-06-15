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

   if(empty($hotel) || empty($kosten) ){
      $message[] = 'please fill out all!';    
   }else{

      $sql = "UPDATE reizen SET hotel='$hotel', kosten='$kosten', locatie='$locatie', eindDatum='$eindDatum', startDatum='$startDatum', regio='$regio', beginplek='$beginplek', eindplek='$eindplek' WHERE reisID = '$reisID'";
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

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = "SELECT * FROM reizen WHERE reisID = :reisID";
      $stmt = $connect->prepare($select);
      $stmt->bindParam('reisID', $_POST['reisID']);
      $stmt->execute();
      $result = $stmt->fetch();
   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <input type="text" min="0" class="box" name="hotel" placeholder="enter the product hotel naam">
      <input type="text" min="0" class="box" name="locatie" placeholder="locatie">
      <input type="text" min="0" class="box" name="startDatum" placeholder="startdatum dinges">
      <input type="text" min="0" class="box" name="eindDatum" placeholder="einddatum dinges">
      <input type="text" min="0" class="box" name="beginplek" placeholder="beginplek dinges">
      <input type="text" min="0" class="box" name="eindplek" placeholder="eindplek dinges">
      <input type="text" min="0" class="box" name="regio" placeholder="regio dinges">
      <input type="number" min="0" class="box" name="kosten" value="<?php echo $result['kosten']; ?>" placeholder="enter the product price">
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="adminpage.php" class="btn">go back!</a>
   </form>
   


   <?php?>

   

</div>

</div>

</body>
</html>