<?php
session_start(); 
?>



<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birzeit Flat Rent</title>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css" />

   
</head>
<body>
    <div class="container">
    <header>
    <div class="brand">
        <img class="logo" src="images/LogoRent1.png" alt="Birzeit Flat Rent logo">
        <div class="brand-text">
            <h1>Birzeit Flat Rent</h1>
            <a href="AboutUs.php">About Us</a>
        </div>
    </div>

    <div class="header-user">
<?php if (isset($_SESSION['role'])): ?>
    <?php if ($_SESSION['role'] == 'manager'): ?>
        <div class="card">
            <div class="card-welcome">
                <img class="profile-logo" src="images/ProfileG.jpeg" alt="Profile">
                <p>Welcome, <?= ucfirst($_SESSION['role']) ?></p>
            </div>
            <div class="card-actions">
                <a href="MainReg.php">Register</a>
                <a href="LogOut.php">Log Out</a>
                <a href="NotApFlats.php">View Offers</a>
            </div>
        </div>
    <?php else: ?>
        <?php if (isset($_SESSION['name'])): ?>
        <div class="card">
            <div class="card-welcome">
                <img class="profile-logo" src="images/ProfileG.jpeg" alt="Profile">
                <p>Welcome, <?= $_SESSION['name'] ?></p>
            </div>
            <div class="card-actions">
                <a href="MainReg.php">Register</a>
                <a href="LogOut.php">Log Out</a>
                <?php if ($_SESSION['role'] == 'owner'): ?>
                    <a href="OfferFlat.php?ID=<?= $_SESSION['Oid'] ?>">Offer Flat To Rent</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
        <div class="card">
            <div class="card-welcome">
                <img class="profile-logo" src="images/ProfileG.jpeg" alt="Profile">
                <p>Sign in to get started</p>
            </div>
            <div class="card-actions">
                <a href="MainReg.php">Register</a>
                <a href="LogIn.php">Login</a>
            </div>
        </div>
<?php endif; ?>
    </div>
</header>
         <nav>
        <ul>
           <li><a href="HomePage.php" class="active">Home Page</a></li>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <?php if(isset($_SESSION['role'])): ?>
     <?php if($_SESSION['role'] !='manager'): ?>
     
            <li><a href="SearchFlat.php">Search</a></li>
            <?php endif; ?>
            <?php endif; ?>
             <?php if(!isset($_SESSION['role'])): ?>
     
            <li><a href="SearchFlat.php">Search</a></li>
            <?php endif; ?>
             <?php if(isset($_SESSION['role'])&& $_SESSION['role'] =='owner'): ?>
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
      <section class="hero">
        <span class="hero-eyebrow">Ramallah · Birzeit</span>
        <h5>Find your next home in Birzeit</h5>
        <p class="hero-subtitle">Curated flats for students, families and professionals — verified owners, clear terms, no surprises.</p>
        <a class="btn-view" href="SearchFlat.php">Browse Available Flats</a>
      </section>
</main>
   
<hr>
    <footer class=Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
        
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div>
      
    </footer>
</body>
</html>