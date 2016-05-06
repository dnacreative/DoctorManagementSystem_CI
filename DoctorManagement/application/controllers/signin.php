<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Signin extends CI_Controller {
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

				// Load the common helper file
				$this->load->helper('common_helper');
				
				// Load the session library
				$this->load->library('session');
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

				if(!$session_id) {
					$header = array('title' => 'Sign In',
									'session' => FALSE,
									'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
									'langs' => $this->langs,
									'staging_ses' => $staging_ses);

					$body = array('lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'));

					// Load all of the views
					$this->load->view('templates/header', $header); 
					$this->load->view('signin', $body); 
					$this->load->view('templates/footer'); 
				} else {
					header('Location: '.$this->base_url);
				}
			}
		}
	}