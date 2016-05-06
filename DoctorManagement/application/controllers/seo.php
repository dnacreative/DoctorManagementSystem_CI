<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Seo extends CI_Controller {
			public function __construct() {       
				parent:: __construct();
				
				// Get the base URL
				$this->base_url = $this->config->base_url();

				// Load all of the models
				$this->load->model('database_model', 'database');
				$this->load->model('excel_model', 'excel');
			}

			public function Index() {  
				// Get all of the doctors
				$docs = $this->database->SeoDoctors();
				$search = $this->database->SeoSearches();
				$community = $this->database->CommunityPages();

				// Define the info for the sitemap view
				$info = array('doctors' => $docs, 
							'search' => $search,
							'community' => $community);

				// Load all of the views
				$this->load->view('sitemap', $info); 
			}

			public function Test() {
				// $this->database->CleanDoctors();
				$this->excel->InsertKeywords();
			}
		}
	}