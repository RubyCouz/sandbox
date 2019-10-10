<?php

// application/controllers/Produits.php	
//instruction de sécurité empéchant l'accÃ¨s direct au fichier
defined('BASEPATH') OR exit('No direct script access allowed');

// création de la classe Produits héritant des propriétés de la classe CI_Controller (important : nom de la classe avec premiÃ¨re lettre en majuscule, tout comme le fichier)
class Client extends CI_Controller {

    /**
     * Affichage formulaire inscription
     */
    public function signin_form()
    {
        $this->load->view('header');
        $this->load->view('signin');
        $this->load->view('footer');
    }

    /**
     * Inscriptions
     */
    public function if_client_exists()
    {
        //  $this->output->enable_profiler(TRUE)
        if ($this->input->post('login_user'))
        {
            $this->form_validation->set_rules('login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]|is_unique[user.login_user]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide', 'is_unique' => 'Ce pseudo est déjà utilisé.'));
            if ($this->form_validation->run() === FALSE)
            {
                $error = form_error('login_user');
                echo $error;
            }
        }
    }

    /**
     * vérification du formulaire d'inscription
     */
    public function check_userform()
    {
//        $this->output->enable_profiler(TRUE);
        if ($this->input->post())
        {
            $this->form_validation->set_rules('firstname_user', 'Prénom', 'required|regex_match[/^[a-zA-Z\-éèêëàâäùüûôöîï]+$/]', array('required' => 'Le champs "Prénom" n\'est pas renseigné', 'regex_match' => 'Champs "Prénom" non valide'));
            $this->form_validation->set_rules('lastname_user', 'Nom', 'required|regex_match[/^[a-zA-Z\-éèêëàâäùüûôöîï]+$/]', array('required' => 'Le champs "Nom" n\'est pas renseigné', 'regex_match' => 'Champs "Nom" non valide'));
            $this->form_validation->set_rules('login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]|is_unique[user.login_user]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide', 'is_unique' => 'Ce pseudo est déjà utilisé.'));
            $this->form_validation->set_rules('mail_user', 'Adresse mail', 'required|regex_match[/^[a-zA-Z0-9.!#$%&’*?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/]', array('required' => 'Le champs "Adresse mail" n\'est pas renseigné', 'regex_match' => 'Champs "Adresse mail" non valide'));
            $this->form_validation->set_rules('password_user', 'Mot de passe', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]', array('required' => 'Le champs "Mot de passe" n\'est pas renseigné', 'regex_match' => 'Champs "Mot de passe" non valide'));
            $this->form_validation->set_rules('passwordVerif_user', 'Confirmer votre mot de passe', 'required|matches[password_user]', array('required' => 'Le champs "Confirmer votre mot de passe" n\'est pas renseigné', 'matches' => 'Champs "Confirmer votre mot de passe" non valide'));
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('header');
                $this->load->view('signin');
                $this->load->view('footer');
            }
            else
            {
                $data['firstname_user'] = $this->input->post('firstname_user');
                $data['lastname_user'] = $this->input->post('lastname_user');
                $data['login_user'] = $this->input->post('login_user');
                $data['mail_user'] = $this->input->post('mail_user');
                $data['password_user'] = $this->input->post('password_user');
                $data['inscript_user'] = mdate('%Y-%m-%d', time());
                $this->load->model('User_model');
                $this->User_model->new_user($data);
                $id = $this->db->insert_id();

                redirect(site_url('Client/send_confirmation_mail/' . $id));
            }
        }
        else
        {
            redirect(site_url('Client/signin_form'));
        }
    }

    public function send_confirmation_mail($id)
    {
        // $this->output->enable_profiler(TRUE);
// récupération des infos de l'utilisateur
        $this->load->model('User_model');
        $result = $this->User_model->get_user_by_id($id);
        $info = $result->row();
        // définition des variables de session lors de l'inscription
        $session_user = array(
            'id' => $info->id_user,
            'firstname' => $info->firstname_user,
            'lastname' => $info->lastname_user,
            'login' => $info->login_user,
            'mail' => $info->mail_user,
            'role' => $info->role_user,
        );
        $this->session->set_userdata($session_user);

        //envoie de mail de confirmation
        $this->email->from('sandbox@sandbox.com');
        $this->email->to($info->mail_user);
        $this->email->subject('Confirmation d\'inscription');
        $this->email->message('<h1>Bonjour ' . $info->firstname_user . '</h1>'
                . '<p>Votre inscription à bien été prise en compte.<br>'
                . 'Voici vos informations : <br>'
                . 'Prénom : ' . $info->firstname_user . '<br>'
                . 'Nom : ' . $info->lastname_user . '<br>'
                . 'Email : ' . $info->mail_user . '<br>'
                . 'Pseudo : ' . $info->login_user . '</p>'
        );
        if ($this->email->send())
        {
            redirect(site_url('Client/signin_confirmation'));
        }
        else
        {
            $data['result_class'] = "alert-danger";
            $data['result_message'] = "Votre message n'a pas pu être envoyé. Nous mettons tout en oeuvre pour résoudre le problème.";
            // Ne faites jamais ceci dans le "vrai monde"
            $data['result_message'] .= "<pre>\n";
            $data['result_message'] .= $this->email->print_debugger();
            $data['result_message'] .= "</pre>\n";
            $this->email->clear();
        }
    }

    /**
     * Confirmation d'inscription
     */
    public function signin_confirmation()
    {
        $this->load->view('header');
        $this->load->view('signinConfirmation');
        $this->load->view('footer');
    }

    /**
     * Connexion
     */
    public function log_user()
    {
        $this->load->view('header');
        $this->load->view('log');
        $this->load->view('footer');
    }

    /**
     * vérification formulaire connexion
     */
    public function user_check()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide'));
            $this->form_validation->set_rules('password_user', 'Mot de passe', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]', array('required' => 'Le champs "Mot de passe" n\'est pas renseigné', 'regex_match' => 'Champs "Mot de passe" non valide'));

            if ($this->form_validation->run() != FALSE)
            {
                $log = $this->input->post('login_user');
                $this->load->model('User_model');
                $result = $this->User_model->get_user_log($log);
                $user_info = $result->row();
                if ($user_info != null)
                {
                    $session_user = array(
                        'id' => $user_info->id_user,
                        'firstname' => $user_info->firstname_user,
                        'lastname' => $user_info->lastname_user,
                        'login' => $user_info->login_user,
                        'mail' => $user_info->mail_user,
                        'role' => $user_info->role_user,
                    );
                    $this->session->set_userdata($session_user);
                    redirect(site_url('Produits/home_user'));
                }
                else
                {
                    echo'veuillez vous inscirire avant de vous connecter';
                }
            }
            else
            {
                $this->load->view('header');
                $this->load->view('log');
                $this->load->view('footer');
            }
        }
    }

    /**
     * affichage de la liste des utilisateurs
     */
    public function list_user()
    {
        
    }

    /**
     * Ajout utilisateur (par admin)
     */
    public function add_user()
    {
        
    }

    /**
     * profil utilisateur
     */
    public function profil_user()
    {
        $id = $this->session->userdata('id');
        $this->load->model('User_model');
        $result = $this->User_model->get_user_by_id($id);
        $user_info = $result->row();
        $user_view['user_info'] = $user_info;
        $this->load->view('header');
        $this->load->view('user_info', $user_view);
        $this->load->view('footer');
    }

    /**
     * deconnection
     */
    public function sign_out()
    {
        // récupération des varibles de sessions dans un tableau
        $session_user = array('id', 'firstname', 'lastname', 'login', 'mail', 'role');
        // suppresion des variables de session
        $this->session->unset_userdata($session_user);
        // redirection vers la page d'accueil du sitem
        redirect(site_url('Produits/home_user'));
    }

}
