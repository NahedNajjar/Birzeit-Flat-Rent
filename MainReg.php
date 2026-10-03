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
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <header>

        <section class="Flex">
            <img class="logo" src="images/LogoRent1.png" alt="logo">

            <div class="Section">
                <h1>Birzeit Flat Rent</h1>
                <a href="AboutUs.php">About Us</a>
            </div>
        </section>


        <div class="header-user">

            <?php if (isset($_SESSION['name'])): ?>

                <!-- One Card -->
                <div class="card">

                    <div class="card-welcome">
                        <img class="profile-logo"
                             src="images/ProfileG.jpeg"
                             alt="Profile">

                        <p>
                            Welcome, <?= $_SESSION['name'] ?>
                        </p>
                    </div>

                    <div class="card-actions">
                        <a href="Registration.php">Register</a>
                        <a href="LogOut.php">Log Out</a>
                    </div>

                </div>

            <?php else: ?>

                <!-- One Card -->
                <div class="card">

                    <div class="card-welcome">
                        <img class="profile-logo"
                             src="images/ProfileG.jpeg"
                             alt="Profile">

                        <p>Sign in to get started</p>
                    </div>

                    <div class="card-actions">
                        <a href="Registration.php">Register</a>
                        <a href="LogIn.php">Login</a>
                    </div>

                </div>

            <?php endif; ?>

        </div>

    </header>


    <nav class="nav">
        <ul>

           

            <li>
                <a href="AboutUs.php">
                    About Us
                </a>
            </li>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
                <li>
                    <a href="Flats.php">
                        My Rentals
                    </a>
                </li>
            <?php endif; ?>

            <li>
                <a href="MainReg.php" class="active">
                    Register
                </a>
            </li>

            <li>
                <a href="SearchFlat.php">
                    Search
                </a>
            </li>

            <?php if (isset($_SESSION['name'])): ?>

                <li>
                    <a href="LogOut.php">
                        Logout
                    </a>
                </li>

            <?php else: ?>

                <li>
                    <a href="LogIn.php">
                        Login
                    </a>
                </li>

            <?php endif; ?>

            <li>
                <a href="contact.php">
                    Contact Us
                </a>
            </li>

        </ul>
    </nav>


    <main>

        <h5>Register</h5>

        <div class="flats-grid">

            <div class="flat-listing-card">

                <div class="flat-listing-body">

                    <div class="flat-listing-price">
                        Register as Customer
                    </div>

                    <div class="flat-listing-location">
                        Looking for a flat to rent?
                        Create a customer account.
                    </div>

                    <a class="btn-view"
                       href="CustomerRegistration1.php">
                        Register as Customer
                    </a>

                </div>

            </div>


            <div class="flat-listing-card">

                <div class="flat-listing-body">

                    <div class="flat-listing-price">
                        Register as Owner
                    </div>

                    <div class="flat-listing-location">
                        Have a flat to offer for rent?
                        Create an owner account.
                    </div>

                    <a class="btn-view"
                       href="OwnerRegistration1.php">
                        Register as Owner
                    </a>

                </div>

            </div>

        </div>

    </main>


    <footer class="Flex">

        <img class="logo"
             src="images/LogoRent1.png"
             alt="logo">

        <div class="Information">

            <p>
                Ramallah-Birzeit |
                Contact: 1229@BZRent.com |
                Phone: +9725986382
            </p>

            <p>
                &copy; All Rights Reserved
            </p>

        </div>

    </footer>

</div>

</body>
</html>