<?php
session_start();
require_once("dbconfig.inc.php");

$ErrorMessages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['UserName']) &&
    isset($_POST['Password'])) {

    if (!empty($_POST['UserName'])) {

        $UserName = $_POST['UserName'];
        $Password = $_POST['Password'];

        $sql = "SELECT userID, password, role
                FROM Users
                WHERE userName = :userName";

        $statement = $pdo->prepare($sql);
        $statement->execute([':userName' => $UserName]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($Password, $user['password'])) {

            $_SESSION['role'] = $user['role'];
            $_SESSION['UserName'] = $UserName;
            $_SESSION['uI'] = $user['userID'];

            if ($user['role'] === 'customer') {

                $sql5 = "SELECT name
                         FROM customers
                         WHERE userID = :userID";

                $statement5 = $pdo->prepare($sql5);
                $statement5->execute([':userID' => $user['userID']]);

                $customer = $statement5->fetch(PDO::FETCH_ASSOC);

                $_SESSION['name'] = $customer['name'];
                $_SESSION['uI'] = $user['userID'];

                if (isset($_SESSION['Page']) && isset($_SESSION['IDd'])) {

                    $ID = $_SESSION['IDd'];

                    header("Location: RentFlat.php?ID=$ID");
                    exit();

                } else {

                    header("Location: SearchFlat.php");
                    exit();

                }
            }

            if ($user['role'] === 'manager') {

                header("Location: SearchFlat.php");
                exit();

            }

            if ($user['role'] === 'owner') {

                $sql5l = "SELECT owner_id, name
                          FROM Owners
                          WHERE userID = :userID";

                $statement5l = $pdo->prepare($sql5l);
                $statement5l->execute([':userID' => $user['userID']]);

                $owner = $statement5l->fetch(PDO::FETCH_ASSOC);

                $_SESSION['name'] = $owner['name'];
                $_SESSION['Oid'] = $owner['owner_id'];

                if (isset($_SESSION['Page']) && isset($_SESSION['IDd'])) {

                    $ID = $_SESSION['IDd'];

                    header("Location: RentFlat.php?ID=$ID");
                    exit();

                } else {

                    header("Location: Search.php");
                    exit();

                }
            }

        } else {

            $ErrorMessages[] = "Invalid Email Or Password";

        }

    } else {

        $ErrorMessages[] = "Invalid Email Or Password";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sign In - Birzeit Flat Rent</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="style.css">

</head>

<body>

<div class="container">


    <header>

        <div class="brand">

            <img class="logo"
                 src="images/LogoRent1.png"
                 alt="Birzeit Flat Rent logo">

            <div class="brand-text">

                <h1>Birzeit Flat Rent</h1>

                <a href="AboutUs.php">
                    About Us
                </a>

            </div>

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
                    <a href="LogIn.php"
                       class="active">
                        Login or sign up
                    </a>
                </li>
           

            <?php if (isset($_SESSION['role'])): ?>

                <?php if ($_SESSION['role'] != 'manager'): ?>

                    <li>
                        <a href="SearchFlat.php">
                            Search
                        </a>
                    </li>

                <?php endif; ?>

            <?php endif; ?>


            <?php if (isset($_SESSION['name'])): ?>

                <li>
                    <a href="LogOut.php">
                        Logout
                    </a>
                </li>

            <?php else: ?>

                 <li>
                <a href="SearchFlat.php">
                    Search
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



    <main class="login-main">

        <div class="login-card">

            <div class="login-header">

                <h2>Sign in</h2>

                <p>
                    Welcome back to Birzeit Flat Rent
                </p>

            </div>


            <?php if (!empty($ErrorMessages)): ?>

                <div class="login-error">

                    <?php foreach ($ErrorMessages as $Em): ?>

                        <p>
                            <?= htmlspecialchars($Em) ?>
                        </p>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>


            <form method="post"
                  class="login-form">

                <div class="login-input">

                    <input
                        type="text"
                        name="UserName"
                        id="UserName"
                        placeholder="User Name"
                        required
                    >

                </div>


                <div class="login-input password-input">

                    <input
                        type="password"
                        name="Password"
                        id="Password"
                        placeholder="Password"
                        required
                    >

                    <button type="button"
                            id="showPassword">
                        show
                    </button>

                </div>


                <a href="#"
                   class="forgot-password">
                    Forgot password?
                </a>


                <button type="submit"
                        class="login-submit">
                    Sign in
                </button>

            </form>
<p class="register-footer">Don't Have an Account?<a href="MainReg.php">Sign up</a></p>

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


<script>

const showPassword =
    document.getElementById("showPassword");

const password =
    document.getElementById("Password");


showPassword.addEventListener("click", function () {

    if (password.type === "password") {

        password.type = "text";

        showPassword.textContent = "hide";

    } else {

        password.type = "password";

        showPassword.textContent = "show";

    }

});

</script>

</body>

</html>