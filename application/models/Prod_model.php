<?php

if (!defined('BASEPATH'))
    exit('no direct scriptp access allowed');

/**
 * Description of produitModel
 * Model concernant la table produits de la base jarditou
 * Affichage de la liste des produits
 * @author ced27
 */
class Prod_model extends CI_model {

    /**
     * Affichage de la liste des produits
     */
    public function liste($page, $limit)
    {
        //appel de la methode database -> permet la connexion à la base de données.
        $this->load->database();
        // requète select
        $this->db->select('*');
        $this->db->from('produits');
        $this->db->limit($limit, $page);
        // exécution de la requète
        $result = $this->db->get();
        // récupération des résultats
        $productList = $result->result();
        return $productList;
    }

    /**
     * Compte du nombre d'entrées dans la table produits
     * @return type
     */
    public function count_items()
    {
        $query = 'SELECT COUNT(*) as nb FROM `produits`';
        $result = $this->db->query($query);
        $count_item = $result->row();
        return $count_item->nb;
    }

    /**
     * Ajout d'un produit
     */
    public function addProduct()
    {
        // chargement/connexion à la base de données
        $this->load->database();
        $file = $this->upload->data();
        // récupération des données du formulaire
        $data = $this->input->post();
        // récupération et formatage de la date (date courante) d'ajout du produit
        $data["pro_d_ajout"] = date("Y-m-d");
        // récupération de l'extensio du fichier en vue de son insertion en base de données
        $data["pro_photo"] = substr($file["file_ext"], 1);
        // insertion des données du formulaire en base de données ($data -> données du formulaire)
        $this->db->insert("produits", $data);
    }

    /**
     * Modification d'un produit
     */
    public function update($id)
    {

        $file = $this->upload->data();
        $data = $this->input->post();
// récupération de l'extensio du fichier en vue de son insertion en base de données et extraction du '.' (codeigniter garde le point avant l'extension)
        if ($this->upload->do_upload("pro_photo"))
        {
            $data["pro_photo"] = substr($file["file_ext"], 1);
        }
        // récupération et formatage de la date (date courante) d'ajout du produit
        $data["pro_d_modif"] = date("Y-m-d");
        $this->db->where('pro_id', $id);
        $this->db->update('produits', $data);
    }

    /**
     * Affichage d'un produit selon son id
     */
    public function productById($id)
    {
        // chargement/connexion à la BDD
        $this->load->database();
        // stockage de la requète pour afficher un produit dans une variable
        $query = 'SELECT * FROM `produits` WHERE `pro_id` = ?';
        // lancement de la requète
        $productById = $this->db->query($query, array($id));

        return $productById;
    }

    /**
     * Suppression d'un produit
     */
    public function delete($id)
    {
        // chargement de la base de données
        $this->load->database();
        // clause pour exécuter la requète selon l'id du produit
        $this->db->where('pro_id', $id);
        // exécution de la requète
        $this->db->delete('produits');
    }

}
