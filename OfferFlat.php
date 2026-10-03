<?php
session_start(); 
require_once("dbconfig.inc.php");
?>
<?
if (isset($_POST['info'])){

$parking = isset($_POST['parking']) ? 1 : 0;
$heating = isset($_POST['heating']) ? 1 : 0;
$storage = isset($_POST['storage']) ? 1 : 0;
$playground = isset($_POST['playground']) ? 1 : 0;
$air_conditioning = isset($_POST['air_conditioning']) ? 1 : 0;
$access_control = isset($_POST['access_control']) ? 1 : 0;


$stat6 = $pdo->prepare("INSERT INTO flats(owner_id,location,address,price,available_from, available_to,bedrooms,bathrooms,size_sqm,rent_conditions,heating, air_conditioning,access_control,parking,backyard,playground,storage,Type,PhotoPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");


  $stat6->execute([$_SESSION['Oid'],$_POST['Address'],$_POST['Address'],$_POST['RentCost'],$_POST['FromDate'],$_POST['ToDate'],$_POST['bedrooms'],$_POST['bathrooms'],$_POST['Size'],$_POST['rent_conditions'],$heating,$air_conditioning,$access_control,$parking,$_POST['backyard'],$playground,$storage,$_POST['Type'],'flat1photo1.png']);
$Result3 = $stat6->fetch(PDO::FETCH_ASSOC);
$flatRef=$pdo->lastInsertId();
  if (!empty($_SESSION['UpPhotos'])) {
        foreach ($_SESSION['UpPhotos'] as $imageName) {
          $stat7 = $pdo->prepare(" INSERT INTO flat_photos(flat_ref,photo_path,Caption) VALUES (?, ?, ?) 
        
");

 
  $stat7->execute([$flatRef,$imageName,'photo Flat '.$flatRef.'']);
$Result4 = $stat7->fetch(PDO::FETCH_ASSOC);

            
        }

      
        unset($_SESSION['uploaded_images']);
    }


  
header("Location: OfferFlat2.php?ID=$flatRef");


    exit();


}else if (isset($_POST['do'])) {
    if (!empty($_FILES['FlatsPhoto']['name'][0])) {
   
    $number = count($_FILES['FlatsPhoto']['name']);

    for ($i = 0; $i < $number; $i++) {
        $tmpName = $_FILES['FlatsPhoto']['tmp_name'][$i];
        $fileName = $_FILES['FlatsPhoto']['name'][$i];

     
        $targetPath = "images/" . basename($fileName);

    
        move_uploaded_file($tmpName, $targetPath);
        
      $_SESSION['UpPhotos'][] = $fileName;
        
        
        
      
        
        
    }
}
}

?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birzeit Flat Rent</title>
      <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css" />

   
</head>
<body>
    <div class="container">
    <header>
 <div class=Flex>
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<div class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </div>
 </div>
 <div class="Section">
     <?php if(isset($_SESSION['role'])): ?>
     <?php if($_SESSION['role'] =='manager'): ?>
     <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Welcome, <?= ucfirst($_SESSION['role']) ?><p>
     
 </div>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogOut.php">Log Out</a></li>
            </div>
             <?php else: ?>
  <?php if (isset($_SESSION['name'])): ?>   
 <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Welcome, <?= ($_SESSION['name']) ?><p>
     
 </div>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogOut.php">Log Out</a></li>
            </div>
             
             <?php endif; ?>
              <?php endif; ?>
               <?php else: ?>
             <div class="Section">
    
 <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Sign in to get started<p>
     
 </div>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogIn.php">Login</a></li>
            </div>
              <?php endif; ?>
         </header>
         <nav class="nav">
        <ul>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <li><a href="SearchFlat.php">Search</a></li>
            <li><a href="OfferFlat.php" class="active" >Offer Flat</a></li>
            <?php if (isset($_SESSION['name'])): ?>
            <li><a href="LogOut.php">Logout</a></li>
             <?php else: ?>
            <li><a href="LogIn.php">Login</a></li>
             <?php endif; ?>
        <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
      
        
         <main>
      
<?php
echo '<form method="POST" enctype="multipart/form-data">
  <label>Upload Flat Photos:</label><br>
  <input type="file" name="FlatsPhoto[]" multiple>
  <button type="submit" name="do" >Upload</button>
</form>';




echo '<form  method="post">';
echo '<section class="Rent_Section">';
echo '<div class="Registr-form">';
echo '<label for="name">Rent Cost <span class="required">*</span></label>';
echo '<input type="number" name="RentCost" id="UserName" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Address <span class="required">*</span> </label>';
echo '<input type="text" name="Address" id="Address" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Rent Conditions <span class="required">*</span></label>';
echo '<input type="text" name="rent_conditions" id="NId" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Size in square meters <span class="required">*</span> </label>';
echo '<input type="text" name="Size" id="Size" required>';
echo '</div>';


 echo '<div class="Registr-form">';

echo '<p><strong>Extra Features:</strong></p>
<ul>
  <li>
    
      <input type="checkbox" name="parking" value="yes"> Parking
    
  </li>
  <li>
    
      <input type="checkbox" name="heating" value="yes"> heating
    
  </li>
  <li>
   
      <input type="checkbox" name="storage" value="yes"> Storage
    
  </li>
   <li>
   
      <input type="checkbox" name="playground" value="yes"> Storage
    
  </li>
  <li>
    
      <input type="checkbox" name="air_conditioning" value="yes"> Air Conditioning
    
  </li>
  <li>
   
      <input type="checkbox" name="access_control" value="yes"> Access Control
    
  </li>
</ul>';
echo '</div>';
echo '<div class="Registr-form">';
echo '<ul>
  back yard<br>
  <li><input type="radio" name="backyard" value="individual"> individual</li>
  <li><input type="radio" name="backyard" value="shared"> shared</li>
  <li><input type="radio" name="backyard" value="none"> None</li>
</ul>';


echo '</div>';
echo '<div class="Registr-form">';
echo '<ul>
  Type<br>
  <li><input type="radio" name="Type" value="furnished">furnished</li>
  <li><input type="radio" name="Type" value="notfurnished">not furnished</li>

</ul>';


echo '</div>';




echo '<div class="Registr-form">';
echo '<label for="flat_no">Number of Bedrooms <span class="required">*</span> </label>
<input type="number" name="bedrooms" id="flat_no" >';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="street">Number of Bathrooms <span class="required">*</span> </label>
<input type="number" name="bathrooms" id="street" required>';
echo '</div>';



echo '<div class="Registr-form">';
echo '<label for="postal">Available from <span class="required">*</span> </label>
<input type="date" name="FromDate" >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Available To <span class="required">*</span> </label>
<input type="date" name="ToDate" required >';
echo '</div>';



echo '<input type="submit" name ="info" value="Submit">';
echo '</form>';


echo '</section>';
            
?>
  
  
  
  
  
  
  
      
</main>
   
<hr>
    <footer class=Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
        
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div>
      
    </footer>
</body>
</html>