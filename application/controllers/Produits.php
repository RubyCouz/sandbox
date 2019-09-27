<?php

// application/controllers/Produits.php	
//instruction de sécurité empéchant l'accÃ¨s direct au fichier
defined('BASEPATH') OR exit('No direct script access allowed');

// création de la classe Produits héritant des propriétés de la classe CI_Controller (important : nom de la classe avec premiÃ¨re lettre en majuscule, tout comme le fichier)
class Produits extends CI_Controller {

    /**
     * Affichage de la page d'accueil
     */
    public function home()
    {
            $this->load->view('header');
            $this->load->view('home');
            $this->load->view('footer');
        }

    /**
     * affichage vue catalogue client
     */
    public function home_user()
    {
//        $user_id = $this->session->userdata('id');
//        $user_role = $this->session->userdata('role');
//        $user_login = $this->session->userdata('login');
//        $user_firstname = $this->session->userdata('firstname');
//        $user_lastname = $this->session->userdata('lastname');
//        $user_mail = $this->session->userdata('mail');
//        var_dump($user_mail);

        // chargement du model "Prod_model"
        $this->load->model('Prod_model');
        // appel de la méthode "liste()" du model précédemment chargé
        $productList = $this->Prod_model->liste();
        $listView['productList'] = $productList;

        $this->load->view('header');
        $this->load->view('home_user', $listView);
        $this->load->view('footer');
    }

    /**
     * affichage de la liste de produits
     */
    public function liste()
    {

// chargement des fichiers vues
        $this->load->view('header');
        $this->load->view('liste', $listView);
        $this->load->view('footer');
    }

    /**
     * Ajout d'un produit
     */
    public function addProduct()
    {
//$this->output->enable_profiler(TRUE);
// ATTENTION Au FORMULAIRE : IL FAUT QUE LES NAMES DES INPUT SOIENT IDENTIQUES AUX NOMS DES CHAMPS DE LA TABLE, ET SUPPRIMER LE POST['SUBMIT']
        if ($this->input->post())
        {
            $this->form_validation->set_rules(
                    'pro_cat_id', 'Catégories', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs catégorie n\'est pas renseigné', 'regex_match' => 'Champs catégorie non valide'));
            $this->form_validation->set_rules(
                    'pro_ref', 'Référence', 'required|regex_match[/^[a-zA-Z\d]+$/]', array('required' => 'Le champs référence n\'est pas renseigné', 'regex_match' => 'Champs référence non valide'));
            $this->form_validation->set_rules(
                    'pro_couleur', 'Couleur', 'required|regex_match[/^[a-zA-Z]+$/]', array('required' => 'Le champs couleur n\'est pas renseigné', 'regex_match' => 'Champs couleur non valide'));
            $this->form_validation->set_rules(
                    'pro_libelle', 'Libellé', 'required|regex_match[/^[a-zA-Z\d ]+$/]', array('required' => 'Le champs libellé n\'est pas renseigné', 'regex_match' => 'Champs libellé non valide'));
            $this->form_validation->set_rules(
                    'pro_prix', 'Prix', 'required|regex_match[/^[\d]+[.]?[\d]{1,2}$/]', array('required' => 'Le champs prix n\'est pas renseigné', 'regex_match' => 'Champs prix non valide'));
            $this->form_validation->set_rules(
                    'pro_stock', 'Stock', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs stock n\'est pas renseigné', 'regex_match' => 'Champs stock non valide'));
            $this->form_validation->set_rules(
                    'pro_description', 'Description', 'required|regex_match[/^[a-zA-Z\d\|\_ ÃªÃ«Ã¹Ã¼Ã»Ã®Ã¯Ã Ã¤Ã¢Ã¶Ã´\,\.\:\;\!\?]+$/]', array('required' => 'Le champs description n\'est pas renseigné', 'regex_match' => 'Champs description non valide'));
            if ($this->form_validation->run() == FALSE)
            {
                /**
                 * Affichage des categories de produits dans la liste déroulante
                 */
                // chargement du model "Prod_model"
                $this->load->model('Cat_model');
                // appel de la méthode "liste()" du model précédemment chargé
                $categoriesList = $this->Cat_model->categoriesList();
                $catView['categoriesList'] = $categoriesList;
                /**
                 * Affichage du formulaire d'ajout
                 */
                $this->load->view('header');
                $this->load->view('addProduct', $catView);
                $this->load->view('footer');
            }
            else
            {
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/');
                //type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
                // chargement du helper pour l'upload
                $this->load->library('upload', $config);
                // upload du fichier
                $this->upload->do_upload("pro_photo");
                //gestion des erreurs pour l'upload
                $error = $this->upload->display_errors();
                if ($error == '')
                {
                    $file = $this->upload->data();

                    $this->load->model('Prod_model');
                    $this->Prod_model->addProduct();
                    $id = $this->db->insert_id();
                    // renommage du final
                    rename($file["full_path"], realpath('assets/img/') . "/" . $id . $file["file_ext"]);
                    $this->load->view('header');
                    $this->load->view('confirmAdd');
                    $this->load->view('footer');

                    //Ã  utiliser si les classes sont autochargées
                    //$this->upload->initialize($config);
                }
                else
                {
                    /**
                     * Affichage des categories de produits dans la liste déroulante
                     */
                    // appel de la classe catégoriesModel
                    $this->load->model('Cat_model');
                    // appel de la méthode "liste()" du model précédemment chargé
                    $categoriesList = $this->Cat_model->categoriesList();
                    // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue
                    $catView['categoriesList'] = $categoriesList;
                    $catView['error'] = $error;
                    /**
                     * Affichage du formulaire d'ajout
                     */
                    $this->load->view('header');
                    $this->load->view('addProduct', $catView);
                    $this->load->view('footer');
                }
            }
        }
        else
        {

            /**
             * Affichage des categories de produits dans la liste déroulante
             */
            // appel de la classe catégoriesModel
            $this->load->model('Cat_model');
            // appel de la méthode "liste()" du model précédemment chargé
            $categoriesList = $this->Cat_model->categoriesList();
            // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue
            $catView['categoriesList'] = $categoriesList;
            /**
             * Affichage du formulaire d'ajout
             */
            $this->load->view('header');
            $this->load->view('addProduct', $catView);
            $this->load->view('footer');
        }
    }

    /**
     * modification d'un produit
     */
    public function update($id)
    {
//affichage du détail de l'action (-> debbuger, Ã  retenir)
//$this->output->enable_profiler(TRUE);
// chargement des helpers d'url
        $this->load->helper('url');
// chargement du helper de formulaire
        $this->load->helper('form');
// chargement du helper de validation du formulaire
        $this->load->library('form_validation');

        if ($this->input->post())
        {
            $this->form_validation->set_rules(
                    'pro_cat_id', 'Catégories', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs catégorie n\'est pas renseigné', 'regex_match' => 'Champs catégorie non valide'));
            $this->form_validation->set_rules(
                    'pro_ref', 'Référence', 'required|regex_match[/^[a-zA-Z\d]+$/]', array('required' => 'Le champs référence n\'est pas renseigné', 'regex_match' => 'Champs référence non valide'));
            $this->form_validation->set_rules(
                    'pro_couleur', 'Couleur', 'required|regex_match[/^[a-zA-Z]+$/]', array('required' => 'Le champs couleur n\'est pas renseigné', 'regex_match' => 'Champs couleur non valide'));
            $this->form_validation->set_rules(
                    'pro_libelle', 'Libellé', 'required|regex_match[/^[a-zA-Z\d ]+$/]', array('required' => 'Le champs libellé n\'est pas renseigné', 'regex_match' => 'Champs libellé non valide'));
            $this->form_validation->set_rules(
                    'pro_prix', 'Prix', 'required|regex_match[/^[\d]+[.]?[\d]{1,2}$/]', array('required' => 'Le champs prix n\'est pas renseigné', 'regex_match' => 'Champs prix non valide'));
            $this->form_validation->set_rules(
                    'pro_stock', 'Stock', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs stock n\'est pas renseigné', 'regex_match' => 'Champs stock non valide'));
            $this->form_validation->set_rules(
                    'pro_description', 'Description', 'required|regex_match[/^[a-zA-Z\d\|\_ éèàùöïüëäçîôûêâ\,\.\:\;\!\?]+$/]', array('required' => 'Le champs description n\'est pas renseigné', 'regex_match' => 'Champs description non valide'));
            if ($this->form_validation->run() == FALSE)
            {

                // appel de la classe catégoriesModel
                $this->load->model('Prod_model');
                // appel de la méthode "liste()" du model précédemment chargé
                $productById = $this->Prod_model->productById($id);
                // récupération du résultat (premiÃ¨re ligne)
                $productByIdView['produits'] = $productById->row();


//                 // appel de la classe catégoriesModel
                $this->load->model('Cat_model');
                // appel de la méthode "liste()" du model précédemment chargé
                $categoriesList = $this->Cat_model->categoriesList();

                // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue
                $productByIdView['categoriesList'] = $categoriesList;
                // chargement des vues
                $this->load->view('header');
                $this->load->view('updateProduct', $productByIdView);
                $this->load->view('footer');
            }
            else
            {
                $data = $this->input->post();
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/');
                //type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
                // chargement du helper pour l'upload
                $this->load->library('upload', $config);
                // condition s'il n'y a pas de photo ajoutée
                if ($this->upload->do_upload('pro_photo'))
                {
                    //gestion des erreurs pour l'upload
                    $error = $this->upload->display_errors();
                    $file = $this->upload->data();
                    // renommage du fichier final
                    rename($file['full_path'], realpath('assets/img/') . '/' . $id . $file['file_ext']);
                }
                // appel de la classe Prod_model
                $this->load->model('Prod_model');
                // appel de la méthode modifiant un produit selon son id
                $this->Prod_model->update($id);
                $this->load->view('header');
                $this->load->view('confirm');
                $this->load->view('footer');
                //redirect('produits/liste');
            }
        }
        else
        {
            // appel de la classe catégoriesModel
            $this->load->model('Prod_model');
            // appel de la méthode "liste()" du model précédemment chargé
            $productById = $this->Prod_model->productById($id);
            // récupération du résultat (premiÃ¨re ligne)
            $productByIdView['produits'] = $productById->row();
            // appel de la classe catégoriesModel
            $this->load->model('Cat_model');
            // appel de la méthode "liste()" du model précédemment chargé
            $categoriesList = $this->Cat_model->categoriesList();

            // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue

            $productByIdView['categoriesList'] = $categoriesList;
            // chargement des vues
            $this->load->view('header');
            $this->load->view('updateProduct', $productByIdView);
            $this->load->view('footer');
        }
    }

    /**
     * Suppression d'un produit
     */
    public function delete($id)
    {
        $this->output->enable_profiler(TRUE);
// appel de l'helper pour la gestion des urls
        $this->load->helper('url');
// chargement du model Prod_model
        $this->load->model('Prod_model');
// appel de la méthode delete
        $this->Prod_model->delete($id);
// redirection vers la liste de produit
//redirect('produits/liste');
    }

    public function sendMail()
    {

        $this->load->library('email');
        if ($this->input->post())
        {
            $this->form_validation->set_rules(
                    'mail', 'Adresse mail', 'required|regex_match[/^[a-zA-Z0-9.!#$%&’*?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*/]', array('required' => 'Le champs "Adresse mail" n\'est pas renseigné', 'regex_match' => 'Champs "Adresse mail" non valide'));
            $this->form_validation->set_rules(
                    'subject', 'Sujet', 'required|regex_match[/^[a-zA-Z\d\|\_ éèàùöïüëäçîôûêâ\,\.\:\;\!\?]+$/]', array('required' => 'Le champs "Sujet" n\'est pas renseigné', 'regex_match' => 'Champs "Sujet" non valide'));
            $this->form_validation->set_rules(
                    'content', 'Message', 'required|regex_match[/^[a-zA-Z\d\|\_ éèàùöïüëäçîôûêâ\,\.\:\;\!\?]+$/]', array('required' => 'Le champs "Message" n\'est pas renseigné', 'regex_match' => 'Champs "Message" non valide'));
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('header');
                $this->load->view('contact');
                $this->load->view('footer');
            }
            else
            {
                $this->email->from($this->input->post('mail'));
                $this->email->to('ced270784@gmail.com');
                $this->email->subject($this->input->post('subject'));
                $this->email->message($this->input->post('content'));
                if ($this->email->send())
                {
                    $data['result_class'] = "alert-success";
                    $data['result_message'] = "Merci de nous avoir envoyé ce mail. Nous y répondrons dans les meilleurs délais.";
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
                $this->load->view('header');
                $this->load->view('result', $data);
                $this->load->view('footer');
            }
        }
        else
        {
            $this->load->view('header');
            $this->load->view('contact');
            $this->load->view('footer');
        }
    }

}

/**
     * Affichage de la vue :
     */
// dans url => http://localhost/ci/index.php/produits/liste.
//produit -> nom du controlleur
// liste -> nom de la methode affichant les vues.



    