<?php
session_start(); 
require_once("dbconfig.inc.php");

$ErrorMessages = [];





if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['UserName'])){
    
   if (preg_match("/^\d.{4,13}[a-z]$/", $_POST['Password'])) {
    
        if (!empty($_POST['UserName'])) {
       if (!filter_var($_POST['UserName'], FILTER_VALIDATE_EMAIL)) {
        $ErrorMessages[] = "Invalid email";
        
    } else {
        $UserName=$_POST['UserName'];
         $sql = "SELECT userName FROM Users WHERE userName = :userName";
        $statement = $pdo->prepare($sql);
$statement->execute([':userName' => $UserName]);
    $Result = $statement->fetch(PDO::FETCH_ASSOC);
     if($Result){
        $ErrorMessages[] = "Email is already taken!";
    }else {
         $_SESSION['UserName'] = $_POST['UserName'];
         $_SESSION['Password'] = $_POST['Password'];
       header("Location: CustomerRegistration3.php");
    exit(); 
    } 
    
        }
        
        }   
       
  
   }else {
       $ErrorMessages[] = "Invalid Password. 
   password should be 
between 6-15 characters And start with a digit and ends with a lower case alphabet 
    ";
   
   }
 

   }  
   
    
    
    




   
?>








<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration2</title>
      <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css" />

   
</head>
<body>
    <div class="container">
    <header>
 <div class=Flex>
<img class="logo" src="images/LogoRent1.png"  alt="logo">
 <h1>Birzeit Flat Rent</h1></div>
         </header>
         <nav>
        <ul>
            <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php" class="active">Register</a></li>
            <li><a href="SearchFlat.php">Search and Login</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
       <main>
       <div class="register-main">
       <div class="register-card">
           <div class="register-header">
               <h2>Create account</h2>
               <p>Set up your login details</p>
           </div>

       <?php
      if (!empty($ErrorMessages)) {
        echo '<div class="login-error">';
        foreach ($ErrorMessages as $Em) {
          echo "<p>$Em</p>";
        }
        echo '</div>';
      }
    ?>

           <?php
echo '<form method="post" class="register-form">';

echo '<div class="register-field">';
echo '<label for="UserName">User Name<span class="required">*</span></label>';
echo '<input type="email" name="UserName" id="UserName" placeholder="you@example.com" required>';
echo '</div>';

echo '<div class="register-field">';
echo '<label for="Password">Password<span class="required">*</span></label>';
echo '<input type="password" name="Password" id="Password" placeholder="Enter password" required>';
echo '</div>';

echo '<div class="register-field">';
echo '<label for="ConfirmPassword">Confirm Password<span class="required">*</span></label>';
echo '<input type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Re-enter password" required>';
echo '</div>';

echo '<button type="submit" class="register-submit">Next</button>';
echo '</form>';
echo '<p class="register-footer">Already have an account? <a href="LogIn.php">Log in</a></p>';
?>

       </div>
       </div>
       </main>
    
    
    <hr>
    <footer class= Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
         <div class ="Information">
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div></div>
      
    </footer>
</body>
</html>