<?php 
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		class Procedures extends CI_Controller {
			public function __construct() {       
				parent:: __construct();

				// Get the base URL
				$this->base_url = $this->config->base_url();

				// Load the session library
				$this->load->library('session');

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
				
				// Load all of the models
				$this->load->model('database_model', 'database');				
			}

			public function Index() {
			    if(!$this->uri->segment(2)) 
                {
                    //there is no parameter
                    header('Location: '.$this->base_url);
                }
                else
                {
                    $procedure = urldecode($this->uri->segment(2));
                    
                    $proc_obj = $this->database->GetProcedureDataFromName($procedure);
                    
                    if(count($proc_obj) == 0) 
                    {
                        $proc_id = 0;
                        $proc_desc = "There is no the procedure";
                    }
                    else
                    {
                        $proc_id = $proc_obj[0]->id;
                        $proc_desc = $proc_obj[0]->procedure_description;
                        if($proc_desc == NULL || $proc_desc == "")
                        {
                            $proc_desc = "There is no description";
                        }
                    }
                    
                    
                    
                    // Set all of the info that needs to be passed to the header view
                    $header = array('title' => $procedure.': best doctors in '.trim($title_loc),                                
                                'lang' => ($this->session->userdata('lang') ? $this->session->userdata('lang') : 'en'),
                                'langs' => $this->langs,
                                'session' => $session,
                                'procedure' => $procedure,
                                ); 
                    
                    // Store all of the info that will be passed to the view
                    $body = array('procedure' => ucwords($procedure),
                            'lang' => $lang,
                            'proc_id' => $proc_id,
                            'proc_desc' => $proc_desc
                            );
                    
                    // Load all of the views
                    $this->load->view('templates/header', $header);   
                    $this->load->view('procedures', $body); 
                    $this->load->view('templates/footer');  
                }	
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

			public function GetProcedures() {
				// Get the query string from the URL
				$q = $this->input->get('q');

				// Get all of the relevant procedures
				$list = $this->database->GetProcedures($q);

				// Define the data that will be passed to the view
				$data = array('results' => $list, 
							'count' => count($list),
							'length' => strlen($q),
							'q' => $q);

				// Load the autocomplete view
				$this->load->view('backend/autocomplete', $data); 
			}
            
            public function GetDoctors() {
              
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
            }
	    }
}