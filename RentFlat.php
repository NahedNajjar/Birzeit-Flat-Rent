<?php
session_start(); 
require_once("dbconfig.inc.php");
?>
<?

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $_SESSION['idd']=$ID;
    try {
    
    
  
    

$statement = $pdo->prepare("SELECT * FROM flats WHERE flat_ref = :flat_ref");
 $statement->execute([':flat_ref' => $ID]);
$flats = $statement->fetch(PDO::FETCH_ASSOC);

 $stm = $pdo->prepare("SELECT * FROM flat_photos fp,flats f WHERE fp.flat_ref=f.flat_ref and f.flat_ref= :flat_ref");
       
        $stm->execute([':flat_ref' => $ID]);

$stat2 = $pdo->prepare("SELECT owner_id FROM flats WHERE flat_ref = :flat_ref");
$stat2->execute([':flat_ref' => $ID]);

$owner_id = $stat2->fetch(PDO::FETCH_ASSOC);

$stat3 = $pdo->prepare("SELECT * FROM Owners WHERE owner_id = :owner_id");

$stat3->execute([':owner_id' => $owner_id['owner_id']]);
$Result = $stat3->fetch(PDO::FETCH_ASSOC);



       
    } catch (PDOException $EXC) {
        echo "Error deleting " . $EXC->getMessage();
    }
} else {
   
    echo "<p>Invalid  flat ID.</p>";
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $_SESSION['FlatRef']=$flats['flat_ref'];
   
   $stat7 = $pdo->prepare("SELECT * FROM flats WHERE  :DateF >= available_from AND :DateT <= available_to");

$stat7->execute([':DateF' => $_POST['FromDate'],':DateT' => $_POST['ToDate']]);
$Result7 = $stat7->fetch(PDO::FETCH_ASSOC);
if($Result7){
 $statDate = $pdo->prepare("SELECT * FROM RentalCustomer WHERE flatRef = :flat_ref AND   :start_date >= start_date AND :end_date <= end_date");

$statDate->execute([':flat_ref' =>$flats['flat_ref'],':start_date' => $_POST['FromDate'],':end_date' => $_POST['ToDate']]);
$ResultDate = $statDate->fetch(PDO::FETCH_ASSOC);




if(!$ResultDate){
   $_SESSION['DateF']=$_POST['FromDate'];
   $_SESSION['DateT']=$_POST['ToDate'];
   header("Location: ConfirmRent.php ");
     
    exit(); }
    else {
        echo 'Flat was Rented';  
    }
}else {
     echo 'erro';
   
}
}





?>


 <?php if (!isset($_SESSION['name'])): ?>
            <li><a href="LogIn.php">Login</a></li>
           
            
<?php else: ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birzeit Flat Rent</title>
      <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css" />

   
</head>
<body>
    <div class="container">
    <header>
 
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<div class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </div>
 
         </header>
         <nav class="nav">
        <ul>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <li><a href="SearchFlat.php">Search</a></li>
            
            <li><a href="LogOut.php">Logout</a></li>
             
            <li><a href="LogIn.php">Login</a></li>
            
            <li><a href="RentFlat.php" class="active">Rent the Flat</a></li>
            
            
        <li><a href="contact.php">Contact Us</a></li>
            
            
        </ul>
    </nav>
      
        
         <main>
      
<?php echo '<form  method="post">';
echo '<section class="Rent_Section">';
echo '<div class="Registr-form">';
echo '<label for="name">Price</label>';
echo '<input type="email" name="price" id="UserName" value="' .$flats['price'] . '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Address</label>';
echo '<input type="text" name="name" id="Address" value="' .$flats['address']. '" readonly >';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="name">Rent Conditions</label>';
echo '<input type="text" name="rent_conditions" id="NId" value="' .$flats['rent_conditions']. '" readonly >';
echo '</div>';


echo '<div class="Registr-form">';
echo '<label for="flat_no">Number of Bedrooms</label>
<input type="text" name="bedrooms" id="flat_no" value="' .$flats['bedrooms']. '" readonly>';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="street">Number of Bathrooms</label>
<input type="text" name="bathrooms" id="street" value="' .$flats['bathrooms']. '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="city">Owner Name:</label>
<input type="text" name="City" id="name" value="' . $Result['name'] . '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Owner ID</label>
<input type="text" name="owner_id" id="postal" value="' . $Result['owner_id'] . '" readonly';
echo '</div>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="Address">Owner Address <span class="required">*</span></label>';

echo '</div>';
echo '<div class= "Address-form">';
echo '<div class="Registr-form">';
echo '<label for="flat_no">Flat / House No:</label>
<input type="text" name="flatno" id="flat_no" value="' . $Result['flatno'] . '" readonly>';
echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="street">Street Name:</label>
<input type="text" name="StreetName" id="street" value="' . $Result['StreetName'] . '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="city">City:</label>
<input type="text" name="City" id="city" value="' . $Result['City'] . '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Postal Code:</label>
<input type="text" name="PostalCode" id="postal" value="' . $Result['PostalCode'] . '" readonly';
echo '</div>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Rent From Date</label>
<input type="date" name="FromDate"  <span class="required">*</span>  </label>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Rent To Date</label>
<input type="date" name="ToDate" <span class="required">*</span>  </label>';
echo '</div>';


echo '<input type="submit" value="Submit">';
echo '</form>';
echo '</section>';
            
?>
 <?php endif; ?>
</main>
   
<hr>
    <footer class=Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
        
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div>
      
    </footer>
</body>
</html>