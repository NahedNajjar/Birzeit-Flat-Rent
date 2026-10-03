<?php
session_start(); 
require_once("dbconfig.inc.php");
require_once("Flat.class.php");
require_once("flat_photos.class.php");

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    
    try {
    
    
   
    $statement4 = $pdo->prepare("SELECT * FROM customers WHERE userID = :userID");
 $statement4->execute([':userID' => $_SESSION['uI']]);
$App4 = $statement4->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM availability_times WHERE flat_ref = :flat_ref");
 $statement->execute([':flat_ref' => $ID]);
$App = $statement->fetchAll(PDO::FETCH_ASSOC);



       
    } catch (PDOException $EXC) {
        
    }
} else {
   
    echo "<p>Invalid  flat ID.</p>";
    
}
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
echo $_POST['Bookk'];
 $statement5 = $pdo->prepare("INSERT INTO appointments(flat_ref,customer_id,slot_id,status) VALUES (?,?,?,?)");
 $statement5->execute([$ID,$App4['customer_id'],$_POST['Bookk'],'pending']); 
  $App2 = $statement5->fetchAll(PDO::FETCH_ASSOC);  
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
 
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<div class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </div>
 
         </header>
         
         <nav class="nav">
            
        <ul>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <li><a href="SearchFlat.php">Search</a></li>
            
            <li><a href="LogOut.php">Logout</a></li>
        
            <li><a href="LogIn.php">Login</a></li>
            
           
            <?php if (!isset($_SESSION['UserName'])): ?>
            
            <?php echo' <li><a href="LogIn.php?ID=' . $ID . '" >Rent the Flat</a></li>
           ';?><?php  $_SESSION['Page']='RentFlat.php';
           
           $_SESSION['IDd']=$ID;
          
           ?>
            <?php else: ?>
            
            <?php echo' <li><a href="RentFlat.php?ID=' . $ID . '" >Rent the Flat</a></li> ';?>
            
           <?php endif; ?>
            
            
            
        <li><a href="contact.php">Contact Us</a></li>
            
            
            
        </ul>
    </nav>
      
        
         <main>
   <?php if(isset($App2)){
         echo '<section class="Messages-box">Appointment has been Booked </section>';
         

     }?>
     
      <div class="flats-grid">
<?php foreach ($App as $Appoin): ?>
  <div class="flat-listing-card">
    <div class="flat-listing-body">
      <span class="flat-listing-badge"><?= $Appoin['day_of_week'] ?></span>
      <div class="flat-listing-price"><?= $Appoin['time_slot'] ?></div>
      <div class="flat-listing-location">Tel: <?= $Appoin['telephone'] ?></div>
      <div class="flat-listing-actions">
        <form method="post">
          <input type="hidden" name="Bookk" value="<?= $Appoin['slot_id'] ?>">
          <button type="submit" name="Book">Book Appointment</button>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
      </div>
</main>
   
<hr>
    <footer class=Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
        
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div>
      
    </footer>
</body>
</html>