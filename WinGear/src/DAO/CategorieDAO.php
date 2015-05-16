<?php

namespace WinGear\DAO;
use WinGear\Domain\Categorie;
    
class CategorieDAO extends DAO  {
    
    public function find($id){
        $sql = "select * from t_categorie where cate_id=?";
        $row = $this->getDb()->fetchAssoc($sql,array($id));
        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new Exception("No user matching id" . $id);
        }
    }

    protected function buildDomainObject($row) {
        $categorie = new Categorie();
        $categorie->setID($row['cate_id']);
        $categorie->setName($row['cate_name']);
        return $categorie;
    }

    
     /**
     * Returns the list of all categories, sorted by trade name.
     *
     * @return array The list of all categories.
     */
    public function findAll() {
        $sql = "select * from t_categorie order by cate_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categorieId = $row['cate_id'];
            $categories[$categorieId] = $this->buildDomainObject($row);
        }
        return $categories;
    }
    
    
}

  
