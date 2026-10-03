<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("dbconfig.inc.php");
    
    $Pass=$_SESSION['Password'];
$userName=$_POST['UserName'];
    $name=$_POST['name'] ;
    $id=$_POST['NId'];
   
    $flatno=$_POST['flatno'] ;
    $StreetName=$_POST['StreetName'];
  $City=$_POST['City']; 
   $PostalCode=$_POST['PostalCode'];
    $email =$_POST['Email'];
     $Mobile=$_POST['Mobile'];
     $telephone=$_POST['TelePhone'];
      $dateOfBirth=$_POST['DateOfBirth'];
      

$BankName=$_POST['BankName'];
$BankBranch=$_POST['BankBranch'];
$AccountNumber=$_POST['AccountNumber'];
    try {
        
        $hashedPass = password_hash($Pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Users (password,userName,role)
                VALUES (?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$hashedPass,$userName,'owner']);

        
        $LaID = $pdo->lastInsertId();

        
        $sql = "INSERT INTO Owners (name,flatno,StreetName,City,PostalCode, dateob,email,mobile,account_number,telephone,bank_name, bank_branch, userID)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$name, $flatno,$StreetName,$City,$PostalCode, $dateOfBirth, $email,$Mobile,$AccountNumber,$telephone, $BankName,$BankBranch,$LaID]);

        
        

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
            <li><a href="CustomerRegistration1.php">Register</a></li>
            <li><a href="SearchFlat.php">Search and Login</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
       <main>
<?php
echo '<form  method="post">';

echo '<div class="Registr-form">';
echo '<label for="name">User Name</label>';
echo '<input type="email" name="UserName" id="UserName" value="' . $_SESSION['UserName'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Name</label>';
echo '<input type="text" name="name" id="name" value="' . $_SESSION['name'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">National ID</label>';
echo '<input type="text" name="NId" id="NId" value="' . $_SESSION['ID'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="Address">Address <span class="required">*</span></label>';

echo '</div>';
echo '<div class= "Address-form">';
echo '<div class="Registr-form">';
echo '<label for="flat_no">Flat / House No:</label>
<input type="text" name="flatno" id="flat_no" value="' . $_SESSION['flatno'] . '" readonly>';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="street">Street Name:</label>
<input type="text" name="StreetName" id="street" value="' . $_SESSION['StreetName'] . '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="city">City:</label>
<input type="text" name="City" id="city" value="' . $_SESSION['City'] . '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Postal Code:</label>
<input type="text" name="PostalCode" id="postal" value="' . $_SESSION['PostalCode'] . '" readonly';
echo '</div>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Email</label>';
echo '<input type="text" name="Email" id="Email" value="' . $_SESSION['email'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Mobile</label>';
echo '<input type="text" name="Mobile" id="Mobile" value="' . $_SESSION['Mobile'] . '" readonly >';
echo '</div>';


echo '<div class="Registr-form">';
echo '<label for="name">TelePhone</label>';
echo '<input type="text" name="TelePhone" id="TelePhone" value="' . $_SESSION['telephone'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Date Of Birth</label>';
echo '<input type="text" name="DateOfBirth" id="DateOfBirth" value="' . $_SESSION['dateofbirth'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="BankDetails">Bank Details </label>';

echo '</div>';
echo '<div class= "Address-form">';
echo '<div class="Registr-form">';
echo '<label for="BankName">Bank Name</label>
<input type="text" name="BankName" id="BankName" value="' .  $_SESSION['bankname'] . '" readonly>';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="BankBranch">Bank Branch</label>
<input type="text" name="BankBranch" id="BankBranch" value="' . $_SESSION['BankBranch'] . '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="AccountNumber">Account Number</label>
<input type="text" name="AccountNumber" id="AccountNumber" value="' . $_SESSION['accountnumber'] . '" readonly>';
echo '</div>';

echo '<input type="submit" value="Confirm">';
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
    
    
    
    
    
    
    
    
    
</body>