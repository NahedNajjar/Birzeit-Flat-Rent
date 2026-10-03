<?php
session_start();
require_once("dbconfig.inc.php");

    

$statement = $pdo->prepare("SELECT * FROM flats WHERE flat_ref = :flat_ref");
 $statement->execute([':flat_ref' => $_SESSION['FlatRef']]);
$flats = $statement->fetch(PDO::FETCH_ASSOC);

 $stm = $pdo->prepare("SELECT * FROM flat_photos fp,flats f WHERE fp.flat_ref=f.flat_ref and f.flat_ref= :flat_ref");
       
        $stm->execute([':flat_ref' => $_SESSION['idd']]);

$stat2 = $pdo->prepare("SELECT owner_id FROM flats WHERE flat_ref = :flat_ref");
$stat2->execute([':flat_ref' => $_SESSION['idd']]);

$owner_id = $stat2->fetch(PDO::FETCH_ASSOC);

$stat3 = $pdo->prepare("SELECT * FROM Owners WHERE owner_id = :owner_id");

$stat3->execute([':owner_id' => $owner_id['owner_id']]);
$Result = $stat3->fetch(PDO::FETCH_ASSOC);

$UserName=$_SESSION['UserName'];

$stat4 = $pdo->prepare("SELECT userID FROM Users WHERE userName = :us");

$stat4->execute([':us' => $_SESSION['UserName']]);
$Result2 = $stat4->fetch(PDO::FETCH_ASSOC);



$stat5 = $pdo->prepare("SELECT * FROM customers WHERE userID = :us");

$stat5->execute([':us' => $Result2['userID']]);
$Result5 = $stat5->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  
$stat6 = $pdo->prepare("INSERT INTO RentalCustomer(flatRef,customerID,total_price, start_date,end_date,cardNumber,CardExpireDate,NameOnCard) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  $stat6->execute([$flats['flat_ref'],$Result5['customer_id'],$flats['price'],$_SESSION['DateF'], $_SESSION['DateT'],$_POST['Cnumber'],$_POST['CExp'],$_POST['NameOnC']]);
$Result3 = $stat6->fetch(PDO::FETCH_ASSOC);

 
  


 
  $statMessa = $pdo->prepare("INSERT INTO Messages(MessageBody,MessageTitle,receiver_id,Sender,Receiver) VALUES (?, ?, ?, ?, ?)");
  

 $statMessa->execute(['flat'.$flats['flat_ref'].' has been successfully 
rented for '.$Result5['name'].' Mobile'.$Result5['mobile'],'Rent Flat ',$Result['owner_id'],'system','owner']);
$Result4 = $statMessa->fetch(PDO::FETCH_ASSOC); 
  
 
  

$stat9 = $pdo->prepare("UPDATE flats SET is_rented= 1 WHERE flat_ref= :flat_ref");

  $stat9->execute([':flat_ref' => $_SESSION['idd']]);
$Result9 = $stat9->fetch(PDO::FETCH_ASSOC);



       
        







  
   
}

 
  
  



?>



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
 <section class=Flex>
<img class="logo" src="images/LogoRent1.png"  alt="logo">
<div class="Section">
 <h1>Birzeit Flat Rent</h1>
 <a href="AboutUs.php">About Us</a>
 </div>
 </section>
 <div class="Section">
  <?php if (isset($_SESSION['name'])): ?>   
 <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Welcome, <?= ($_SESSION['name']) ?><p>
     
 </div>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogOut.php">Log Out</a></li>
            </div>
             <?php else: ?>
             <div class="Section">
    
 <div class="card">
  <img class="logo" src="images/ProfileG.jpeg"  alt="logo">   
     <p>Sign in to get started<p>
     
 </div>
 <li><a href="MainReg.php">Register</a></li>
            <li><a href="LogIn.php">Login</a></li>
            </div>
             
             <?php endif; ?>
         </header>
         <nav class="nav">
        <ul>
             <li><a href="AboutUs.php">About Us</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li><a href="Flats.php">My Rentals</a></li>
            <?php endif; ?>
            <li><a href="MainReg.php">Register</a></li>
            <li><a href="SearchFlat.php">Search</a></li>
            <?php if (isset($_SESSION['name'])): ?>
            <li><a href="LogOut.php">Logout</a></li>
             <?php else: ?>
            <li><a href="LogIn.php">Login</a></li>
             <?php endif; ?>
        <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
      
        
         <main>
     <?php
     if(isset($Result9)){
         echo '<section class="Messages-box">Flat has been successfully rented, you can collect the key from the owner ' . $Result['name'] . '<hr> Mobile: ' . $Result['mobile'] . '</section>';

     }
     ?>
    
<?php 
if(!isset($Result9)){
echo '<form  method="post">';
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
echo '<label for="street">Rent From</label>
<input type="date" name="RentF" id="street" value="' .$_SESSION['DateF']. '" readonly>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="street">Rent To</label>
<input type="date" name="RentTo" id="street" value="' .$_SESSION['DateT']. '" readonly>';
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
echo '<div class= "Address-form">';
echo '<div class="Registr-form">';
echo '<label for="postal">Customer Name</label>
<input type="text" name="name" id="postal" value="' . $Result5['name'] . '" readonly>';
echo '</div>';


echo '<div class="Registr-form">';
echo '<label for="postal">Customer Email</label>';
echo '<input type="text" name="name" id="postal" value="' . $Result5['name'] . '" readonly>';

echo '</div>'; 

echo '<div class="Registr-form">';
echo '<label for="postal">Card Number</label>';
echo '<input type="text" name="Cnumber"  pattern="^\d{9}$" placeholder="# # # # # # # # #" id="ID" <span class="required">*</span>  </label>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Card Expiration Date</label>
<input type="date" name="CExp" <span class="required">*</span>  </label>';
echo '</div>';

echo '<div class="Registr-form">';
echo '<label for="postal">Name On The Card</label>
<input type="text" name="NameOnC" <span class="required">*</span>  </label>';
echo '</div>';
echo '</div>';

echo '</section>';
echo '<input type="submit" value="Confirm Rent">';
echo '</form>';
echo '</section>';
}          
?>      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
</main>
   
<hr>
    <footer class=Flex>
        
       
        <img class="logo" src="images/LogoRent1.png"  alt="logo">
        
        <p>Ramallah-Birzeit | Contact: 1229@BZRent.com | Phone:+9725986382 </p>
        <p>&copy; All Rights Reserved</p></div>
      
    </footer>
</body>
</html>