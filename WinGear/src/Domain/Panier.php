<?php


namespace WinGear\Domain;

class Panier{
    
    
    private $id_user;
    
    private $id_product;
    
    private $quantite;
    
    
   public function getId_user(){
       return $this->id_user;
   }
   
   public function setId_user($id) {
        $this->id_user = $id;
    }
       
   public function getId_product(){
       return $this->id_product;
       
   }
   
   public function setId_product($id) {
        $this->id_product = $id;
    }
    
   public function getQuantite(){
       return $this->quantite;
   }
   
   public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
}

