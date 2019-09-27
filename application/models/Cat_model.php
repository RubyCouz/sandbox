<?php

if (!defined('BASEPATH')) exit('no direct scriptp access allowed');

/**
 * Description of categoriesModel
 * Model concernant la tablle categorie de la base jarditou
 * Affichage de la liste des catégories
 * @author ced27
 */
class Cat_model extends CI_model {

    /**
     * Affichage de la liste des catégories
     */
    public function categoriesList()
    {

        $this->load->database();
        // stockage de la requète dans une variable
        $query = 'SELECT * from `categories`';
        // exécution de la requète
        $result = $this->db->query($query);
        // récupération des résultats
        $categoriesList = $result->result();
        return $categoriesList;
    }

}


