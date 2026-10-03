<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Birzeit Flat Rent</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
      
        <li><a href="AboutUs.php" class="active">About Us</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
        <?php endif; ?>
        <li><a href="LogIn.php">Log in or sign up</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] != 'manager'): ?>
            <li><a href="SearchFlat.php">Search</a></li>
        <?php elseif (!isset($_SESSION['role'])): ?>
            <li><a href="SearchFlat.php">Search</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['name'])): ?>
            <li><a href="LogOut.php">Logout</a></li>
        
        <?php endif; ?>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
</nav>

<main>
    <h5>Welcome To Birzeit Flat Rent</h5>
    <p>It is a real estate agency that provides residential apartment rental services to its clients in Birzeit. We realize that searching for a home is not just about finding a living space, but rather a search for a place where you feel comfortable and stable. Therefore, we are your destination to meet your needs.</p>

    <h5>History</h5>
    <p>[Birzeit Flat Rent] was founded in [October, 2015] by a team of three co-founders: [Mohamed Ali], [Amjad Mohammed], and [Anwar Hussein]. The agency started out of a small co-working space in [Ramallah, Birzeit], and initially focused on providing rental services to university students.</p>

    <h5>About Birzeit</h5>
    <p>Birzeit is located in the Ramallah and Al-Bireh Governorate, about 25 kilometers north of Jerusalem. Its population is 6,614 people. It enjoys a typical Mediterranean climate, characterized by hot, dry summers and cold, rainy winters. The winds are usually light to moderate.</p>
    <p>For More Details <a href="https://en.wikipedia.org/wiki/Birzeit">Birzeit</a></p>

    <section class="info-section">
        <h3>Famous Places</h3>
        <p>Birzeit University: the most important and oldest university in Palestine.</p>
        <p>Old City: reflects the grandeur of traditional Palestinian architecture and design.</p>
        <p>Birzeit churches: the Latin Monastery Church, the Arab Evangelical Episcopal Church.</p>
    </section>

    <section class="info-section">
        <h3>Famous Products</h3>
        <p>Olives and olive oil.</p>
        <p>Traditional food industries: jams, pickles.</p>
        <p>Homemade products, handicrafts: embroidery and hand sewing.</p>
    </section>

    <section class="info-section">
        <h3>Famous People (associated with the city or its university)</h3>
        <p><strong>Nabiha Nasser (1891-1951):</strong> She founded Birzeit Girls School in 1924, which later developed into Birzeit University.</p>
        <p><strong>Musa Nasser (1895-1971):</strong> He headed Birzeit College from 1947 and contributed to its development.</p>
        <p><strong>Hanna Nasser:</strong> He served as the first president of Birzeit University and contributed greatly to developing its infrastructure and expanding its campus.</p>
    </section>
</main>

<footer class="Flex">
    <img class="logo" src="images/LogoRent1.png" alt="Birzeit Flat Rent logo">
    <div class="Information">
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone: +9725986382</p>
        <p>&copy; All Rights Reserved</p>
    </div>
</footer>
</div>
</body>
</html>