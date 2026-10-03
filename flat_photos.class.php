<?php
class flat_photos {
    private $photo_id, $flat_ref, $photo_path, $Caption ;

    public function __construct($photo_id, $flat_ref, $photo_path, $Caption ) {
        $this->photo_id = $photo_id;
        $this->flat_ref = $flat_ref;
         $this->photo_path = $photo_path;
        $this->Caption = $Caption;
       
        
    }
public function getPath() {
        return $this->photo_path;
    }

    public function getref() {
        return $this->flat_ref;
    }

    public function getCaption() {
        return $this->Caption;
    }
}
?>
