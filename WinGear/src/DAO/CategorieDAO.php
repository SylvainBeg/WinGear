<?php

namespace WinGear\DAO;
    
class CategorieDAO extends DAO  {
    
    public function find($id){
        $sql = "select * from t_categorie where cate_id=?";
        $row = $this->getDb()->fetchAssoc($sql,array($id));
        
        if ($row)
            return $this->buildDomainObjet($row);
        else
            throw new Exception ("No user matching id" . $id);
    }
    
    protected function buildDomainObjet($row){
        $categorie = new Categorie();
        $categorie->setID($row['cate_id']);
        $categorie->setName($row['cate_name']);
        return $categorie;
    }
    
}

  
