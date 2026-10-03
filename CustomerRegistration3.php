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

    try {
        
        $hashedPass = password_hash($Pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Users (password,userName,role)
                VALUES (?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$hashedPass,$userName,'customer']);

        
        $LaID = $pdo->lastInsertId();

        
        $sql = "INSERT INTO customers (name,flatno,StreetName,City,PostalCode,telephone,dateob,email,mobile,userID)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$name, $flatno,$StreetName,$City,$PostalCode, $telephone, $dateOfBirth, $email,$Mobile,$LaID]);

        
        

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
            <li><a href="MainReg.php" class="active">Register</a></li>
            <li><a href="SearchFlat.php">Search and Login</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
       <main>
       <div class="register-main">
       <div class="register-card">
           <div class="register-header">
               <h2>Confirm your details</h2>
               <p>Please review your information before confirming</p>
           </div>
<?php
echo '<form method="post" class="register-form">';

echo '<div class="register-field register-readonly">';
echo '<label for="UserName">User Name</label>';
echo '<input type="email" name="UserName" id="UserName" value="' . $_SESSION['UserName'] . '" readonly>';
echo '</div>';

echo '<div class="register-field register-readonly">';
echo '<label for="name">Name</label>';
echo '<input type="text" name="name" id="name" value="' . $_SESSION['name'] . '" readonly>';
echo '</div>';

echo '<div class="register-field register-readonly">';
echo '<label for="NId">National ID</label>';
echo '<input type="text" name="NId" id="NId" value="' . $_SESSION['ID'] . '" readonly>';
echo '</div>';

echo '<div class="register-field register-readonly">';
echo '<label>Address</label>';
echo '</div>';

echo '<div class="register-row">';
echo '<div class="register-field register-readonly">';
echo '<label for="flat_no">Flat / House No</label>';
echo '<input type="text" name="flatno" id="flat_no" value="' . $_SESSION['flatno'] . '" readonly>';
echo '</div>';
echo '<div class="register-field register-readonly">';
echo '<label for="street">Street Name</label>';
echo '<input type="text" name="StreetName" id="street" value="' . $_SESSION['StreetName'] . '" readonly>';
echo '</div>';
echo '</div>';

echo '<div class="register-row">';
echo '<div class="register-field register-readonly">';
echo '<label for="city">City</label>';
echo '<input type="text" name="City" id="city" value="' . $_SESSION['City'] . '" readonly>';
echo '</div>';
echo '<div class="register-field register-readonly">';
echo '<label for="postal">Postal Code</label>';
echo '<input type="text" name="PostalCode" id="postal" value="' . $_SESSION['PostalCode'] . '" readonly>';
echo '</div>';
echo '</div>';

echo '<div class="register-field register-readonly">';
echo '<label for="Email">Email</label>';
echo '<input type="text" name="Email" id="Email" value="' . $_SESSION['email'] . '" readonly>';
echo '</div>';

echo '<div class="register-row">';
echo '<div class="register-field register-readonly">';
echo '<label for="Mobile">Mobile</label>';
echo '<input type="text" name="Mobile" id="Mobile" value="' . $_SESSION['Mobile'] . '" readonly>';
echo '</div>';
echo '<div class="register-field register-readonly">';
echo '<label for="TelePhone">TelePhone</label>';
echo '<input type="text" name="TelePhone" id="TelePhone" value="' . $_SESSION['telephone'] . '" readonly>';
echo '</div>';
echo '</div>';

echo '<div class="register-field register-readonly">';
echo '<label for="DateOfBirth">Date Of Birth</label>';
echo '<input type="text" name="DateOfBirth" id="DateOfBirth" value="' . $_SESSION['dateofbirth'] . '" readonly>';
echo '</div>';

echo '<button type="submit" class="register-submit">Confirm</button>';
echo '</form>';
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
    
    
    
    
    
    
    
    
    
</body>