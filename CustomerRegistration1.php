<?php
session_start();




$ErrorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!preg_match("/^[a-zA-Z]+$/", $_POST['name'])) {
    $ErrorMessages[] = "Name  Should be only Characters!";
   }
    
    if (empty($ErrorMessages)) {
    $_SESSION['ID'] = $_POST['ID'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['dateofbirth'] = $_POST['dateofbirth'];
 $_SESSION['flatno'] = $_POST['flatno'];
    $_SESSION['StreetName'] = $_POST['StreetName'];
    $_SESSION['City'] = $_POST['City'];
     $_SESSION['PostalCode'] = $_POST['PostalCode'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['Mobile'] = $_POST['Mobile'];
     $_SESSION['telephone'] = $_POST['telephone'];
   
    

 
    header("Location: CustomerRegistration2.php");
   
    exit();}


} 
 

?>








<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration1</title>
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
               <h2>Register</h2>
               <p>Create your Birzeit Flat Rent account</p>
           </div>

         <?php if (!empty($ErrorMessages)): ?>
  <div class="login-error">
      <?php foreach ($ErrorMessages as $ErrorMessage): ?>
        <p><?= $ErrorMessage ?></p>
      <?php endforeach; ?>
  </div>
<?php endif; ?>

           <?php
echo '<form method="post" class="register-form">';

echo '<div class="register-field">';
echo '<label for="name">Name<span class="required">*</span></label>';
echo '<input type="text" name="name" id="name" placeholder="Enter your full name" required>';
echo '</div>';

echo '<div class="register-field">';
echo '<label for="dob">Date Of Birth<span class="required">*</span></label>';
echo '<input type="date" name="dateofbirth" id="dob" required>';
echo '</div>';

echo '<div class="register-field">';
echo '<label for="ID">National ID Number<span class="required">*</span></label>';
echo '<input type="text" name="ID" pattern="^\d{9}$" placeholder="# # # # # # # # #" id="ID" required>';
echo '</div>';

echo '<div class="register-field">';
echo '<label>Address<span class="required">*</span></label>';
echo '</div>';

echo '<div class="register-row">';
echo '<div class="register-field">';
echo '<label for="flat_no">Flat / House No:</label>';
echo '<input type="text" name="flatno" id="flat_no" placeholder="e.g. 12" required>';
echo '</div>';
echo '<div class="register-field">';
echo '<label for="street">Street Name:</label>';
echo '<input type="text" name="StreetName" id="street" placeholder="e.g. Main Street" required>';
echo '</div>';
echo '</div>';

echo '<div class="register-row">';
echo '<div class="register-field">';
echo '<label for="city">City:</label>';
echo '<input type="text" name="City" id="city" placeholder="e.g. Birzeit" required>';
echo '</div>';
echo '<div class="register-field">';
echo '<label for="postal">Postal Code:</label>';
echo '<input type="text" name="PostalCode" id="postal" placeholder="e.g. 90000" required>';
echo '</div>';
echo '</div>';

echo '<div class="register-field">';
echo '<label for="email">E-mail address<span class="required">*</span></label>';
echo '<input type="email" name="email" id="email" placeholder="you@example.com" required>';
echo '</div>';

echo '<div class="register-row">';
echo '<div class="register-field">';
echo '<label for="mobile">Mobile Number<span class="required">*</span></label>';
echo '<input type="text" name="Mobile" id="mobile" placeholder="05X-XXXXXXX" required>';
echo '</div>';
echo '<div class="register-field">';
echo '<label for="telephone">Telephone Number<span class="required">*</span></label>';
echo '<input type="text" name="telephone" pattern="\d{2}-\d{7}" placeholder="02-2954367" id="telephone" required>';
echo '</div>';
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