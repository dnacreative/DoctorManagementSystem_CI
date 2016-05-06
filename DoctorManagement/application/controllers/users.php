<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Users extends CI_Controller {
			public function __construct() {       
				parent:: __construct();
				
				// Get the base URL
				$this->base_url = $this->config->base_url();

				// Load the session library
				$this->load->library('session');

				// Load all of the models
				$this->load->model('database_model', 'database');
			}

			public function Index() {
			
			}

			public function Login() {
               /* 
				// Get the form values
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				// Define an array containing all of the acceptable users
				$users = array('anthony', 'lance');
				
				if(in_array($username, $users) && $password == 'Wework2015') {
					// Start a session
					$this->session->set_userdata(array('user_id' => 20));
					$this->session->sess_expiration = 7200;
					echo 'true';
				} else {
					echo 'error';
				}
                
				// Redirect the user to the home page
				// header('Location: '.$this->base_url);
                */
			}

			public function Logout() {
				// Destroy the user's session
				$this->session->sess_destroy();
				// FormatArray($this->session->all_userdata());
				header('Location: '.$this->base_url);
			}

			public function SignUp() {
                /*
				// Get the POST parameters from the URL
				$email = $this->input->post('email');
				$pass = $this->input->post('pass');
				$confirm = $this->input->post('confirm');

				// Register the user into the DB
				$register = $this->database->SignUp($email, $pass, $confirm);

				if($register == 'success') {
					// Get the user's email
					$login = $this->database->Login($email, $pass);

					// Create a new session
					$this->session->set_userdata(array('user_id' => $login['id']));
					$this->session->sess_expiration = 7200;

					// Load the email library
					$this->load->library('email');
					$this->email->set_mailtype('html');
				    $this->email->from('noreply@voyagermed.com', 'VoyagerMed');
				    $this->email->to($email);
				    $this->email->subject('Your VoyagerMed Account');

				    $email = '<p>
				    			Hi,<br><br>

				    			Your VoyagerMed account has successfully been created.<br>

				    			Thanks,<br><br>

				    			The VoyagerMed Team
				    		</p>';

				    $this->email->message($email);
				    $this->email->send();
				}

				echo $register;      */
			}

			public function SignIn() {
                /*
				// Get the form values
				$email = $this->input->post('email');
				$pass = $this->input->post('pass');

				$admins = array('anthony@voyagermed.com', 'kate@voyagermed.com', 'lance@voyagermed.com');

				if(in_array($email, $admins)) {
					if($pass == 'Voyager2014!') {
						$this->session->set_userdata(array('protection_id' => 1, 'admin' => 1));
						$this->session->sess_expiration = 7200;
						echo 'success';
					} else {
						echo 'fail';
					}
				} else {
					// Log the user in
					$login = $this->database->Login($email, $pass);

					if($login) {
						$this->session->set_userdata(array('user_id' => $login['id'], 'admin' => $login['admin']));
						$this->session->sess_expiration = 7200;
						echo 'success';
					} else {
						echo 'fail';
					}
				}
                */
			}
		}
	}