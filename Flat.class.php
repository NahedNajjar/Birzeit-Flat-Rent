<?php
require_once("flat_photos.class.php");
class flats {
    private $flat_ref, $owner_id, $location, $address, $price, $available_from, $available_to,$bedrooms,$bathrooms,$size_sqm,$rent_conditions,$heating,$air_conditioning,$access_control,$parking,$backyard,$playground,$storage,$is_rented,$is_approved ,$Type;

  
   public function __construct($flat_ref, $price, $available_from, $available_to,$location,$bedrooms) {
        $this->flat_ref = $flat_ref;
       
         $this->location = $location;
       
       
         $this->price = $price;
        $this->available_from = $available_from;
        $this->available_to = $available_to;
        $this->bedrooms=$bedrooms;
   
    }
   

     public function addImage(flat_photos $photo) {
        $this->photos[] = $photo;
    }

    public function getPhotos() {
        
        return $this->photos;
    }
   
    
 

    public function displayInTable() {
        
        echo "<tr>";
      


        echo "<td>$this->flat_ref</td>";
        echo "<td>$this->price</td>";
        echo "<td>$this->available_from</td>";
        echo "<td>$this->available_to</td>";
         echo "<td>$this->location</td>";
        echo "<td>$this->bedrooms</td>";
        echo '<td><a href="FlatDetail.php?ID=' . $this->flat_ref . '"> 
  <img  src="images/' . $this->PhotoPath . '" alt="i" "> 
</a></td>';


       
        echo "</tr>";
    }

 
}
?>
