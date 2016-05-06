<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Search extends CI_Controller {
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
                if(!$this->uri->segment(2)) 
                {
                    //there is no parameter
                    //header('Location: '.$this->base_url);
                    
                    //get procedures
                    $procedures = $this->database->GetAllSpecialties();
                    
                    // Set all of the info that needs to be passed to the header view
                    $header = array('title' => 'Search best doctors in the world ',                                
                                'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
                                'langs' => $this->langs,
                                );
                                
                    $body['procedures'] = $procedures;
                                        
                    $this->load->view('templates/header', $header);  
                    $this->load->view('search_default', $body); 
                    $this->load->view('templates/footer');
                    return;
                }
                // Put all of the categories into an array
                $categories = array('Bariatric', 'Cardiology', 'Dental', 'Fertility', 'Oncology', 'Orthopedic', 'Plastic Surgery', 'Spine');
				$user_id = $this->session->userdata('user_id');
				$session_id = $this->session->userdata('protection_id');
				$session = ($user_id ? TRUE : FALSE);
				$staging_ses = ($session_id ? TRUE : FALSE);
				$lang = ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en');
				
				if(strpos(urldecode($this->uri->segment(2)), ' ') 
	    		|| strpos(urldecode($this->uri->segment(3)), ' ')
	    		|| strpos(urldecode($this->uri->segment(4)), ' ')) {
	    			$pro_cor = str_replace(' ', '-', urldecode($this->uri->segment(2)));
	    			$loc_cor = str_replace(' ', '-', urldecode($this->uri->segment(3)));
	    			$sort_cor = str_replace(' ', '-', urldecode($this->uri->segment(4)));
	    			// echo $this->base_url.'search/'.$pro_cor.'/'.$loc_cor.'/'.$sort_cor;
	    			header('Location: '.$this->base_url.'search/'.$pro_cor.'/'.$loc_cor.'/'.$sort_cor);
	    		}

	    		// Get the parameters from the URL
				$procedure = str_replace('-', ' ', $this->uri->segment(2, 'everything'));
				$sort = str_replace('-', ' ', $this->uri->segment(4, 'distance-desc'));
				$loc = $this->uri->segment(3, 'all');
                
                
				// echo $procedure;
				// die;
                          
				// Validate the location
				if($loc == 'all') {
					$lon = NULL;
					$lat = NULL;
					$city = NULL;
					$state = NULL;
					$loc_text = 'all';
				} else {
					// Get the city and state names
					$exp = explode('-', $loc);
					$num = count($exp)-1;
					$state = end($exp);

					$city = '';
					for($i=0;$i<$num;$i++) {
						$city .= $exp[$i];

						if($i < $num) {
							$city .= ' ';
						}
					}
                    
					// Save the locations visual semantics
					$loc_text = $city.', '.$state;

					// Verify that the location exists
					$coords = $this->loc->MapquestLocation($city, $state);
					$lon = $coords['lng'];
					$lat = $coords['lat'];
                
				}
                 
				// Get the procedure ID
				$id = ($procedure == 'everything' ? FALSE : $this->database->GetProcedureId($procedure));
				$filter_ = ($procedure == 'everything' ? FALSE : TRUE);
				$in = [];
                               
				if($id) {  
					// Get the doctors who specialize in the given treatment
					$results = $this->database->GetDoctorsBySpecialty($id, $lat, $lon, NULL);  
                } else {
                    // Get all of the doctors in a given field
                    $results = $this->database->GetDoctorsInField($procedure, $lat, $lon);
                }

				for($i=0;$i<$results['count'];$i++) {
					$in[$i] = $results['results'][$i]['id'];
				}
                
				// Get all of the search filters
				$schools = $this->database->GetUniqueSchools($in);
				$hospitals = $this->database->GetUniqueHospitals($in);

				// Put all of the filters in one array
				$filters = array('hospitals' => $hospitals, 'schools' => $schools);

				// Define the title
				if($loc == 'all') {
					$header = ($procedure == 'everything' ? "What type of procedure or treatment do you want?" : ucwords(TranslateText($procedure, 'en', $lang)));
					$desc_loc = 'the U.S.';
					$title_loc = 'The U.S.';     
				} else {     
                    if(trim($city) == 'all')
                    {
                        $states = $this->database->loc->States();
                        $state2 = ucfirst(strtolower($states[$state]));
                        $header = ($procedure == 'everything' ? "What type of procedure or treatment do you want?" : ucwords(TranslateText($procedure, 'en', $lang)).' <a href="/doctors"> doctors </a> in ' . $state2);
                    }
                    else
                    {
					    $header = ($procedure == 'everything' ? "What type of procedure or treatment do you want?" : ucwords(TranslateText($procedure, 'en', $lang)).' <a href="/doctors"> doctors </a> in '.trim($city).', '.$state);
                    }
					$desc_loc = $city.', '.$state;
					$title_loc = $city;
				}
                            
				// Define the description
				$desc = "Find top doctors in ".$desc_loc." for ".$procedure." with our marketplace for medical tourism: VoyagerMed";
                
                if($this->uri->segment(3) !== null && $this->uri->segment(3) !== "all"){
                    $distance_filter = true;
                }else{
                    $distance_filter = false;
                }
                
				// Set all of the info that needs to be passed to the header view
				$header = array('title' => $procedure.': best doctors in '.trim($title_loc),
								'description' => $desc,
								'header' => $header,
								'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
								'langs' => $this->langs,
								'session' => $session,
								'procedure' => $procedure,
								'location' => $loc,
								'staging_ses' => $staging_ses);

				// Store all of the sort filters in an array
				$sorts = array('Top Rated', 'Price Highest', 'Price Lowest', 'Closest');	

                
                if(!in_array($procedure, $categories)) {
                    if (!empty($results["results"])) {        
                        $price = array();
                        foreach ($results["results"] as $value) {
                            $price[] = $value["price"];       
                            $distance[] = $value["distance_miles"];
                        }                        
                        $max_price = max($price);
                        $max_distance = max($distance);
                    } else {
                        $max_price = "";
                        $max_distance = "";
                    }
                    $distance_price = true;
                }else{
                    $distance_price = false;
                }
                
				// Store all of the info that will be passed to the view
				$body = array('procedure' => ucwords($procedure),
							'location' => $loc,
							'lang' => $lang,
							'count' => $results['count'],
							'city' => $city,
							'state' => $state,
							'sort' => $sort,
							'sorts' => $sorts,
							'loc_text' => $loc_text,
							'spot' => array_search($sort, $sorts),
							'filters' => $filters,
							'session' => $session,
                            'distance_filter' => $distance_filter,
                            'distance_price' => $distance_price,
							'id' => $filter_);
                
                if(!in_array($procedure, $categories)) {
                    $body["max_price"] = $max_price;
                    $body["max_distance"] = $max_distance;
                }
                if(!empty($procedure_description->procedure_description_full)) {
                    $body["procedure_description"] = $procedure_description;
                }
				// FormatArray($body);
				// die;
                                             
				// Load all of the views
				$this->load->view('templates/header', $header);   
				$this->load->view('search', $body); 
				$this->load->view('templates/footer');      
				// $this->output->enable_profiler(TRUE);
			}  

			public function Backend() {    
				// Find out if the user is logged in or not
				$user_id = $this->session->userdata('user_id');
				$session = ($user_id ? TRUE : FALSE);
				
				// Get the parameters from the URL
				$params = $this->input->get();		
				foreach($params as $key => $val) {
					$$key = $val;
				}   
				// FormatArray($params); 

				// Put all of the categories into an array
				$categories = array('Bariatric', 'Cardiology', 'Dental', 'Fertility', 'Oncology', 'Orthopedic', 'Plastic Surgery', 'Spine', 'Heart');

                
				// Set the defualt location to everywhere
				$loc = (!isset($location) ? 'all' : $location);
                
                $loc1 = strtoupper($loc);
                if($loc1 == 'ALL') $loc = 'all';
                
                $search_state = '';
                $city = '';
                $state = '';
                
				if($loc != 'all') {
					// Verify that the location exists
					$exp = explode(',', $location);
                    if (trim($exp[0]) == 'all') 
                    {
                        //city == 'all'
                        $search_state = 'state';
                        $city = trim($exp[0]);
                        $state = trim(end($exp));                        
                    }
                    
					$coords = $this->loc->MapquestLocation(trim($exp[0]), trim(end($exp)));
					$lon = $coords['lng'];
					$lat = $coords['lat'];
				} else {
					$lon = NULL;
					$lat = NULL;
				}	
                       
				// Find out if the user is searching for a broad category
				if(!in_array($procedure, $categories)) {
					// Get the doctors who specialize in the given treatment
					$id = ($procedure == 'All' ? -1 : $this->database->GetProcedureId($procedure));
					//$results = $this->database->GetDoctorsBySpecialty($id, $procedure, $lat, $lon, $type);
					//$count = $results['count'];     
                    //var_dump($search_state, $id);exit;
                    if($id) {
                        if($search_state != '')
                        {
                            $results = $this->database->GetDoctorsBySpecialtyInCityState($id, $city, $state, $type, FALSE,$from,$to);   
                        }   
                        else{                             
                            if(isset($from) || isset($distance_from)) {
                                if(isset($distance_from) && isset($distance_to)) {
                                    $results = $this->database->GetDoctorsBySpecialty($id, $lat, $lon, $type,FALSE,$from,$to,$distance_from,$distance_to);
                                }else{
                                    $results = $this->database->GetDoctorsBySpecialty($id, $lat, $lon, $type,FALSE,$from,$to);
                                }
                            }else{
                                $results = $this->database->GetDoctorsBySpecialty($id, $lat, $lon, $type);
                            }
                        }
                        $count = $results['count'];
                        
                    } else {
                        $results = NULL;
                        $count = NULL;
                    }
					$see_price = TRUE;
				} 
                else {
                    if($search_state != '')
                    {                     
                        $results = $this->database->GetDoctorsInField_CityState($procedure, $city, $state, $type, FALSE);
                    }
                    else
                    {
					    $results = $this->database->GetDoctorsInField($procedure, $lat, $lon, $type, FALSE);
                    }
					$count = $results['count'];
					$see_price = FALSE;
				}

				// Filter the schools
				if(isset($edu)) {
					if(!empty($edu) && $edu != 'undefined') {
						$results = $this->database->FilterResults($results, 'education', $edu);
						$count = $results['count'];
					} 
				}

				// Filter the hospitals
				if(isset($hosp)) {
					if(!empty($hosp) && $hosp != 'undefined') {
						$results = $this->database->FilterResults($results, 'hospital_affiliations', $hosp);
						$count = $results['count'];
					} 
				}

				// FormatArray($results);
				// Determine the ending point for the loop
				$per_page = 10;
		        $pages = ceil($count/$per_page);
		        $start = $page*$per_page;

		        if($page == ($pages-1)) {
		            $mod = $count%$per_page;
		            $end = ($mod > 0 ? $start+$mod : $start+$per_page);
		        } else {
		            $end = $start+$per_page;
		        }

		        // Define the tooltip
		        $tooltip = "This is an average cost for this procedure. Costs can vary widely and may not include anesthesia, operating room facilities or other related expenses. A surgeon's fee may vary based on his or her experience, as well as geographic office location.";

				// Define the language
				$lang = ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en');                   
				// Define all of the info that needs be passed to the view
				$body = array('procedure' => $procedure,
							'location' => $loc,
							'tooltip' => TranslateText(trim($tooltip), 'en', $lang),
							'procedures' => $results,
							'lang' => $lang,
							'page' => $page,
							'count' => $count,
							'pages' => $pages,
							'sort' => $type,
							'end' => $end,
							'see_price' => $see_price,
							'session' => $session);

				// Load the view
                //var_dump($body['procedures']);exit;
				$this->load->view('backend/search', $body);
			}

			public function SearchDoctors() {
				// Get the query string from the URL
				$q = $this->input->get('q');

				// Call this method to return the matching doctors
				$info = $this->database->SearchDoctors($q);
				
				// Load a view and pass all of the info from the query into it
				$this->load->view('backend/auto_doctor', array('info' => $info));
			}

			public function SearchHotels() {
				// Load the expedia model
				$this->load->model('expedia_model', 'expedia');

				// Get the city and the state from the URL
				$lon = $this->input->get('lon');
				$lat = $this->input->get('lat');

				// Find a maximum of 20 hotels in the given city
                                
                //$hotels = $this->expedia->getHotel_test($lon, $lat, 40);
                
				$hotels = $this->expedia->FindHotels($lon, $lat, 40);
				echo $hotels;
			}
		}
	}
