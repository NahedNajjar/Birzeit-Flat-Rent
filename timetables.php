<?php
session_start(); 
require_once("dbconfig.inc.php");
?>
<?php
if (isset($_GET['ID'])) {
    
    $ID = $_GET['ID'];
  
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    
   $stat6 = $pdo->prepare("INSERT INTO availability_times(flat_ref,day_of_week,time_slot,telephone) VALUES (?, ?, ?, ?)
");


  $stat6->execute([$ID,$_POST['day_of_week'],$_POST['time'],$_POST['telephone']]);
$Result3 = $stat6->fetch(PDO::FETCH_ASSOC);

    $stat7 = $pdo->prepare("SELECT userID FROM Users WHERE role like 'manager'");

  $stat7->execute();
$Result4 = $stat7->fetch(PDO::FETCH_ASSOC);

    
  
  $statMessa = $pdo->prepare("INSERT INTO Messages(MessageBody,MessageTitle,receiver_id,Sender,Receiver) VALUES (?, ?, ?, ?, ?)");
  

 $statMessa->execute(['A new apartment has been added to the system ','Apartment Approval Request',$Result4['userID'],'system','manager']);
$Result5 = $statMessa->fetch(PDO::FETCH_ASSOC); 
  
 
    
    
    
    
    
    
}}

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
             <?php if($_SESSION['role'] =='owner'): ?>
            <?
           echo' <li><a href="OfferFlat.php?ID=' . $_SESSION['Oid'] . '">Offer Flat To Rent</a></li>';
             ?>
              <?php endif; ?>
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
            <?php if (isset($_SESSION['name'])): ?>
            <li><a href="LogOut.php">Logout</a></li>
             <?php else: ?>
            <li><a href="LogIn.php">Login</a></li>
             <?php endif; ?>
             
        <li><a href="contact.php">Contact Us</a></li>
             
        </ul>
    </nav>
      
        
         <main>
             <?php if(isset($Result5)){
         echo '<section class="Messages-box">The offer has been sent, awaiting approval. </section>';

     }?>
  
  <?php if(!isset($Result5)){
  echo '<form  method="post">';
      echo '<div class="Registr-form">';
echo '<label for="day_of_week">Day Of Week<span class="required">*</span> </label>';
echo '<input type="text" name="day_of_week" id="day_of_week" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="dob">Time<span class="required">*</span></label>';
echo '<input type="time" name="time" id="time" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="telephone">Telephone Number <span class="required">*</span> </label>';
echo '<input type="text" name="telephone" pattern="\d{2}-\d{7}" placeholder="02-2954367" id="telephone" required>';
echo '</div>';
echo '<button type="submit" name="Next" >Next</button>';
      echo '</div>';
    echo '</form >';
  }
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