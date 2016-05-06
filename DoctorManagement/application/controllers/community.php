<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Community extends CI_Controller {
			public function __construct() {       
				parent:: __construct();
				
				// Get the base URL
				$this->base_url = $this->config->base_url();

				// Define all of the languages
				$this->langs = array('en' => 'English',
									'ar' => 'Arabic',
									'fr' => 'French',
									'de' => 'German',
									'hi' => 'Hindi',
									'it' => 'Italian',
									'ja' => 'Japanese',
									'ko' => 'Korean',
									'zh-TW' => 'Mandarin',
									'pt-BR' => 'Portuguese',
									'ru' => 'Russian',
									'es' => 'Spanish');

				// Load the session library
				$this->load->library('session');

				// Load the common helper file
				$this->load->helper('common_helper');
				
				// Load all of the models
				$this->load->model('database_model', 'database');
			}

			public function Index() {
				if($this->base_url == 'https://voyagermed.com/') {
					if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == '') {
	    				header('Location: https://voyagermed.com'.$_SERVER['REQUEST_URI']);
	    			}
	    		}

				$user_id = $this->session->userdata('user_id');
				$session_id = $this->session->userdata('protection_id');
				$session = ($user_id ? TRUE : FALSE);
				$staging_ses = ($session_id ? TRUE : FALSE);

				// Check to see if this is the staging site
	    		if(ENVIRONMENT != 'production') {
	    			if(!$staging_ses) {
	    				header('Location: '.$this->base_url.'signin');
	    			}
	    		}
				
				// Get the discussion name from the URL
				$name = $this->uri->segment(2, NULL);

				if($name) {
					// Call this method to query the DB for info about the name
					$info = $this->database->GetTagName($name);

					if($info) {
						// Define the title 
						$desc = 'Ask a plastic surgeon about '.str_replace('-', ' ', $name).' and learn more about plastic surgery here. Join the VoyagerMed community and share stories, photos and experiences about '.str_replace('-', ' ', $name).'.';

						// Define the header array
						$header = array('title' => str_replace('-', ' ', $name),
										'description' => $desc,
										'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
										'langs' => $this->langs,
										'term' => $name,
										'session' => $session,
										'staging_ses' => $staging_ses);
						
						// Define the body array
						$body = array('title' => $desc,
									'placeholder' => 'Leave a comment',
									'keyword' => $name,
									'session' => ($session_id ? 'true' : 'false'));

						// Load all of the views
						$this->load->view('templates/header', $header); 
						$this->load->view('community', $body); 
						$this->load->view('templates/footer'); 
					} else {
						header('Location: '.$this->base_url);
					}
				} else {
					header('Location: '.$this->base_url);
				}
			}

			public function Comment() {
				// Get the client's user ID
				$user_id = $this->session->userdata('user_id');

				// Get the comment value from the form submission
				$comment = $this->input->post('comment');
				$keyword = $this->input->post('keyword');

				if(!empty($comment)) {
					$submit = $this->database->InsertComment($keyword, $comment);

					if($submit) {
						echo 'success';
					} else {
						echo 'fail';
					}
				} else {
					echo 'fail';
				}
			}

			public function GetComments() {
				// Get the keyword from the URL
				$keyword = $this->input->get('keyword');
				
				// Get all of the comments from the DB
				$comments = $this->database->GetComments($keyword);
				// FormatArray($comments);

				// Load the comments view
				$this->load->view('backend/comments', $comments);
			}
		}
	}