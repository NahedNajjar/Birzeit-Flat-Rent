<?php
session_start(); 
require_once("dbconfig.inc.php");
require_once("Flat.class.php");
require_once("flat_photos.class.php");

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    try {
    
    
   
    

$statement = $pdo->prepare("SELECT * FROM flats WHERE flat_ref = :flat_ref");
 $statement->execute([':flat_ref' => $ID]);
$flats = $statement->fetch(PDO::FETCH_ASSOC);


$parking = isset($flats['parking']) && $flats['parking'] == 1 ? 'Yes' : 'No';
$heating = isset($flats['heating']) && $flats['heating'] == 1 ? 'Yes' : 'No';
$storage = isset($flats['storage']) && $flats['storage'] == 1 ? 'Yes' : 'No';
$playground = isset($flats['playground']) && $flats['playground'] == 1 ? 'Yes' : 'No';
$air_conditioning = isset($flats['air_conditioning']) && $flats['air_conditioning'] == 1 ? 'Yes' : 'No';
$access_control = isset($flats['access_control']) && $flats['access_control'] == 1 ? 'Yes' : 'No';











 $stm = $pdo->prepare("SELECT * FROM flat_photos fp,flats f WHERE fp.flat_ref=f.flat_ref and f.flat_ref= :flat_ref");
       
        $stm->execute([':flat_ref' => $ID]);

$stm2 = $pdo->prepare("SELECT * FROM marketing_info  WHERE  flat_ref= :flat_ref");
       
        $stm2->execute([':flat_ref' => $ID]);


       
    } catch (PDOException $EXC) {
        echo "Error deleting " . $EXC->getMessage();
    }
} else {
   
    echo "<p>Invalid  flat ID.</p>";
    
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
            <?php  $_SESSION['Page']='RentFlat.php'; $_SESSION['IDd']=$ID; ?>
            <?php endif; ?>

        <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
      
        
         <main>

      <div class="property-detail-layout">

        <div class="property-main">

          <div class="property-gallery">
             <?php
             $hasPhoto = false;
             while ($Flat=$stm->fetch(PDO::FETCH_ASSOC))  {
                $hasPhoto = true;
                echo '<img class="property-gallery-img" src="images/' . $Flat['photo_path'] . '" alt="Flat photo" onerror="this.style.display=\'none\'">';
             }
             if (!$hasPhoto) {
                echo '<div class="property-gallery-empty">No photos available yet</div>';
             }
             ?>
          </div>

          <div class="property-info-card">

            <div class="property-price"><?= '$' . $flats['price'] ?> <span>/ month</span></div>
            <div class="property-address"><?= $flats['address'] ?></div>

            <div class="property-stats">
              <span><?= $flats['bedrooms'] ?> Beds</span>
              <span><?= $flats['bathrooms'] ?> Baths</span>
              <span><?= $flats['size_sqm'] ?> m²</span>
            </div>

            <div class="property-cta">
              <?php if (!isset($_SESSION['UserName'])): ?>
                <a class="btn-view" href="LogIn.php?ID=<?= $ID ?>">Rent the Flat</a>
              <?php else: ?>
                <a class="btn-view" href="RentFlat.php?ID=<?= $ID ?>">Rent the Flat</a>
                <a class="btn-view btn-outline" href="Appointment.php?ID=<?= $ID ?>">Book a Visit</a>
              <?php endif; ?>
            </div>

            <h5>Rental Conditions</h5>
            <p><?= $flats['rent_conditions'] ?></p>

            <h5>Features</h5>
            <div class="property-features">
              <span class="feature-chip">Air-conditioning: <?= $air_conditioning ?></span>
              <span class="feature-chip">Heating: <?= $heating ?></span>
              <span class="feature-chip">Access control: <?= $access_control ?></span>
              <span class="feature-chip">Parking: <?= $parking ?></span>
              <span class="feature-chip">Backyard: <?= $flats['backyard'] ?></span>
              <span class="feature-chip">Playground: <?= $playground ?></span>
            </div>

          </div>

        </div>

        <aside class="property-sidebar">
          <h5>Nearby places</h5>
          <?php
            $hasNearby = false;
            while ($Flat2=$stm2->fetch(PDO::FETCH_ASSOC))  {
                $hasNearby = true;
                echo '<div class="nearby-card">';
                echo '<div class="nearby-title">' . htmlspecialchars($Flat2['title']) . '</div>';
                echo '<div class="nearby-description">' . htmlspecialchars($Flat2['description']) . '</div>';
                if (!empty($Flat2['url'])) {
                    echo '<a class="nearby-link" href="' . htmlspecialchars($Flat2['url']) . '" target="_blank">Learn more →</a>';
                }
                echo '</div>';
            }
            if (!$hasNearby) {
                echo '<p>No nearby places listed yet.</p>';
            }
          ?>
        </aside>

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