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
   
     $_SESSION['bankname'] = $_POST['bankname'];
    $_SESSION['BankBranch'] = $_POST['BankBranch'];
     $_SESSION['accountnumber'] = $_POST['accountnumber'];

 
    header("Location: OwnerRegistration1.php");
   
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
           
         <?php if (!empty($ErrorMessages)): ?>
  <div class="ErrorMessages-box">
    <ul>
      <?php foreach ($ErrorMessages as $ErrorMessage): ?>
        <li><li><?= $ErrorMessage ?></li>
</li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

       
           <?php
echo '<form  method="post">';

echo '<div class="Registr-form">';
echo '<label for="name">Name<span class="required">*</span> </label>';
echo '<input type="text" name="name"  required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="dob">Date Of Birth<span class="required">*</span></label>';
echo '<input type="date" name="dateofbirth" id="dob" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="ID">National ID Number <span class="required">*</span>  </label>';
echo '<input type="text" name="ID" pattern="^\d{9}$" placeholder="# # # # # # # # #" id="ID" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="Address">Address <span class="required">*</span></label>';

echo '</div>';
echo '<div class= "Address-form">';
echo '<div class="Registr-form">';
echo '<label for="flat_no">Flat / House No:</label>
<input type="text" name="flatno" id="flat_no" required>';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="street">Street Name:</label>
<input type="text" name="StreetName" id="street" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="city">City:</label>
<input type="text" name="City" id="city" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Postal Code:</label>
<input type="text" name="PostalCode" id="postal" required>';
echo '</div>';
echo '</div>';
echo '<div class="Registr-form">';
echo '<label for="email">E-mail address <span class="required">*</span> </label>';
echo '<input type="email" name="email" id="email" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="dob">Mobile Number <span class="required">*</span></label>';
echo '<input type="text" name="Mobile" id="dob" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Telephone Number <span class="required">*</span> </label>';
echo '<input type="text" name="telephone" pattern="\d{2}-\d{7}" placeholder="02-2954367" id="telephone" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="bankdetails">Bank Details <span class="required">*</span></label>';

echo '</div>';
echo '<div class= "Address-form">';
echo '<div class="Registr-form">';
echo '<label for="bankname">Bank Name</label>
<input type="text" name="bankname" id="bankname" required>';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="BankBranch">Bank Branch</label>
<input type="text" name="BankBranch" id="BankBranch" required>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="account number">Account Number</label>
<input type="text" name="accountnumber" id="accountnumber" required>';
echo '</div>';
echo '</div>';

echo '<input type="submit" value="Next">';
echo '</form>';
?>
   
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
    
    
    
