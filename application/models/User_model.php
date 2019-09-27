<?php

if (!defined('BASEPATH'))
    exit('no direct scriptp access allowed');

/**
 * Description of produitModel
 * Model concernant la table user de la base jarditou
 * 
 * @author ced27
 */
class User_model extends CI_model {

    /**
     * inscription
     */
    public function new_user($data)
    {
        $data['password_user'] = password_hash($data['password_user'], PASSWORD_DEFAULT);
        $this->db->insert('user', $data);
    }

    /**
     * affiche user par id
     */
    public function get_user_by_id($id)
    {
        $query = 'SELECT * FROM `user` WHERE `id_user` = ?';
        $result = $this->db->query($query, array($id));
        return $result;
    }

    /**
     * recherche utilisateur selon login
     */
    public function get_user_log($log)
    {
        $query = 'SELECT * FROM `user` WHERE `login_user` = ?';
        $result = $this->db->query($query, array($log));
        return $result;
    }
}
