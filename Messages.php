<?php
session_start();
require_once("dbconfig.inc.php");

$Messages = [];

if (isset($_SESSION['role']) && $_SESSION['role'] === 'owner' && isset($_SESSION['Oid'])) {
    $stmt = $pdo->prepare("SELECT * FROM Messages WHERE receiver_id = :rid AND Receiver = 'owner' ORDER BY MessageDate DESC");
    $stmt->execute([':rid' => $_SESSION['Oid']]);
    $Messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'manager' && isset($_SESSION['uI'])) {
    $stmt = $pdo->prepare("SELECT * FROM Messages WHERE receiver_id = :rid AND Receiver = 'manager' ORDER BY MessageDate DESC");
    $stmt->execute([':rid' => $_SESSION['uI']]);
    $Messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
 <section class="Flex">
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<div class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </div>
  </section>
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
           
            echo' <li><a href="Messages.php?ID=' . $_SESSION['Oid'] . '">View Messages</a></li>';
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
      <?php if (empty($Messages)): ?>
        <p>No messages yet.</p>
      <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Messages as $msg): ?>
          <tr>
            <td><?= htmlspecialchars($msg['MessageTitle']) ?></td>
            <td><?= htmlspecialchars($msg['MessageBody']) ?></td>
            <td><?= htmlspecialchars($msg['MessageDate']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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