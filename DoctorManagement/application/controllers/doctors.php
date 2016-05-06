<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Doctors extends CI_Controller {
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

				// Define all of the currencies
				$this->currencies = array('USD', 
										'AED',
										'AUD',
										'BRL',
										'CAD',
										'CHF',
										'CNY',
										'EUR',
										'JPY', 
										'MXN',
										'GBP', 
										'SGD', 
										'TRL', 
										'ZAR');

				// Load the session library
				$this->load->library('session');

				// Load the common helper file
				$this->load->helper('common_helper');

				// Load all of the models
				$this->load->model('database_model', 'database');
			}

			public function Index() {
				// Redirect the user to HTTPS
				if($this->base_url == 'https://voyagermed.com/') {
					if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == '') {
	    				header('Location: https://voyagermed.com'.$_SERVER['REQUEST_URI']);
	    			}
	    		}

	    		// Find out if the user is logged in or not
				$user_id = $this->session->userdata('user_id');
				$session_id = $this->session->userdata('protection_id');
				$session = ($user_id ? TRUE : FALSE);
				$staging_ses = ($session_id ? TRUE : FALSE);

				// Get the URL parameters
				$id = $this->uri->segment(2, 'a');
				$num = $this->uri->segment(3, 0);
				
				// Define the letter array
				$letters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

				if(in_array($id, $letters)) {
					$header = array('title' => 'Browse',
									'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
									'langs' => $this->langs,
									'session' => $session,
									'staging_ses' => $staging_ses,
									'single' => FALSE);
					$body = array('letters' => $letters,
								'letter' => $id);

					// Load all of the views
					$this->load->view('templates/header', $header); 
					$this->load->view('directory', $body); 
					$this->load->view('templates/footer'); 
				} else {
					// Parse the doctor's name
					$exp = explode('-', $id);

					if(count($exp) > 1) {
						$name_set = TRUE;
						$id = trim($exp[0]).' '.trim(end($exp));
					}  else {
						$name_set = FALSE;
					}
                   
					// Get the doctor's info
					$info = $this->database->GetDoctorInfo($id, $num);       
                    //var_dump($info);exit;
					if(!$name_set) {
						header('Location: '.$this->base_url.'doctors/'.$info['first'].'-'.$info['last']);
					} else {
						if($info) {
							// Get all of the doctors specialties
							$specialties = $this->database->GetDoctorSpecialties($info['id']);

							// Get the doctor's certifications
							$certs = $this->database->GetDoctorCerts($info['id']);	//var_dump($certs);exit;					

							// Get the doctor's schools
							$schools = $this->database->GetDoctorSchools($info['id']);

							// Get the doctor's hospital affiliations
							$hospitals = $this->database->GetDoctorHospitals($info['id']);

							// Get the doctor's hospital affiliations
							$insurance = $this->database->GetDoctorInsurance($info['id']);

							// Get the doctor's awards, memberships and interests
							$ami = $this->database->GetDoctorAMI($info['id']);

							// Get the doctors reviews
							$reviews = $this->database->GetDoctorReviews($info['id']);
							// FormatArray($reviews);

							// Define all of the cities that have Pinterest boards
							$pin_cities = array('New York', 'Los Angeles', 'Beverly Hills', 'Miami', 'Las Vegas', 'Dallas', 'Houston');

							// Get the masonry pics
							$pics = $this->database->GetMasonryPics($info['id']);
							$path = $this->base_url.'public/images/doctors/masonry/'.strtolower($info['first']).'_'.strtolower($info['last']).'/';
                              
							$scan = scandir('public/images/hospitals/');
							$hosp_pics = array_slice($scan, 3);
							$icons = [];

							for($i=0;$i<count($hospitals);$i++) {
								$replace = strtolower(str_replace(' ', '_', $hospitals[$i]['name']));

								if(file_exists($replace.'.png')) {
									array_push($icons, $replace);
								}
							}
							// echo '<br><br><br><br>';
							// FormatArray($hospitals);

							// Set all of the info that needs to be passed to the header view
                            //var_dump($info['first'].' '.$info['last'].' - '.FormatProfession($info['field']).', '.$info['city']);exit;
							$header = array('title' => $info['first'].' '.$info['last'].' - '.FormatProfession($info['field']).', '.$info['city'] . ', Reviews, Cost, Pictures',
											'description' => substr(strip_tags($info['bio']), 0, 155),
											'id' => $info['id'],
											'first' => $info['first'],
											'last' => $info['last'],
											'img' => $info['img'],
											'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
											'langs' => $this->langs,
											'session' => $session,
											'single' => TRUE);

							// Find out if the street view is different than the hotel map
							$inconsistent = ($info['lon'] != $info['map_lon'] && !empty($info['map_lon']) ? 'false' : 'true');
                           
							// Define the body info
							$body = array('doctor' => $info,
										'currencies' => $this->currencies,
										'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
										'specialties' => $specialties,
										'certs' => $certs,
										'education' => $schools,
										'insurance' => $insurance,
										'hospitals' => $hospitals,
										'reviews' => $reviews,
										'ami' => $ami,
										'pics' => $pics,
										'path' => $path,
										'icons' => $icons,
										'pinterest' => (in_array($info['city'], $pin_cities) ? TRUE : FALSE),
										'inconsistent' => $inconsistent);
                                        

							// Load all of the views
							$this->load->view('templates/header', $header); 
							$this->load->view('doctor', $body); 
							$this->load->view('templates/footer'); 
							// $this->output->enable_profiler(TRUE);
						} else {
							// Redirect the user to the URL that's formatted with the pretty URL
							header('Location: '.$this->base_url);
						}
					}
				}
			}

			public function Browse() {
				// Get the letter from the URL
				$letter = $this->input->get('letter');
				// Get the doctors whose last name starts with the given letter
				$doctors = $this->database->GetDoctorsByLastName($letter);
				// FormatArray($doctors);
				
				// Load the view
				$this->load->view('backend/directory', $doctors);
			}
            
            public function BrowseByName(){
                // Get the letter from the URL
                $name = $this->input->get('name');
                $names = explode(" ", $name);
                
                // Get the doctors whose last name starts with the given letter
                $doctors = $this->database->GetDoctorsByName($names[0], $names[1]);
                // FormatArray($doctors);                        
                // Load the view
                $this->load->view('backend/directory', $doctors);
            }

			public function GetInfo() {
				$type = $this->input->get('type');
				$id = $this->input->get('id');
				$unit = $this->input->get('unit');
				// var_dump($type);

				switch($type) {
					case'Procedures':
					case'Currency':

						$results = $this->database->GetDoctorSpecialties($id, $unit);
						break;

					case'Overview':

						$results = $this->database->GetDoctorInfo($id);
						$results['count'] = 1;
						break;

					case'Reviews':

						$results = $this->database->GetDoctorSpecialties($id);
				}

				// Define the info that will be passed to the view
				$body = array('type' => $type,
							'doctor_id' => $id,
							'results' => $results,
							'unit' => $unit);

				// Load the view
				$this->load->view('backend/procedures_list', $body);
			}

			public function GetSimilarDoctors() {
				// Get the doctor ID from the URL
				$id = $this->input->get('doctor_id');
				$page = $this->input->get('page');

				// Get similar doctors
				$similar = $this->database->GetSimilarDoctors($id);
				$count = count($similar);

				// Define the pagination variables
				$per_page = 3;
				$pages = ceil($count/$per_page);
    			$start = $page*$per_page;

    			if($page == ($pages-1)) {
    				$mod = $count%$per_page;
    				$end = ($mod > 0 ? $start+$mod : $start+$per_page);
    			} else {
    				$end = $start+$per_page;
    			}

    			// Define all of the info that is passed to the view
    			$body_info = array('similar' => $similar,
    								'count' => $count,
    								'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
    								'page' => $page,
    								'pages' => $pages,
    								'new_page' => ($page+1),
    								'start' => $start,
    								'end' => $end);
    			// FormatArray($body_info);

				// Load the view
				$this->load->view('backend/similar_doctors', $body_info);
			}

			public function EditProfile() {
				// Get the parameters from the URL
				$id = $this->input->get('id');
				$type = $this->input->get('type');

				// Get the doctor's info
				$info = $this->database->GetDoctorInfo($id);

				// Get the doctor's certification
				$certs = $this->database->GetDoctorCerts($id);
				$info['certs'] = $certs;

				// Load the view
				if($type == 0) {
					$this->load->view('doc_edit', $info);
				} else {
					$this->load->view('doc_edited', $info);
				}
			}
		}
	}
