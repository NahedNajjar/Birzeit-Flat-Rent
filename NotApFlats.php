<?php
session_start(); 
require_once("dbconfig.inc.php");
?>
<?php
$statement = $pdo->prepare("SELECT * FROM flats WHERE is_approved = 0");
 $statement->execute();
$flats = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
   
$statement2 = $pdo->prepare("UPDATE flats SET is_approved=1  WHERE flat_ref = :fr");
$statement2->execute([':fr' => $_POST['flat_ref']]);
$flats2 = $statement2->fetchAll(PDO::FETCH_ASSOC);    
    
    $statement3 = $pdo->prepare("SELECT * FROM flats  WHERE flat_ref = :fr");
$statement3->execute([':fr' => $_POST['flat_ref']]);
$flats3= $statement3->fetch(PDO::FETCH_ASSOC);    
    
    
  $statMessa = $pdo->prepare("INSERT INTO Messages(MessageBody,MessageTitle,receiver_id,Sender,Receiver) VALUES (?, ?, ?, ?, ?)");
  

 $statMessa->execute(['flat'.$_POST['flat_ref'].' Flat offer approved ','Offer Flat ',$flats3['owner_id'],'system','owner']);
$Result4 = $statMessa->fetch(PDO::FETCH_ASSOC); 
  
  

    
    
    
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
 <section class=Flex>
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<div class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </div>
 </section>
 <div class="Section">
     <?php if(isset($_SESSION['role'])): ?>
     <?php if($_SESSION['role'] =='manager'): ?>
     <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Welcome, <?= ucfirst($_SESSION['role']) ?><p>
     
 </div>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogOut.php">Log Out</a></li>
             
                         <li><a href="NotApFlats.php">View Offers</a></li>

             
            
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
         <nav>
        <ul>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <li><a href="SearchFlat.php">Search</a></li>
             <?php if($_SESSION['role'] =='owner'): ?>
            <?
           echo' <li><a href="OfferFlat.php?ID=' . $_SESSION['Oid'] . '">Offer Flat </a></li>';
           
           
             ?>
              <?php endif; ?>
            <?php if (isset($_SESSION['name'])): ?>
            <li><a href="LogOut.php">Logout</a></li>
             <?php else: ?>
            <li><a href="LogIn.php">Login</a></li>
             <?php endif; ?>
             
        <li><a href="contact.php">Contact Us</a></li>
             
        </ul>
    </nav>
      
  <main>
      <h5>Flats Awaiting Approval</h5>
      <?php if (empty($flats)): ?>
        <p>No pending offers right now.</p>
      <?php else: ?>
      <div class="flats-grid">
        <?php foreach ($flats as $flat): ?>
          <div class="flat-listing-card">
            <div class="flat-listing-body">
              <span class="flat-listing-badge">Flat #<?= $flat['flat_ref'] ?></span>
              <div class="flat-listing-price">$<?= $flat['price'] ?></div>
              <div class="flat-listing-location"><?= $flat['location'] ?></div>
              <div class="flat-listing-meta">
                <span><?= $flat['address'] ?></span>
              </div>
              <div class="flat-listing-actions">
                <form method="post">
                  <input type="hidden" name="flat_ref" value="<?= $flat['flat_ref'] ?>">
                  <button type="submit" name="approve">Approve</button>
                </form>
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