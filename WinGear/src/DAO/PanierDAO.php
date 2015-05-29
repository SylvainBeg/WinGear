<?php

namespace WinGear\DAO;

use WinGear\Domain\Panier;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 class PanierDAO extends DAO

{
     private $Id_UserDAO;
     
     private $Id_ProductDAO;
     
     public function setId_UserDAO( UserDAO $userDAO){
         $this->Id_UserDAO = $userDAO;         
     }
     
     public function setId_ProductDAO (ArticleDAO $productDAO){
         $this->Id_ProductDAO = $productDAO;
     }
     
     // Tous les lignePanier d'un user 
     public function findAllProduct($id_User){
         $sql = "select * from t_panier where pan_usr = ? order by pan_art desc";
         $result = $this->getDb()->fetchAll($sql, array($id_User) );
         
         $lignePanier = array();
         $i = 0;
         foreach ($result as $row){
             $i = $i +1;
             $lignePanier[$i] = $this->buildDomainObject($row);
         }
         return $lignePanier;
     }

    protected function buildDomainObject($row) {
        $panier = new Panier();
        $panier->setId_user($row['pan_usr']);
        $panier->setId_product($row['pan_art']);
        $panier->setQuantite($row['pan_quant']);
        return $panier;
    }
    
    public function save(Panier $panier){
        $panierData = array(
            'pan_usr' => $panier->getId_user(),
            'pan_art' => $panier->getId_product(),
            'pan_quant' => $panier->getQuantite()
                );
        if($panier->getId_product() && $panier->getId_user()){
            $this->getDb()->update('t_panier', $panierData, array('pan_art' => $panier->getId_product() , 'pan_usr' => $panier->getId_user()));
          
        } else{
            $this->getDb()->insert('t_panier', $panierData);     
           
        }
           
    }

    public function delete($id_art,$id_usr) {
        // Delete the article
        $this->getDb()->delete('t_panier', array('pan_art' => $id_art , 'pan_usr'=> $id_usr));
    }
}