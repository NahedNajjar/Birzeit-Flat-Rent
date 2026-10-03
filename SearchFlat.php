<?php
session_start(); 
require_once("dbconfig.inc.php");
require_once("Flat.class.php");

$sql = "SELECT * FROM flats WHERE 1=1 AND is_approved=1";
$params = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['location'])) {
        $sql .= " AND location LIKE :location";
        $params[':location'] = '%' . $_POST['location'] . '%';
    }

    if (!empty($_POST['PriceTo']) && !empty($_POST['PriceFrom'])) {
        $sql .= " AND price <= :priceTo AND price >= :priceFrom";
        $params[':priceTo'] = $_POST['PriceTo'];
        $params[':priceFrom'] = $_POST['PriceFrom'];
    }

    if (!empty($_POST['bedrooms'])) {
        $sql .= " AND bedrooms = :bedrooms";
        $params[':bedrooms'] = $_POST['bedrooms'];
    }

    if (!empty($_POST['bathrooms'])) {
        $sql .= " AND bathrooms = :bathrooms";
        $params[':bathrooms'] = $_POST['bathrooms'];
    }

    if (!empty($_POST['furnished'])) {
        $sql .= " AND Type = :furnished";
        $params[':furnished'] = $_POST['furnished'];
    }
}

$statement = $pdo->prepare($sql);
$statement->execute($params);
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Search Flats - Birzeit Flat Rent</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">


    <header>

        <section class="Flex">

            <img class="logo"
                 src="images/LogoRent1.png"
                 alt="logo">

            <div class="Section">

                <h1>Birzeit Flat Rent</h1>

                <a href="AboutUs.php">
                    About Us
                </a>

            </div>

        </section>


        <div class="header-user">

            <?php if (isset($_SESSION['role'])): ?>

                <?php if ($_SESSION['role'] == 'manager'): ?>

                    <div class="card">

                        <div class="card-welcome">

                            <img class="profile-logo"
                                 src="images/ProfileG.jpeg"
                                 alt="Profile">

                            <p>
                                Welcome, <?= ucfirst($_SESSION['role']) ?>
                            </p>

                        </div>

                        <div class="card-actions">

                            <a href="LogIn.php">
                                LogIn or sign up
                            </a>

                            <a href="LogOut.php">
                                Log Out
                            </a>

                            <a href="NotApFlats.php">
                                View Messages
                            </a>

                        </div>

                    </div>

                <?php else: ?>

                    <?php if (isset($_SESSION['name'])): ?>

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

                                <a href="LogIn.php">
                                    Log in or sign uo
                                </a>

                                <a href="LogOut.php">
                                    Log Out
                                </a>

                                <?php if ($_SESSION['role'] == 'owner'): ?>

                                    <a href="OfferFlat.php?ID=<?= $_SESSION['Oid'] ?>">
                                        Offer Flat To Rent
                                    </a>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endif; ?>

                <?php endif; ?>

            <?php else: ?>

                <div class="card">

                    <div class="card-welcome">

                        <img class="profile-logo"
                             src="images/ProfileG.jpeg"
                             alt="Profile">

                        <p>
                            Sign in to get started
                        </p>

                    </div>

                    <div class="card-actions">

                        <a href="MainReg.php">
                            Register
                        </a>

                        <a href="LogIn.php">
                            Login
                        </a>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </header>



    <nav>

        <ul>

            

            <li>
                <a href="AboutUs.php">
                    About Us
                </a>
            </li>

            <?php if (isset($_SESSION['role']) &&
                      $_SESSION['role'] === 'customer'): ?>

                <li>
                    <a href="Flats.php">
                        My Rentals
                    </a>
                </li>

            <?php endif; ?>

            <li>
                <a href="LogIn.php">
                    Log in or sign up
                </a>
            </li>

            <li>
                <a href="SearchFlat.php" class="active">
                    Search
                </a>
            </li>

            <?php if (isset($_SESSION['name'])): ?>

                <li>
                    <a href="LogOut.php">
                        Logout
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

        <h5>Find your next home in Birzeit</h5>



        <div class="search-container">

            <form method="post"
                  action="SearchFlat.php"
                  class="search-form">

                <fieldset>

                  
                    <p class="search-subtitle">
                        Find the perfect flat based on your preferences
                    </p>


                    <div class="search-grid">


                        <!-- Location -->

                        <div class="search-field">

                            <label for="location">
                                Location
                            </label>

                            <input
                                type="text"
                                id="location"
                                name="location"
                                placeholder="e.g. Birzeit"
                                value="<?= htmlspecialchars($_POST['location'] ?? '') ?>"
                            >

                        </div>


                        <!-- Price From -->

                        <div class="search-field">

                            <label for="PriceFrom">
                                Price From
                            </label>

                            <input
                                type="number"
                                id="PriceFrom"
                                name="PriceFrom"
                                min="0"
                                placeholder="Minimum price"
                                value="<?= htmlspecialchars($_POST['PriceFrom'] ?? '') ?>"
                            >

                        </div>


                        <!-- Price To -->

                        <div class="search-field">

                            <label for="PriceTo">
                                Price To
                            </label>

                            <input
                                type="number"
                                id="PriceTo"
                                name="PriceTo"
                                min="0"
                                placeholder="Maximum price"
                                value="<?= htmlspecialchars($_POST['PriceTo'] ?? '') ?>"
                            >

                        </div>


                        <!-- Bedrooms -->

                        <div class="search-field">

                            <label for="bedrooms">
                                Bedrooms
                            </label>

                            <input
                                type="number"
                                id="bedrooms"
                                name="bedrooms"
                                min="1"
                                placeholder="Number of bedrooms"
                                value="<?= htmlspecialchars($_POST['bedrooms'] ?? '') ?>"
                            >

                        </div>


                        <!-- Bathrooms -->

                        <div class="search-field">

                            <label for="bathrooms">
                                Bathrooms
                            </label>

                            <input
                                type="number"
                                id="bathrooms"
                                name="bathrooms"
                                min="1"
                                placeholder="Number of bathrooms"
                                value="<?= htmlspecialchars($_POST['bathrooms'] ?? '') ?>"
                            >

                        </div>


                        <!-- Furnished -->

                        <div class="search-field">

                            <label for="furnished">
                                Furnished
                            </label>

                            <select
                                name="furnished"
                                id="furnished"
                            >

                                <option value="">
                                    Any
                                </option>

                                <option
                                    value="furnished"
                                    <?= (($_POST['furnished'] ?? '') === 'furnished')
                                        ? 'selected'
                                        : '' ?>
                                >
                                    Furnished
                                </option>

                                <option
                                    value="not furnished"
                                    <?= (($_POST['furnished'] ?? '') === 'not furnished')
                                        ? 'selected'
                                        : '' ?>
                                >
                                    Not furnished
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- Button -->

                    <div class="search-button-container">

                        <button type="submit">
                            Search Flats
                        </button>

                    </div>

                </fieldset>

            </form>

        </div>



        <div class="flats-grid">

            <?php

            while ($col = $statement->fetch(PDO::FETCH_ASSOC)) {

                $sql2 = "SELECT * FROM flat_photos
                         WHERE flat_ref = :flat_ref";

                $statement2 = $pdo->prepare($sql2);

                $statement2->execute([
                    ':flat_ref' => $col['flat_ref']
                ]);

                $Result = $statement2->fetch(PDO::FETCH_ASSOC);


                echo '<a class="flat-listing-card"
                         href="FlatDetail.php?ID=' . $col['flat_ref'] . '">';


                if ($Result) {

                    echo '<img class="flat-listing-image"
                               src="images/' . $Result['photo_path'] . '"
                               alt="' . htmlspecialchars($col['location']) . '">';

                }


                echo '<div class="flat-listing-body">';


                echo '<span class="flat-listing-badge">
                        Flat #' . $col['flat_ref'] . '
                      </span>';


                echo '<div class="flat-listing-price">
                        $' . $col['price'] . '
                      </div>';


                echo '<div class="flat-listing-location">
                        ' . htmlspecialchars($col['location']) . '
                      </div>';


                echo '<div class="flat-listing-meta">';

                echo '<span>
                        ' . $col['bedrooms'] . ' beds
                      </span>';

                echo '<span>
                        From ' . $col['available_from'] . '
                      </span>';

                echo '<span>
                        To ' . $col['available_to'] . '
                      </span>';

                echo '</div>';


                echo '</div>';

                echo '</a>';
            }

            ?>

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
                Phone:+9725986382
            </p>

            <p>
                &copy; All Rights Reserved
            </p>

        </div>

    </footer>

</div>

</body>
</html>