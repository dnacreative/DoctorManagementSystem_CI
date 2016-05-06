<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Clinics extends CI_Controller {
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
				$id = urldecode($this->uri->segment(2, NULL));
				// var_dump($clinic_id);
				// die;

				// Get info about the clinic
				$clinic = $this->database->GetClinicInfo($id);

				if(is_array($clinic)) {
					// Set all of the info that needs to be passed to the header view
					$header = array('title' => $clinic['name'],
									'session' => $session,
									'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
									'langs' => $this->langs);

					// Define the body info
					$body = array('clinic_info' => $clinic);

					// Load all of the views
					$this->load->view('templates/header', $header); 
					$this->load->view('clinics', $body); 
					$this->load->view('templates/footer'); 
				} else {
					header('Location: '.$this->base_url);
				}
			}

			public function Backend() {
				// Get the page numer from the URL
				$page = $this->input->get('page');

				// Search for all of the clinics from the DB
				$clinics = $this->database->GetAllClinics();

				// Store all of the info that will be passed to the view in an array
				$body = array('clinics' => $clinics, 'page' => $page);

				// Load the view
				$this->load->view('backend/clinics', $body); 
			}
		}
	}