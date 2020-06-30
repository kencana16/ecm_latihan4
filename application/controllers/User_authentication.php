<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User_Authentication extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
         
        // Load facebook oauth library 
        $this->load->library('facebook'); 
         
        // Load user model 
        $this->load->model('user'); 
    } 
     
    public function index(){ 
        $userData = array(); 
         
        // Authenticate user with facebook 
        if($this->facebook->is_authenticated()){ 
            // Get user info from facebook 
            $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture'); 
 
            // Preparing data for database insertion 
            $userData['oauth_provider'] = 'facebook'; 
            $userData['oauth_uid']    = !empty($fbUser['id'])?$fbUser['id']:'';; 
            $_firstname              = !empty($fbUser['first_name'])?$fbUser['first_name']:''; 
            $_lastname               = !empty($fbUser['last_name'])?$fbUser['last_name']:''; 
            $userData['nm_konsumen']        = $_firstname.' '.$_lastname; 
            $userData['username']        = $_firstname; 
            $userData['email']        = !empty($fbUser['email'])?$fbUser['email']:''; 
            $userData['foto']    = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
            $userData['group']    = 2;
             
            // Insert or update user data to the database 
            $userID = $this->user->checkUser($userData); 
             
            // Check user data insert or update status 
            if(!empty($userID)){ 
                $data['userData'] = $userData; 
                 
                // Store the user profile info into session 
                //-//$this->session->set_userdata('userData', $userData); 
                $this->session->set_userdata('id', $userID);
				$this->session->set_userdata('username', $userData['username']);
				$this->session->set_userdata('group', $userData['group']);
            }else{ 
               $data['userData'] = array(); 
            } 
             
            // Facebook logout URL 
            $data['logoutURL'] = $this->facebook->logout_url(); 
        }else{ 
            // Facebook authentication url 
            $data['authURL'] =  $this->facebook->login_url(); 
        } 
         
        // Load login/profile view 
        $this->load->view('user_authentication/index',$data); 
    } 
 
    public function logout() { 
        // Remove local Facebook session 
        $this->facebook->destroy_session(); 
        // Remove user data from session 
        $this->session->unset_userdata('userData'); 
        // Redirect to login page 
        redirect('user_authentication'); 
    } 
}