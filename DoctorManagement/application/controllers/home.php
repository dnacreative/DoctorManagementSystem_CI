<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Home extends CI_Controller {
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
				
				// Define all of the currencies
				$this->currencies = array('USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD', 'BRL', 'SGD', 'TRL', 'ZAR', 'AED', 'MXN', 'CNY','JPY');

				// Load the session library
				$this->load->library('session');

				// Load all of the models
				$this->load->model('database_model', 'database');
				$this->load->model('locations_model', 'loc');
				$this->load->model('expedia_model', 'expedia');
				$this->load->model('excel_model', 'excel');
				$this->load->model('betterdoctor_model', 'betterdoctor');
			}

			public function Index() {
				if($this->base_url == 'https://voyagermed.com/') {
					if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == '') {
	    				header('Location: https://voyagermed.com'.$_SERVER['REQUEST_URI']);
	    			}
	    		}

				$this->output->set_content_type('text/html; charset=utf-8');
				// $this->output->enable_profiler(TRUE);

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

				// if($user_id) {
					// Define the document's title and the view to load
					$view = 'home';

					// Get the price averages
					$mi = $this->database->GetProcedureAvg(146);
					$la = $this->database->GetProcedureAvg(243);
					$ny = $this->database->GetProcedureAvg(270);
					$bh = $this->database->GetProcedureAvg(231);
					
					// Define the prices for each city
					$prices = array('miami' => array('usd' => $mi,
													'gbp' => $this->database->TranslateCurrency('gbp', $mi), 
													'eur' => $this->database->TranslateCurrency('eur', $mi)
													),
									'los_angeles' => array('usd' => $la,
													'gbp' => $this->database->TranslateCurrency('gbp', $la), 
													'eur' => $this->database->TranslateCurrency('eur', $la)
													),
									'new_york' => array(
													//'usd' => $ny,
													//'gbp' => $this->database->TranslateCurrency('gbp', $ny), 
													//'eur' => $this->database->TranslateCurrency('eur', $ny)
													),
									'beverly_hills' => array(
													//'usd' => $bh,
													//'gbp' => $this->database->TranslateCurrency('gbp', $bh), 
													//'eur' => $this->database->TranslateCurrency('eur', $bh)
													)
								);		

					// Define all of the doctors who will be featured on the landing page
					$doctors[0] = array('id' => 493, 
										'name' => 'Struan Coleman', 
										'city' => 'New York, NY', 
										'pic' => 'struan_coleman.jpg',
										'title' => 'Orthopedic Surgeon',
										'specialties' => array('Hip Replacement', 'Knee Replacement', 'Hip Arthroscopy'));
					$doctors[1] = array('id' => 287, 
										'name' => 'Victoria Veytsman', 
										'city' => 'New York, NY', 
										'pic' => 'victoria_veytsman.jpg',
										'title' => 'Cosmetic Dentist',
										'specialties' => array('Cosmetic Dentistry', 'Smile Makeover', 'Invisalign'));
					$doctors[2] = array('id' => 491, 
										'name' => 'Ronald Hillock', 
										'city' => 'Las Vegas, NV', 
										'pic' => 'ronald_hillock.jpg',
										'title' => 'Orthopedic Surgeon',
										'specialties' => array('Hip Replacement', 'Knee Replacement', 'Hip Arthroscopy'));
					$doctors[3] = array('id' => 492, 
										'name' => 'John Peloza', 
										'city' => 'Dallas, TX', 
										'pic' => 'john_peloza.jpg',
										'title' => 'Spine Surgeon',
										'specialties' => array('Spine Surgery', 'Disc Replacement', 'Stem Cell'));
					$doctors[4] = array('id' => 8, 
										'name' => 'Darrick Antell', 
										'city' => 'New York, NY', 
										'pic' => 'darrick_antell.jpg',
										'title' => 'Plastic Surgeon',
										'specialties' => array('Face Lift', 'Rhinoplasty', 'Breast Augmentation'));
					$doctors[5] = array('id' => 21272,
										'name' => 'Brian J Cole',
										'city' => 'Chicago, IL',
										'pic' => 'brian_cole.jpg',
										'title' => 'Orthopedic',
										'specialties' => array('Arthroscopy', 'Knee Surgery', 'Shoulder Surgery'));
					$doctors[6] = array('id' => 127, 
										'name' => 'Leonard Hochstein', 
										'city' => 'Miami, FL', 
										'pic' => 'leonard_hochstein.jpg',
										'title' => 'Plastic Surgeon',
										'specialties' => array('Breast Augmentation', 'Mommy Makeover', 'Tummy Tuck'));
					$doctors[7] = array('id' => 34770, 
										'name' => 'Bahram Ghaderi', 
										'city' => 'St Charles, Illinois', 
										'pic' => 'bahram_ghaderi.jpg',
										'title' => 'Plastic Surgeon',
										'specialties' => array('Facial Rejuvenation', 'Breast Augmentation', 'Body Contouring'));		
					// FormatArray($doctors);

					// Define the info that will be passed to the body view
					$body = array('doctors' => $doctors, 
								'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'), 
								'prices' => $prices);
				/*
				} else {
					$title = 'Login';
					$view = 'landing';
					$body = [];
				}
				*/

				$desc = "Find the best doctors in the U.S. with our online marketplace for medical tourism. Great healthcare, world-renowned doctors all at affordable costs.";
				// echo strlen($desc);
				// die;

				// Set all of the info that needs to be passed to the header view
				$header = array('title' => "Find & travel to the best U.S. doctors",
								'description' => $desc,
								'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
								'langs' => $this->langs,
								'session' => $session,
								'staging_ses' => $staging_ses);

				// Load all of the views
				$this->load->view('templates/header', $header); 
				$this->load->view($view, $body); 
				$this->load->view('templates/footer');  
			}

			public function BackendLocations() {
				// Get the query string from the URL
				$q = $this->input->get('q');
                
				// Get all of the relevant procedures
				$list = $this->database->SearchLocations($q);

				// Determine the end point of the loop
		    	// $end = (count($list) >= 5 ? 5 : count($list));
		    	// FormatArray($list);
				$end = count($list);

				// Define the data that will be passed to the view
				$data = array('results' => $list, 
							'count' => count($list),
							'length' => strlen($q),
							'end' => $end,
							'q' => $q);

				// Load the autocomplete view
				$this->load->view('backend/locations', $data); 
			}

			public function ChangeLang() {
				// Update the language session variable
				$lang = $this->input->get('lang');
				$this->session->set_userdata('lang', $lang);
			}

			public function GetLocation() {
				// Get the city and the state from the URL
				$city = $this->input->get('city');
				$state = $this->input->get('state');
				$location = $this->loc->LocationFromAddress(NULL, $city, $state);
				print_r($location);
			}

			public function LocationFromCoords() {
				// Get the lon & lat from the URL
				$lon = $this->input->get('lon');
				$lat = $this->input->get('lat');
				echo json_encode($this->loc->GeoLocation($lon, $lat));
			}

			public function Test() {
				$this->excel->InsertMasonry();
				
				/*
				$url = 'http://voyagermed.com/';
				$pros = array('Tummy Tuck', 'Liposuction', 'Breast Augmentation', 'Face Lift', 'Mommy Makeover');
				$cities = array('New York, NY', 'Boston, MA', 'Miami, FL', 'Las Vegas, NV', 'Chicago, IL', 'Los Angeles, CA', 'Beverly Hills, CA', 'San Francisco, CA', 'Dallas, TX', 'Atlanta, GA');

				foreach($pros as $pro) {
					foreach($cities as $city) {
						echo '<a href="'.$url.'search/'.$pro.'/'.$city.'/Price Lowest" target="_blank">'.$url.'search/'.$pro.'/'.$city.'/Price Lowest</a> <br>';
					}
				}

				// Insert liposuction for every doctor
				$doctors = $this->database->GetDoctors();

				for($i=0;$i<count($doctors);$i++) {
					$info = array('doctor_id' => $doctors[$i]['id'], 
								'name' => 'Liposuction',
								'name_id' => 255,
								'price' => NULL,
								'procedure_name' => 'Liposuction',
								'real_id' => 255,
								'is_match' => 2);
					$this->database->InsertSpecialty($info);
				}
		
				die;
			
				$q = "see more";
				$langs = array('zh-TW' => 'Mandarin',
								'pt-BR' => 'Portugese',
								'ru' => 'Russian',
								'ko' => 'Korean',
								'es' => 'Spanish',
								'de' => 'German',
								'fr' => 'French',
								'it' => 'Italian',
								'ar' => 'Arabic',
								'ja' => 'Japanese');

				foreach($langs as $key => $val) {
					echo '<b>'.$val.'</b><br>';
					echo TranslateText($q, 'en', $key).'<br>';
				}
				*/
			}
			
			public function Translate() {
				$lang = $this->input->get('lang');
				$text = $this->input->get('text');
				echo TranslateText($text, $lang);
			}
		}
	}
