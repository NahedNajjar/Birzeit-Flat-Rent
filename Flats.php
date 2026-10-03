<?php
session_start(); 
require_once("dbconfig.inc.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: SerachFlat.php");
    exit();
}
?>
<?php



$stat8 = $pdo->prepare("SELECT * FROM customers WHERE userID = :cid");

  $stat8->execute([':cid' =>$_SESSION['uI']]);
$Result8 = $stat8->fetch(PDO::FETCH_ASSOC);

$stat6 = $pdo->prepare("SELECT flatRef FROM RentalCustomer WHERE customerID = :cid");

  $stat6->execute([':cid' =>$Result8['customer_id']]);
$RentedRefs = $stat6->fetchAll(PDO::FETCH_COLUMN);

$Result4 = [];
if (!empty($RentedRefs)) {
    $placeholders = implode(',', array_fill(0, count($RentedRefs), '?'));
    $stat7 = $pdo->prepare("SELECT * FROM flats WHERE flat_ref IN ($placeholders)");
    $stat7->execute($RentedRefs);
    $Result4 = $stat7->fetchAll(PDO::FETCH_ASSOC);
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
    <section class="container">
    <header>
 <section class=Flex>
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<section class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </section>
 </section>
 <section class="Section">
     <?php if(isset($_SESSION['role'])): ?>
     <?php if($_SESSION['role'] =='manager'): ?>
     <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Welcome, <?= ucfirst($_SESSION['role']) ?><p>
     
 </section>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogOut.php">Log Out</a></li>
            
            </section>
             <?php else: ?>
  <?php if (isset($_SESSION['name'])): ?>   
 <section class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Welcome, <?= ($_SESSION['name']) ?><p>
     
 </section>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogOut.php">Log Out</a></li>
             <?php if($_SESSION['role'] =='owner'): ?>
            <?
           echo' <li><a href="OfferFlat.php?ID=' . $_SESSION['Oid'] . '">Offer Flat To Rent</a></li>';
           
            echo' <li><a href="Messages.php?ID=' . $_SESSION['Oid'] . '">View Messages</a></li>';
             ?>
              <?php endif; ?>
            </section>
             
             <?php endif; ?>
              <?php endif; ?>
               <?php else: ?>
             <section class="Section">
    
 <section class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Sign in to get started<p>
     
 </section>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogIn.php">Login</a></li>
            </section>
              <?php endif; ?>
         </header>
         <nav>
        <ul>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <li><a href="SearchFlat.php">Search</a></li>
            <?php if (isset($_SESSION['name'])): ?>
            <li><a href="LogOut.php">Logout</a></li>
             <?php else: ?>
            <li><a href="LogIn.php">Login</a></li>
             <?php endif; ?>
             
        <li><a href="contact.php">Contact Us</a></li>
             
        </ul>
    </nav>
      
        
         <main>
      <h5>My Rented Flats</h5>
      <?php if (empty($Result4)): ?>
        <p>You haven't rented any flats yet.</p>
      <?php else: ?>
      <div class="flats-grid">
        <?php foreach ($Result4 as $flat): ?>
          <div class="flat-listing-card">
            <div class="flat-listing-body">
              <span class="flat-listing-badge">Flat #<?= $flat['flat_ref'] ?></span>
              <div class="flat-listing-price">$<?= $flat['price'] ?></div>
              <div class="flat-listing-location"><?= $flat['location'] ?></div>
              <div class="flat-listing-meta">
                <span><?= $flat['address'] ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
</main>
   
<hr>
    <footer class=Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
        
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div>
      
    </footer>
</body>
</html>