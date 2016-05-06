<?php 
	class Database_model extends CI_Model {
		public function __construct() {       
			parent:: __construct();

			// Load the database
			$this->load->database();

			// Load the helpers file
			$this->load->helper('common_helper');
			$this->load->helper('translate_helper');

			// Load all of the models
			$this->load->model('locations_model', 'loc');
		}

		/**
		 * Query the DB for doctors whose last name starts with a given letter
		 * @param {str} [letter] A letter in the alphabet
		 * @return An array containing relevant doctors and the number of doctors
		 */
		public function GetDoctorsByLastName($letter) {
			$this->db->select('name, title, address, city, state, zip_code');
			$this->db->like('last_name', $letter, 'after');
			$this->db->order_by('last_name', 'ASC');
			$query = $this->db->get('doctors');
			$count = $query->num_rows();
			$data = [];	
			$i = 0;

			foreach($query->result() as $row) {
				$data[$i] = array('name' => $row->name,
								'title' => $row->title,
								'address' => $row->address,
								'city' => $row->city,
								'state' => $row->state,
								'zip' => $row->zip_code);

				$i++;
			}

			return array('count' => $count, 'data' => $data);
		}
        
        public function GetDoctorsByName($first_name, $last_name) {
            $this->db->select('name, title, address, city, state, zip_code');
            if( ($first_name != '') && ($first_name != NULL) )
            {
                $this->db->like('first_name', $first_name, 'after');
            }
            if( ($last_name != '') && ($last_name != NULL) )
            {
                $this->db->like('last_name', $last_name, 'after');
            }            
            $this->db->order_by('last_name', 'ASC');
            $query = $this->db->get('doctors');
            $count = $query->num_rows();
            $data = [];    
            $i = 0;

            foreach($query->result() as $row) {
                $data[$i] = array('name' => $row->name,
                                'title' => $row->title,
                                'address' => $row->address,
                                'city' => $row->city,
                                'state' => $row->state,
                                'zip' => $row->zip_code);

                $i++;
            }

            return array('count' => $count, 'data' => $data);
        }

		/**
		 * Insert a comment into the DB
		 * @param {str} [keyword] The keyword the user commented on
		 * @param {str} [comment] The comment submitted by the user
		 * @return {boolean}
		 */
		public function InsertComment($keyword, $comment) {
			if(!empty($comment)) {
				$this->db->select('id');
				$this->db->where('comment', $comment);
				$query = $this->db->get('comments');

				if($query->num_rows() == 0) {
					$data = array('keyword' => $keyword, 'comment' => $comment, 'date' => time());
					$this->db->insert('comments', $data);
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}

		/**
		 * Get comments on a specific keyword
		 * @param {str} [keyword] The specified keyword to query comments for
		 * @return {array} An array containing each comment and the date it was posted
		 */
		public function GetComments($keyword) {
			$this->db->select('comment, date');
			$this->db->where('keyword', $keyword);
			$this->db->order_by('date', 'ASC');
			$query = $this->db->get('comments');
			$data = array('count' => $query->num_rows(), 'data' => array());
			$i = 0;

			foreach($query->result() as $row) {
				$data['data'][$i] = array('comment' => $row->comment, 'date' => $row->date);

				$i++;
			}

			return $data;
		}

		/**
		 * Query the DB to get info about a given tag
		 * @param {str} [name] The name of the tag
		 * @return {array} An array containing info about the given tag
		 */
		public function GetTagName($name) {
			$this->db->select('term');
			$this->db->where('term', $name);
			$query = $this->db->get('keywords');
			
			if($query->num_rows() == 1) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		/**
		 * Query the DB to get all of the community pages
		 * @return {array} An array containing the number of rows and the results
		 */
		public function CommunityPages() {
			$this->db->select('term');
			$query = $this->db->get('keywords');
			$count = $query->num_rows();
			$return = [];
			$i = 0;

			foreach($query->result() as $row) {
				$return[$i] = array('link' => $row->term);
				
				$i++;
			}

			return array('count' => $count, 'results' => $return);
		}

		public function CleanDoctors() {
			$this->db->select('*');
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('doctors_clean');
			$count = $query->num_rows();
			$i = 0;

			foreach($query->result() as $row) {
				$id[$i] = $row->id;
				$city[$i] = $row->city;
				$state[$i] = $row->state;

				$i++;
			}

			$states = $this->loc->FullStates();

			for($i=0;$i<$count;$i++) {
				if(in_array(strtoupper($state[$i]), $states)) {
					$full = ucwords(strtolower($this->loc->FullFromAbbrev($state[$i])));
					
					if(!empty($full)) {
						// echo 'Row: '.$id[$i].' '.$state[$i].' ';
						// echo 'Full: '.$full.'<br>';

						// Update the row
						// $this->db->where('id', $id[$i]);
						// $this->db->update('doctors_clean', array('state' => $full));
					} else {
						// echo 'Row: '.$id[$i].' '.$state[$i].' <br>';

						// $this->db->where('id', $id[$i]);
						// $this->db->delete('doctors_clean');	
					}
				} else {
					echo 'Row: '.$id[$i].' '.$state[$i].' <br> '; 
					
					$this->db->where('id', $id[$i]);
					$this->db->delete('doctors_clean');	
				}
			}
		}

		/**
		 * Query the DB for all of the doctors who appear on the sitemap
		 * @return {array} An array containing its count and the results with each doctor's name and priority
		 */
		public function SeoDoctors() {
			$this->db->select('first_name, last_name, field');
			$query = $this->db->get('doctors');
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				if($row->field == 'Plastic Surgery') {
					$priority = 0.9;
				} else {
					$priority = 0.8;
				}

				$return[$i] = array('link' => $row->first_name.'-'.$row->last_name,
									'priority' => $priority);
				
				$i++;
			}

			return array('count' => $count, 'results' => $return);
		}

		/**
		 * Return all of the links to the searches that will be used for the sitemap
		 * @return {array} An array containing links to each search result page
		 */
		public function SeoSearches() {
			ini_set('memory_limit', '-1');
			$data = [];

			// Get all of the procedures
			$this->db->select('name');
			$this->db->group_by('name');
			$query = $this->db->get('procedures');
			$i = 0;

			foreach($query->result() as $row) {
				$procedures[$i] = $row->name;

				$i++;
			}

			$places = array('New-York-NY', 
							'Los-Angeles-CA', 
							'Chicago-IL', 
							'Houston-TX', 
							'Philadelphia-PA',
							'Phoenix-AZ', 
							'San-Diego-CA', 
							'San-Antonio-TX', 
							'Dallas-TX', 
							'Detroit-MI', 
							'San-Jose-CA', 
							'Indianapolis-IN', 
							'Jacksonville-FL', 
							'San-Francisco-CA', 
							'Columbus-OH', 
							'Austin-TX',
							'Memphis-TN', 
							'Baltimore-MD', 
							'Charlotte-NC', 
							'Boston-MA',
							'Milwaukee-WI', 
							'El-Paso-TX', 
							'Nashville-TN',  
							'Seattle-WA', 
							'Denver-CO', 
							'Las-Vegas-NV', 
							'Portland-OR', 
							'Oklahoma-City-OK', 
							'Tucson-AZ',
							'Albuquerque-NM', 
							'Atlanta-GA', 
							'Long-Beach-CA', 
							'Kansas-City-MO',  
							'Fresno-CA',
							'New-Orleans-LA', 
							'Cleveland-OH', 
							'Sacramento-CA', 
							'Mesa-AZ', 
							'Virginia-Beach-VA', 
							'Omaha-NE', 
							'Colorado-Springs-CO', 
							'Oakland-CA', 
							'Miami-FL', 
							'Tulsa-OK',
							'Minneapolis-MN', 
							'Honolulu-HI',
							'Arlington-TX', 
							'Wichita-KS');

			foreach($places as $place) {
				foreach($procedures as $procedure) {
					$pro = str_replace(' ', '-', $procedure);
					$treat = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $pro);
					$url = 'https://voyagermed.com/search/'.$treat.'/'.$place.'/price-lowest';
					array_push($data, $url);
				}
			}

			return $data;
		}

		/**
		 * Sign up a new user and insert their info into the users table
		 * @param {string} [email] The email that the user provided
		 * @param {string} [pass] The password
		 * @param {string} [confirm] The password confirmation
		 * @return {string} A string that will determine if the query was successful
		 */
		public function SignUp($email, $pass, $confirm) {
			if($pass == $confirm) {
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->db->select('*');
					$this->db->where(array('email' => $email));
					$query = $this->db->get('users');

					if($query->num_rows() == 1) {
						return 'already';
					} else {
						$data = array('email' => $email, 'password' => sha1($pass));
						$this->db->insert('users', $data);
						return 'success';
					}
				} else {
					return 'invalid email';
				}
			} else {
				return 'no match';
			}
		}

		/**
		 * Log a user in
		 * @param {string} [email] The user's email
		 * @param {string} [pass]  The user's password
		 * @return {arr|boolean} Either FALSE or an array
		 */
		public function Login($email, $pass) {
			$this->db->select('*');
			$this->db->where(array('email' => $email, 'password' => sha1($pass)));
			$query = $this->db->get('users');
			
			if($query->num_rows() == 1) {
				$row = $query->result();
				return array('id' => $row[0]->id,
							'email' => $row[0]->email,
							'admin' => $row[0]->admin);
			} else {
				return FALSE;
			}

		}

		/**
		 * Query the DB for all of the clinics in the DB
		 * @return {array} An array containing info about each clinic
		 */
		public function GetAllClinics() {
			$this->db->select('*');
			$query = $this->db->get('clinics');
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('id' => $row->id,	
									'name' => $row->name,
									'address' => $row->address,
									'city' => $row->city,
									'state' => $row->state,
									'national_rank' => $row->national_rank,
									'full_rank' => $row->full_rank,
									'score' => $row->score,
									'visitor_rank' => $row->intl_visitor_rank);
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get the national averge price for a given procedure
		 * @param {int} [id] The procedure ID
		 * @return {int|boolean} Either an array or FALSE
		 */
		public function GetProcedureAvg($id) {
			$this->db->select('national_avg');
            $this->db->where('id', $id);
            $query = $this->db->get('procedures');
            $count = $query->num_rows();

            if($count == 1) {
                $row = $query->result();
				return $row[0]->national_avg;
			} else {
				return FALSE;
			}
		}

		/**
		 * Query the DB to get info about a given clinic
		 * @param {int} [id] The clinic ID
		 * @return {array|boolean} Either an array containing info about the given clinic or FALSE
		 */
		public function GetClinicInfo($id) {
			$this->db->select('*');
			$this->db->where('id', $id);
			$this->db->or_where('name', $id);
			$query = $this->db->get('clinics');
			$count = $query->num_rows();

			if($count == 1) {
				foreach($query->result() as $row) {
					return array('name' => $row->name,
								'address' => $row->address,
								'city' => $row->city,
								'state' => $row->state,
								'zip' => $row->zip,
								'intl_rank' => $row->intl_visitor_rank,
								'natl_rank' => $row->national_rank,
								'full_rank' => $row->full_rank,
								'score' => $row->score,
								'stars' => $row->stars);
				}
			} else {
				return FALSE;
			}
		}

		/**
		 * Query the DB to get all of the doctors in the DB
		 * @param {int} [limit] The query limit
		 * @return {array} An array containing info about all of the doctors in the DB
		 */
		public function GetDoctors($limit = NULL) {
			$this->db->select('*');

			if($limit) {
				$this->db->limit($limit);
			}

			$this->db->where('field', 'Plastic Surgery');
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('doctors');
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$img = 'public/images/doctors/'.strtolower(trim($row->first_name)).'_'.strtolower(trim($row->last_name)).'.jpg';

				if(!is_file($img)) {
					$img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.JPG';

					if(!is_file($img)) {
						$img = 'public/images/default.svg';
					}
				}

				$return[$i] = array('id' => $row->id,
									'field' => $row->field,
									'first' => $row->first_name,
									'last' => $row->last_name,
									'name' => $row->name,
									'img' => $img,
									'website' => $row->website,
									'title' => $row->title,
									'address' => $row->address,
									'city' => $row->city,
									'state' => $row->state,
									'abbrev' => '',
									'phone' => $row->phone,
									'lon' => $row->lon,
									'lat' => $row->lat,
									'angle' => $row->angle,
									'disc' => $row->discoverable);
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get all of the target doctors
		 * @return {array} An array containing all of the information for each target doctor
		 */
		public function GetTagetDoctors() {
			$this->db->select('*');
			$this->dbb->where('id <', 500);
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('doctors');
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$img = 'public/images/doctors/'.strtolower($row->first_name).'_'.strtolower($row->last_name).'.jpg';

				if(!is_file($img)) {
					$img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.JPG';

					if(!is_file($img)) {
						$img = 'public/images/default.svg';
					}
				}

				$return[$i] = array('id' => $row->id,
									'field' => $row->field,
									'first' => $row->first_name,
									'last' => $row->last_name,
									'name' => $row->name,
									'img' => $img,
									'website' => $row->website,
									'title' => $row->title,
									'address' => $row->address,
									'city' => $row->city,
									'state' => $row->state,
									'abbrev' => '',
									'phone' => $row->phone,
									'lon' => $row->lon,
									'lat' => $row->lat,
									'angle' => $row->angle,
									'disc' => $row->discoverable);
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get all of the specialties
		 * @return {array} An array containing the number of rows and the results
		 */
		public function GetAllSpecialties() {
			$this->db->select('*');
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get('procedures');
			$count = $query->num_rows();
			$i = 0;
			$data = [];

			foreach($query->result() as $row) {
				$data[$i] = array('id' => $row->id, 'name' => $row->name);

				$i++;
			}

			return array('count' => $count, 'data' => $data);
		}

		/**
		 * Query the DB to get unique certifications
		 * @param {array} [$in] An array of doctors
		 * @return {array} An array containing info about each of the certifications
		 */
		public function GetUniqueCerts($in = NULL) {
			$this->db->select('certification, img, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('certification');
			$query = $this->db->get('certifications');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->certification, 'img' => $row->img, 'count' => $row->count);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get unique schools
		 * @param {array} [in] An array of doctors
		 * @return {array} An array containing info about each of the schools
		 */
		public function GetUniqueSchools($in = NULL) {
			$this->db->select('school, img, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('school');
			$query = $this->db->get('education');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->school, 'img' => $row->img, 'count' => $row->count);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get unique hospitals
		 * @param {array} [in] An array of doctors
		 * @return {array} An array containing info about each of the hospitals
		 */
		public function GetUniqueHospitals($in = NULL) {
			$this->db->select('hospital, img, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('hospital');
			$query = $this->db->get('hospital_affiliations');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->hospital, 'img' => $row->img, 'count' => $row->count);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get unique interests
		 * @param {array} [in] An array of doctors
		 * @return {array} An array containing info about each of the interests
		 */
		public function GetUniqueInterests($in = NULL) {
			$this->db->select('interest, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('interest');
			$query = $this->db->get('interests');
			$i = 0;
			$int = [];

			foreach($query->result() as $row) {
				$int[$i] = array('name' => $row->interest, 'count' => $row->count);

				$i++;
			}

			return $int;
		}

		/**
		 * Query the DB to get unique memberships
		 * @param {array} [in] An array of doctors
		 * @return {array} An array containing info about each of the memberships
		 */
		public function GetUniqueClubs($in = NULL) {
			$this->db->select('club, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('club');
			$this->db->distinct();
			$query = $this->db->get('memberships');
			$i = 0;
			$club = [];

			foreach($query->result() as $row) {
				$club[$i] = array('name' => $row->club, 'count' => $row->count);

				$i++;
			}

			return $club;
		}

		/**
		 * Query the DB to get unique insurances
		 * @param {array} [in] An array of doctors
		 * @return {array} An array containing info about each of the insurances
		 */
		public function GetUniqueInsurance($in = NULL) {
			$this->db->select('insurance, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('insurance');
			$this->db->distinct();
			$query = $this->db->get('insurance');
			$i = 0;
			$ins = [];

			foreach($query->result() as $row) {
				$ins[$i] = array('name' => $row->insurance, 'count' => $row->count);

				$i++;
			}

			return $ins;
		}

		/**
		 * Query the DB to get unique awards
		 * @param {array} [in] An array of doctors
		 * @return {array} An array containing info about each of the awards
		 */
		public function GetUniqueAwards($in = NULL) {
			$this->db->select('name, COUNT(*) AS count');

			if(!empty($in)) {
				$this->db->where_in('doctor_id', $in);
			}

			$this->db->order_by('count', 'DESC');
			$this->db->group_by('name');
			$this->db->distinct();
			$query = $this->db->get('awards');
			$i = 0;
			$award = [];

			foreach($query->result() as $row) {
				$award[$i] = array('name' => $row->name);

				$i++;
			}

			return $award;
		}

		/**
		 * Query the DB to get info about the given doctor
		 * @param {int} [id] The doctor's ID
		 * @return {array|boolean} An array containing info about the doctor or FALSE
		 */
		public function GetDoctorInfo($id, $target = 0) {
			$sql = "SELECT * 
					FROM doctors
					WHERE name = ?
					OR id = ?
					ORDER BY id ASC";
			$query = $this->db->query($sql, array($id, $id));
			$count = $query->num_rows(); 

			if($count > 0) {
				$i = 0;

				foreach($query->result() as $row) {
					// Set the default angle to 90
					$angle = ($row->angle == '' || $row->angle == 'NULL' ? 90 : $row->angle);

					// Get the doctor's bio
					$info = array('name' => $row->first_name.' '.$row->last_name,
								'city' => $row->city, 'state' => $row->state);
					
					if(empty($row->bio)) {
						$bio = GenerateBio($row->field, $info);
					} else {
						$bio = $row->bio;
					}

					// Define the img
					if($target == 0) {
						$img = strtolower('public/images/doctors/'.trim($row->first_name).'-'.trim($row->last_name));
					} else {
						$img = strtolower('public/images/doctors/'.trim($row->first_name).'-'.trim($row->last_name)).$target;
					}
					
					if(!is_file($img.'.jpg')) {
						$img = $img.'.JPG';

						if(!is_file($img)) {
							$img = 'public/images/default.svg';
						}
					} else {
						$img = $img.'.jpg';
					}

					$data[$i] = array('id' => $row->id,
									'first' => $row->first_name,
									'last' => $row->last_name,
									'name' => $row->name,
									'img' => $img,
									'website' => $row->website,
									'field' => $row->field,
									'title' => $row->title,
									'address' => $row->address,
									'city' => $row->city,
									'state' => $row->state,
									'abbrev' => NULL,
									// 'abbrev' => $this->loc->ConvertState($row->state),
									'zip' => $row->zip_code,
									'phone' => $row->phone,
									'lon' => $row->lon,
									'lat' => $row->lat,
									'angle' => $angle,
									'tilt' => $row->tilt,
									'map_lon' => $row->map_lon,
									'map_lat' => $row->map_lat,
									'bio' => $bio,
									'disc' => $row->discoverable,
									'masonry' => $row->masonry,
                                    'is_street_image' => $row->is_street_image,
                                    'is_full_profile' => $row->is_full_profile,
                                    'is_bme' => $row->is_bme,
                                    );

					$i++;
				}

				return $data[$target];
			} else {
				return FALSE;
			}
		}

		/**
		 * Query the DB to get all of a given doctor's masonry pics
		 * @param {int} [id]  The doctor ID of the given doctor
		 * @return {array} An array containing the number of rows returned and all of the data
		 */
		public function GetMasonryPics($id) {
			$this->db->select('*');
			$this->db->where('doctor_id', $id);
			$this->db->order_by('order', 'ASC');
			$query = $this->db->get('masonry');
			$count = $query->num_rows(); 
			$i = 0;
			$data = array('count' => $count, 'results' => '');

			foreach($query->result() as $row) {
				$data['results'][$i] = array('img' => $row->img, 'title' => $row->title, 'description' => $row->description);

				$i++;
			}

			return $data;
		}

		/**
		 * Insert some masonry pics into the DB
		 * @param {int} [id]  The doctor's ID
		 * @param {string} [first] The doctor's first name
		 * @param {string} [last] The doctor's last name
		 */
		public function InsertMasonryPics($id, $first, $last) {
			$scan = scandir('public/images/doctors/masonry/'.strtolower($first).'_'.strtolower($last));
			$scan = array_slice($scan, 2);

			for($i=0;$i<count($scan);$i++) {
				if($scan[$i] != '.DS_Store') {
					$this->db->select('*');
					$this->db->where(array('doctor_id' => $id, 'img' => $scan[$i]));
					$query = $this->db->get('masonry');
					
					if($query->num_rows() == 0) {
						$data = array('doctor_id' => $id, 'img' => $scan[$i]);
						$this->db->insert('masonry', $data);
					}
				}
			}
		}

		/**
		 * Query the DB to get reviews of a given doctor
		 * @param {int} [doctor_id] The doctor ID
		 * @return {array} An array containing all of the reviews of a given doctor
		 */
		public function GetDoctorReviews($doctor_id) {
			$sql = "SELECT * FROM ratings
					WHERE ratings.doctor_id = ?";
			$query = $this->db->query($sql, array($doctor_id));
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('left_by' => $row->left_by,
									'review' => $row->review,
									'type' => $row->type,
									'stars' => $row->stars,
									'datetime' => $row->datetime);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB for doctors whose names match the query string
		 * @param {string} [q] The query string
		 * @return {array} An array containing the number of rows returned and the data for each doctor
		 */
		public function SearchDoctors($q) {
			$exp = explode(' ', $q);
			$this->db->select('first_name, last_name');
			$this->db->like('first_name', $exp[0]);

			if(count($exp) > 1) {
				$this->db->like('last_name', end($exp));
				// $this->db->like('first_name', end($exp));
			} else {
				$this->db->or_like('last_name', $exp[0]);
			}

			$this->db->order_by('id', 'ASC');
			$this->db->group_by('first_name, last_name');
			$this->db->limit(5);
			$query = $this->db->get('doctors');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('first_name' => $row->first_name, 
									'last_name' => $row->last_name);
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get all of the doctor's certifications
		 * @param {int} [doctor_id] The doctor's ID
		 * @return {array} An array of all of the given doctor's certifications
		 */
		public function GetDoctorCerts($doctor_id) {
			$this->db->select('id,certification');
			$this->db->where('doctor_id', $doctor_id);
			$query = $this->db->get('certifications');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('id' => $row->id, 'name' => $row->certification);
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get all of the schools linked to a given doctor
		 * @param {int} [doctor_id] The doctor's ID
		 * @return {array} An array containing info about each schoole
		 */
		public function GetDoctorSchools($doctor_id) {
			$this->db->select('*');
			$this->db->where('doctor_id', $doctor_id);
			$query = $this->db->get('education');
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('id' => $row->id, 'name' => $row->school);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get unique hospitals
		 * @param {int} [id] A doctor ID
		 * @return {array} An array containing info about each of the hospitals
		 */
		public function GetDoctorHospitals($id) {
			$this->db->select('id, hospital, img');
			$this->db->where('doctor_id', $id);
			$query = $this->db->get('hospital_affiliations');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('id' => $row->id, 'name' => $row->hospital, 'img' => $row->img);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to get the set of insurances accepted by a given doctor
		 * @param {int} [id] The doctor ID
		 * @return {array} An array containing info about each of the insurances
		 */
		public function GetDoctorInsurance($id) {
			$this->db->select('id,insurance');
			$this->db->where('doctor_id', $id);
			$query = $this->db->get('insurance');
			$i = 0;
			$ins = [];

			foreach($query->result() as $row) {
				$ins[$i] = array('id' => $row->id, 'name' => $row->insurance);

				$i++;
			}

			return $ins;
		}

		/**
		 * Query the DB for a given doctor's awards
		 * @param {int} [id] The doctor's ID
		 * @return {array} An array containing all of the awards tied to the given doctor
		 */
		public function GetDoctorAwards($id) {
			$this->db->distinct();
			$this->db->select('award,name,year');
			$this->db->where('doctor_id', $id);
			$query = $this->db->get('awards');
			$i = 0;
			$awards = [];

			foreach($query->result() as $row) {
				$awards[$i] = array('award' => $row->award, 'name' => $row->name, 'year' => $row->year);

				$i++;
			}

			return $awards;
		}

		/**
		 * Get the doctor's interests from the DB
		 * @param {string} [id] The doctor's ID
		 * @return {array} An array containing all of the interests tied to the given doctor
		 */
		public function GetDoctorInterests($id) {
			$this->db->select('id,interest');
			$this->db->where('doctor_id', $id);
			$query = $this->db->get('interests');
			$i = 0;
			$int = [];

			foreach($query->result() as $row) {
				$int[$i] = array('id' => $row->id, 'name' => $row->interest);

				$i++;
			}

			return $int;
		}

		/**
		 * Query the DB for
		 * @param [type] $id [description]
		 */
		public function GetDoctorClubs($id) {
			$this->db->distinct();
			$this->db->select('club');
			$this->db->where('doctor_id', $id);
			$query = $this->db->get('memberships');
			$i = 0;
			$club = [];

			foreach($query->result() as $row) {
				$club[$i] = array('name' => $row->club);

				$i++;
			}

			return $club;
		}

		/**
		 * Get a given doctor's awards, memberships and interests
		 * @param {int} [id] The doctor ID
		 * @return {array} An array containing all of the given doctor's award, interests and memberships
		 */
		public function GetDoctorAMI($id) {
			$awards = $this->GetDoctorAwards($id);
			$interests = $this->GetDoctorInterests($id);
			$club = $this->GetDoctorClubs($id);
			return array('awards' => $awards, 'interests' => $interests, 'clubs' => $club);
		}

		/**
		 * Update the row in the DB belonging to the doctor with the specified ID
		 * @param {int} [id] The doctor's ID
		 * @param {array} [data] An array containing the values and column names that need to be updated
		 */
		public function UpdateDoctorProfile($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('doctors', $data['doc']);	
			
			// Insert the schools
			for($i=0;$i<count($data['education']);$i++) {
				if(!empty($data['education'][$i])) {
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'school' => $data['education'][$i]));
					$query = $this->db->get('education');
					$num = $query->num_rows();

					if($num == 0) {
						$info = array('doctor_id' => $id, 'school' => $data['education'][$i]);
						$this->db->insert('education', $info);
					}
				}
			}

			// Insert the certifications
			for($i=0;$i<count($data['affiliations']);$i++) {
				if(!empty($data['affiliations'][$i])) {
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'certification' => $data['affiliations'][$i]));
					$query = $this->db->get('certifications');
					$num = $query->num_rows();

					if($num == 0) {
						$info = array('doctor_id' => $id, 'certification' => $data['affiliations'][$i]);
						$this->db->insert('certifications', $info);
					}
				}
			}

			// Insert the awards
			for($i=0;$i<count($data['awards']);$i++) {
				if(!empty($data['awards'][$i])) {
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'award' => $data['awards'][$i]));
					$query = $this->db->get('awards');
					$num = $query->num_rows();

					if($num == 0) {
						$info = array('doctor_id' => $id, 'award' => $data['awards'][$i]);
						$this->db->insert('awards', $info);
					}
				}
			}

			// Insert the hospitals
			for($i=0;$i<count($data['hospitals']);$i++) {
				if(!empty($data['hospitals'][$i])) {
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'hospital' => $data['hospitals'][$i]));
					$query = $this->db->get('hospital_affiliations');
					$num = $query->num_rows();

					if($num == 0) {
						$info = array('doctor_id' => $id, 'hospital' => $data['hospitals'][$i]);
						$this->db->insert('hospital_affiliations', $info);
					}
				}
			}

			// Insert the memberships
			for($i=0;$i<count($data['memberships']);$i++) {
				if(!empty($data['memberships'][$i])) {
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'club' => $data['memberships'][$i]));
					$query = $this->db->get('memberships');
					$num = $query->num_rows();

					if($num == 0) {
						$info = array('doctor_id' => $id, 'club' => $data['memberships'][$i]);
						$this->db->insert('memberships', $info);
					}
				}
			}

			// Insert the interests
			for($i=0;$i<count($data['interests']);$i++) {
				if(!empty($data['interests'][$i])) {
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'interest' => $data['interests'][$i]));
					$query = $this->db->get('interests');
					$num = $query->num_rows();

					if($num == 0) {
						$info = array('doctor_id' => $id, 'interest' => $data['interests'][$i]);
						$this->db->insert('interests', $info);
					}
				}
			}

			// Insert the specialties
			for($i=0;$i<count($data['specialties']);$i++) {
				if(!empty($data['specialties'][$i])) {
					$specialty = trim($data['specialties'][$i]);
					
					// See if the specialty has already been assigned to this doctor
					$this->db->select('id');
					$this->db->where(array('doctor_id' => $id, 'real_id' => $specialty));
					$query = $this->db->get('new_specialties');
					$num = $query->num_rows();

					if($num == 0) {
						// See if the procedure exists in the procedures table
						$this->db->select('name');
						$this->db->where('id', $specialty);
						$query = $this->db->get('procedures');
						$count = $query->num_rows();

						// Get the procedure ID
						if($count == 1) {
							$row = $query->result();
							$new_name = $row[0]->name;
						} else {
							// Insert the procedure into the DB
							$this->db->insert('procedures', array('name' => $specialty));

							// Get the new ID
							$this->db->select('id');
							$this->db->where('name', $specialty);
							$query = $this->db->get('procedures');
							$count = $query->num_rows();
							$row = $query->result();
							$new_id = $row[0]->id;
						}

						sort($data['prices']);
						$info = array('doctor_id' => $id, 
									'name' => $new_name,
									'name_id' => $specialty,
									'price' => $data['prices'][$i],
									'procedure_name' => $new_name,
									'real_id' => $specialty,
									'is_match' => 2);
						$this->db->insert('new_specialties', $info);
					} else {
						sort($data['prices']);
						$this->db->where(array('real_id' => $specialty, 'doctor_id' => $id));
						$this->db->update('new_specialties', array('price' => $data['prices'][$i]));
					}
				}
			}
		}

		/**
		 * Find doctors that are located within 50 miles of a given doctor
		 * @param {int} [doctor_id] The ID of the doctor
		 * @return {array} An array containing info about each doctor located within a 50 miles radius of the one given
		 */
		public function GetSimilarDoctors($doctor_id) {
			$doc = $this->GetDoctorInfo($doctor_id);
			$lon = $doc['lon'];
			$lat = $doc['lat'];

			// Get all of the other doctors
			$info = $this->GetDoctors();
			$return = [];

			for($i=0;$i<count($info);$i++) {            
				if($doc['field'] == $info[$i]['field'] && $info[$i]['disc'] == 1) {
					if($info[$i]['id'] != $doctor_id && $info[$i]['disc'] == 1) {
						$dist = $this->loc->Haversine($lat, $lon, $info[$i]['lat'], $info[$i]['lon']);

						if($dist < 500) {
							array_push($return, $info[$i]);
						}
					}
				}
			}

			return $return;
		}

		/**
		 * Get the ID of a given procedure by its name
		 * @param {string} [name] The name of the given procedure
		 * @return {int|boolean} The procedure ID or NULL
		 */
		public function GetProcedureId($name) {
			$this->db->select('id');
			$this->db->where('name', $name);
			$query = $this->db->get('procedures');
			
			if($query->num_rows() == 1) {
				$row = $query->result();
				return $row[0]->id;
			} else {
				return NULL;
			}
		}

		/**
		 * Query the DB for the procedures matching the given query string
		 * @param {string} [q] The query string
		 * @return {array} An array containing info about each procedure
		 */
		public function GetProcedures($q) {
			$this->db->distinct();
			$this->db->select('*');
			$this->db->like('name', $q, 'after');
			$this->db->order_by('name', 'ASC');
			$this->db->limit(5);
			$query = $this->db->get('procedures');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('id' => $row->id, 'name' => $row->name);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB for all of the specialties that belong to one particular doctor
		 * @param {int} [doctor_id] The ID of the doctor
		 * @param {string} [unit] The currency unit
		 * @return {array} An array containing info about each specialty
		 */
		public function GetDoctorSpecialties($doctor_id, $unit = NULL) {
			$sql = "SELECT procedures.*, new_specialties.price
					FROM procedures
					INNER JOIN new_specialties
					ON procedures.id = new_specialties.real_id
					WHERE new_specialties.doctor_id = ?
					ORDER BY procedures.name ASC";
			$query = $this->db->query($sql, array($doctor_id));
			$count = $query->num_rows();
			$i = 0;

			foreach($query->result() as $row) {
				$id[$i] = $row->id;
				$name[$i] = $row->name;
				$price[$i] = $row->price;
				$avg[$i] = $row->national_avg;
				
				$i++;
			}

			$names = [];
			$return = [];

			for($i=0;$i<$count;$i++) {
				if(!in_array($name[$i], $names)) {
					if($unit != NULL && is_numeric($price[$i])) {
						$this->db->select('rate');
						$this->db->where('currency', strtoupper($unit));
						$query = $this->db->get('currencies');
						$row = $query->result();
						$rate = $row[0]->rate;
						$new_price = $price[$i]*$rate;
						$new_avg = $avg[$i]*$rate;
					} else {
						$new_price = $price[$i];
						$new_avg = $avg[$i];
					}

					$new = array('id' => $id[$i],
								'name' => $name[$i],
								'price' => $new_price,
								'avg' => $new_avg);
					array_push($return, $new);
					array_push($names, $name[$i]);
				} 
			}

			return array('count' => count($return), 'results' => $return);
		}

		/**
		 * 
		 * @param [type] $doctor_id [description]
		 */
		public function SpecialtiesOfDoctor($doctor_id) {
			$sql = "SELECT procedures.*
					FROM procedures
					JOIN specialties
					ON procedures.id = specialties.procedure_id
					WHERE specialties.doctor_id = ?";
			$query = $this->db->query($sql, array($doctor_id));
			$i = 0;

			foreach($query->result() as $row) {
				$name[$i] = $row->name;
				
				$i++;
			}

			$unique = array_unique($name);
			return array_splice($unique, 0, 3);
		}

		/**
		 * Query the DB to get all of the doctors who specialize in a given procedure in a given area
		 * @param {int} [id] The procedure ID
		 * @param {str} [name] The name of the procedure
		 * @param {decimal} [lat] The latitude coordinate 
		 * @param {decimal} [lon] The lontitude coordinate
		 * @param {string} [location] The location name
		 * @param {string} [sort] The sort filter
		 * @return {array} An array containing info about each doctor who fits the criteria
		 */  
		public function GetDoctorsBySpecialty($id, $lat, $lon, $sort, $just = FALSE,$from_price = NULL, $to_price = NULL,$distance_from = NULL,$distance_to = NULL) {
            //var_dump($lat, $lon);exit;
            $sql = "SELECT doctors.*, new_specialties.price";

            if(!empty($lat) && !empty($lon)) {
                $sql .= ", (3959 * acos(cos(radians(".$lat.")) * cos(radians(doctors.lat)) * cos(radians(doctors.lon) - radians(".$lon.")) + sin(radians(".$lat.")) * sin(radians(doctors.lat)))) AS distance";
            }

            $sql .= " FROM doctors
                    JOIN new_specialties
                    ON doctors.id = new_specialties.doctor_id
                    WHERE doctors.discoverable = '1'";

            if(is_numeric($id) && ($id!='-1')) { 
                $sql .= " AND new_specialties.real_id = '".$id."'";
            }

            $sql .= " GROUP BY doctors.id";

            if(!empty($lat) && !empty($lon)) {
                $sql .= " HAVING distance < 100";
            }
                                                
            $query = $this->db->query($sql);
            $count = $query->num_rows();
            $i = 0;
            $data = [];     
            
            foreach($query->result() as $row) {  
                if(!$just) {
                    $bio = ($row->bio == '' ? $row->name." doesn't have a bio." : $row->bio);

                    // Get the avg price of the procedure
                    $avg = $this->GetProcedureAvg($id);
                    $price_val = (empty($row->price) ? $avg : $row->price);
                    $price_avg = (empty($row->price) ? TRUE : FALSE);

                    // Define the image
                    $img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.jpg';

                    if(!is_file($img)) {
                        $img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.JPG';

                        if(!is_file($img)) {
                            $img = 'public/images/default.svg';
                        }
                    }
                    if(!empty($this->uri->segment(3)) && $this->uri->segment(3) !== "all" || !empty($this->input->get("location")) && $this->input->get("location") !== "all"){
                        if(!empty($this->input->get("location"))){
                            $locations_url = $this->input->get("location");
                        }else{
                            $locations_url = str_replace("-"," ",$this->uri->segment(3));
                        }
                        $get_lat_long = getLatLong($locations_url);
                        $get_lat_long = explode(",",$get_lat_long);
                        if(!empty($get_lat_long[0])){
                            $distance = getDistance($row->lat,$row->lon,$get_lat_long[0],$get_lat_long[1],"M");
                        }else{
                            $distance = 0;
                        }
                    }else{
                        $distance = 0;
                    }

                    $data[$i] = array('id' => $row->id,
                                    'first' => $row->first_name,
                                    'last' => $row->last_name,
                                    'name' => $row->name,
                                    'pic' => $img,
                                    'website' => $row->website,
                                    'title' => $row->title,
                                    'address' => $row->address,
                                    'city' => $row->city,
                                    'state' => $row->state,
                                    'abbrev' => '',
                                    'phone' => $row->phone,
                                    'is_bme' => $row->is_bme,
                                    'lon' => $row->lon,
                                    'lat' => $row->lat,
                                    'rating' => $row->rating,
                                    'bio' => $bio,
                                    'price' => $price_val,
                                    'is_avg' => $price_avg,
                                    'distance_miles' => $distance,
                                    'distance' => (!empty($lat) && !empty($lon) ? $row->distance : NULL));
                } else {
                    $data[$i] = array('id' => $row->id);
                }
                $i++;
            }
 
            if($count > 0 && !$just) {
                if($sort) {
                    switch($sort) {
                        case'Top Rated';

                            $function = 'SortRating';
                            break;

                        case'Price Highest';

                            $function = 'SortPriceHigh';
                            break;

                        case'Price Lowest';

                            $function = 'SortPriceLow';
                            break;

                        case'Closest';

                            $function = 'SortDistance';
                            break;

                        default:

                            $function = 'SortDistance';
                    }

                    // Sort the array
                    usort($data, $function);
                }
            }
            if(isset($from_price) || isset($distance_from)) {
                $price = array();
                $prices = array();

                $location = array();
                $locations = array();

                foreach($data as $key => $value){
                    $prices[$key] = $value["price"];
                    if($from_price <= $value["price"] && $to_price >= $value["price"]){
                        $price[$key] = $value["price"];
                    }

                    $locations[$key] = $value["distance_miles"];
                    if($distance_from <= $value["distance_miles"] && $distance_to >= $value["distance_miles"]){
                        $location[$key] = $value["distance_miles"];
                    }
                }

                foreach($price as $key => $value) {
                    unset($prices[$key]);
                }
                foreach($prices as $key => $value) {
                    unset($data[$key]);
                }

                foreach($location as $key => $value) {
                    unset($locations[$key]);
                }
                foreach($locations as $key => $value) {
                    unset($data[$key]);
                }
                $data = array_values($data);
                $count = count($data);
            }

            return array('count' => $count, 'results' => $data);
        }

        public function GetDoctorsBySpecialtyInCityState($id, $city, $state, $sort, $just = FALSE,$from_price = NULL, $to_price = NULL) {
            //var_dump($lat, $lon);exit;
            $states = $this->loc->States();
            $state1 = $states[$state];
            
            $sql = "SELECT doctors.*, new_specialties.price";
            
            $sql .= " FROM doctors
                    JOIN new_specialties
                    ON doctors.id = new_specialties.doctor_id
                    WHERE doctors.discoverable = '1'";

            if(is_numeric($id) && ($id!='-1')) { 
                $sql .= " AND new_specialties.real_id = '".$id."'";
            }
            
            if($city != 'all')
            {
                $sql .= " AND doctors.city='" . $city . "'";
            }
            
            if($state != ''){
                $sql .= " AND (doctors.state='" . $state . "' OR doctors.state='" . $state1 . "')";
            }

            $sql .= " GROUP BY doctors.id";       
                                                             
            $query = $this->db->query($sql);
            $count = $query->num_rows();
            $i = 0;
            $data = [];     
            
            foreach($query->result() as $row) {  
                if(!$just) {
                    $bio = ($row->bio == '' ? $row->name." doesn't have a bio." : $row->bio);

                    // Get the avg price of the procedure
                    $avg = $this->GetProcedureAvg($id);
                    $price_val = (empty($row->price) ? $avg : $row->price);
                    $price_avg = (empty($row->price) ? TRUE : FALSE);

                    // Define the image
                    $img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.jpg';

                    if(!is_file($img)) {
                        $img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.JPG';

                        if(!is_file($img)) {
                            $img = 'public/images/default.svg';
                        }
                    }

                    $data[$i] = array('id' => $row->id,
                                    'first' => $row->first_name,
                                    'last' => $row->last_name,
                                    'name' => $row->name,
                                    'pic' => $img,
                                    'website' => $row->website,
                                    'title' => $row->title,
                                    'address' => $row->address,
                                    'city' => $row->city,
                                    'state' => $row->state,
                                    'abbrev' => '',
                                    'phone' => $row->phone,
                                    'is_bme' => $row->is_bme,
                                    'lon' => $row->lon,
                                    'lat' => $row->lat,
                                    'rating' => $row->rating,
                                    'bio' => $bio,
                                    'price' => $price_val,
                                    'is_avg' => $price_avg,
                                    'distance_miles' => $distance,
                                    'distance' => (!empty($lat) && !empty($lon) ? $row->distance : NULL));
                } else {
                    $data[$i] = array('id' => $row->id);
                }
                $i++;
            }
 
            if($count > 0 && !$just) {
                if($sort) {
                    switch($sort) {
                        case'Top Rated';

                            $function = 'SortRating';
                            break;

                        case'Price Highest';

                            $function = 'SortPriceHigh';
                            break;

                        case'Price Lowest';

                            $function = 'SortPriceLow';
                            break;

                        case'Closest';

                            $function = 'SortDistance';
                            break;

                        default:

                            $function = 'SortDistance';
                    }

                    // Sort the array
                    usort($data, $function);
                }
            }
            if(isset($from_price) || isset($distance_from)) {
                $price = array();
                $prices = array();

                $location = array();
                $locations = array();

                foreach($data as $key => $value){
                    $prices[$key] = $value["price"];
                    if($from_price <= $value["price"] && $to_price >= $value["price"]){
                        $price[$key] = $value["price"];
                    }

                    $locations[$key] = $value["distance_miles"];
                    if($distance_from <= $value["distance_miles"] && $distance_to >= $value["distance_miles"]){
                        $location[$key] = $value["distance_miles"];
                    }
                }

                foreach($price as $key => $value) {
                    unset($prices[$key]);
                }
                foreach($prices as $key => $value) {
                    unset($data[$key]);
                }

                foreach($location as $key => $value) {
                    unset($locations[$key]);
                }
                foreach($locations as $key => $value) {
                    unset($data[$key]);
                }
                $data = array_values($data);
                $count = count($data);
            }

            return array('count' => $count, 'results' => $data);
        }

		public function GetDoctorsInField($field, $lat, $lon, $sort, $just=FALSE) {       
			$this->db->select('*');
                                
			if(!empty($lon) && !empty($lat)) {
				$this->db->select('(3959 * acos(cos(radians('.$lat.')) * cos(radians(lat)) * cos(radians(lon) - radians('.$lon.')) + sin(radians('.$lat.')) * sin(radians(lat)))) AS distance');
			}

			$this->db->where(array('discoverable' => 1, 'field' => $field));

			if(!empty($lon) && !empty($lat)) {
				$this->db->having('distance < 100');
			}

			$query = $this->db->get('doctors');      
			$count = $query->num_rows();
			$i = 0;
			$data = [];

			foreach($query->result() as $row) {
				$bio = ($row->bio == '' ? $row->name." doesn't have a bio." : $row->bio);

				// Define the image
				$img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.jpg';
				
				if(!is_file($img)) {
					$img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.JPG';

					if(!is_file($img)) {
						$img = 'public/images/default.svg';
					}
				}

				$data[$i] = array('id' => $row->id,
								'first' => $row->first_name,
								'last' => $row->last_name,
								'name' => $row->name,
								'pic' => $img,
								'website' => $row->website,
								'title' => $row->title,
								'address' => $row->address,
								'city' => $row->city,
								'state' => $row->state,
								'abbrev' => NULL,
								'phone' => $row->phone,
                                'is_bme' => $row->is_bme,
								'lon' => $row->lon,
								'lat' => $row->lat,
								'rating' => $row->rating,
								'bio' => $bio,
								'is_avg' => NULL,
								'price' => NULL,
								'distance' => NULL);
				
				$i++;
			}
            
            if($count > 0 && !$just) {
                if($sort) {
                    switch($sort) {
                        case'Top Rated';

                            $function = 'SortRating';
                            break;

                        case'Price Highest';

                            $function = 'SortPriceHigh';
                            break;

                        case'Price Lowest';

                            $function = 'SortPriceLow';
                            break;

                        case'Closest';

                            $function = 'SortDistance';
                            break;

                        default:

                            $function = 'SortDistance';
                    }

                    // Sort the array
                    usort($data, $function);
                }
            }

			return array('count' => $count, 'results' => $data);
		}
        
        public function GetDoctorsInField_CityState($field, $city, $state, $type, $just=FALSE) {
            
            $states = $this->loc->States();
            $state = $states[$state];
            
            $sql = "SELECT * FROM doctors                    
                    WHERE doctors.discoverable = '1' AND doctors.field='" . $field . "'";
                        
            if($city != 'all')
            {
                $sql .= " AND city='" . $city . "'";
            }
            
            if($state != ''){
                $sql .= " AND state='" . $state . "'";
            }
                                                             
            $query = $this->db->query($sql);
            
            $count = $query->num_rows();
            $i = 0;
            $data = [];

            foreach($query->result() as $row) {
                $bio = ($row->bio == '' ? $row->name." doesn't have a bio." : $row->bio);

                // Define the image
                $img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.jpg';
                
                if(!is_file($img)) {
                    $img = 'public/images/doctors/'.trim(strtolower($row->first_name)).'_'.trim(strtolower($row->last_name)).'.JPG';

                    if(!is_file($img)) {
                        $img = 'public/images/default.svg';
                    }
                }

                $data[$i] = array('id' => $row->id,
                                'first' => $row->first_name,
                                'last' => $row->last_name,
                                'name' => $row->name,
                                'pic' => $img,
                                'website' => $row->website,
                                'title' => $row->title,
                                'address' => $row->address,
                                'city' => $row->city,
                                'state' => $row->state,
                                'abbrev' => NULL,
                                'phone' => $row->phone,
                                'is_bme' => $row->is_bme,
                                'lon' => $row->lon,
                                'lat' => $row->lat,
                                'rating' => $row->rating,
                                'bio' => $bio,
                                'is_avg' => NULL,
                                'price' => NULL,
                                'distance' => NULL);
                
                $i++;
            }
            if($count > 0 && !$just) {
                if($sort) {
                    switch($sort) {
                        case'Top Rated';

                            $function = 'SortRating';
                            break;

                        case'Price Highest';

                            $function = 'SortPriceHigh';
                            break;

                        case'Price Lowest';

                            $function = 'SortPriceLow';
                            break;

                        case'Closest';

                            $function = 'SortDistance';
                            break;

                        default:

                            $function = 'SortDistance';
                    }

                    // Sort the array
                    usort($data, $function);
                }
            }
            return array('count' => $count, 'results' => $data);
        }

		/**
		 * [FilterResults description]
		 * @param [type] $results [description]
		 * @param [type] $id [description]
		 * @param [type] $table
		 */
		public function FilterResults($results, $table, $info) {
			// Filter the schools
			$exp = array_unique(explode(',', $info));

			// Loop thru the results
			for($i=0;$i<$results['count'];$i++) {
				if(array_key_exists($i, $results['results'])) {
					foreach($exp as $term) {
						if($table == 'education') {
							$data = array('school' => trim($term), 'doctor_id' => $results['results'][$i]['id']);
						} else {
							$data = array('hospital' => trim($term), 'doctor_id' => $results['results'][$i]['id']);
						}

						$this->db->select('id');
						$this->db->where($data);
						$query = $this->db->get($table);

						if($query->num_rows() == 0) {
							unset($results['results'][$i]);
							break;
						}
					}
				}
			}
		
			if(array_key_exists('results', $results)) {
				rsort($results['results']);
				$results['count'] = count($results['results']);
			} else {
				$results['results'] = [];
				$results['count'] = 0;
			}

			return $results;
		}

		/**
		 * Query the DB for cities that match the given query string
		 * @param {string} [q] The query string
		 * @return {array} An array containing info about each location
		 */
		public function SearchLocations($q) {
			// Explode the search term by spaces
			
			// Query the DB for relevant results
			$this->db->distinct();
			$this->db->select('city, state');              
			$this->db->like('city', $q, 'after');
            
			$this->db->group_by('city');
			$this->db->limit(5);
			$query = $this->db->get('doctors');   
			$i = 0;
			$return = [];
			$states = $this->loc->FullStates();      
                                               
			foreach($query->result() as $row) {      
				if(in_array(strtoupper($row->state), $states)) {
                    
					$state = $this->loc->ConvertState($row->state);
					$array = array('city' => $row->city, 'state' => $state);
					array_push($return, $array);
				}

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB for states with the most doctors
		 * @param {int} [procedure_id] The ID of the procedure
		 * @return {array} An array containing info about each state
		 */
		public function StatesByMostDoctors($procedure_id) {
			$sql = "SELECT state, COUNT(*) as count 
					FROM doctors 
					JOIN specialties
					ON doctors.id = specialties.doctor_id
					WHERE specialties.procedure_id = '".$procedure_id."'
					GROUP BY doctors.state 
					ORDER BY count DESC";
			$query = $this->db->query($sql);
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$array = array('state' => $row->state,
							'abbrev' => $this->loc->ConvertState($row->state),
							'count' => $row->count);
				array_push($return, $array);
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB for all of the locations in the DB
		 */
		public function GetAllLocations() {
			$this->db->select('city, state');
			$this->db->order_by('city', 'ASC');
			$this->db->distinct();
			$query = $this->db->get('doctors');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$abbrev = ($row->state == 'DISTRICT OF COLUMBIA' ? 'DC' : $this->loc->ConvertState($row->state));
				$return[$i] = array('city' => $row->city,
									'state' => $row->state,
									'abbrev' => strtoupper($abbrev));
				
				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB for all of the states
		 * @return {array} An array containing info about each state
		 */
		public function GetAllStates() {
			$this->db->select('state');
			$this->db->order_by('state', 'ASC');
			$this->db->distinct();
			$query = $this->db->get('doctors');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$abbrev = ($row->state == 'DISTRICT OF COLUMBIA' ? 'DC' : $this->loc->ConvertState($row->state));
				$return[$i] = array('state' => $row->state,
									'abbrev' => strtoupper($abbrev));
				
				$i++;
			}

			return $return;
		}

		public function TranslateCurrency($unit, $price) {
			$this->db->select('rate');
			$this->db->where('currency', strtoupper($unit));
			$query = $this->db->get('currencies');
			$result = $query->result();
			$rate = $result[0]->rate;
			return ceil($price*$rate);
		}

		/**
		 * Query the DB to find matching certifications
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the certifications
		 */
		public function SearchCerts($q) {
			$this->db->select('*');
			$this->db->like('certification', $q);
			$this->db->group_by('certification');
			$this->db->limit(5);
			$query = $this->db->get('certifications');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->certification);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to find matching certifications
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the certifications
		 */
		public function SearchEdu($q) {
			$this->db->select('*');
			$this->db->like('school', $q);
			$this->db->group_by('school');
			$this->db->limit(5);
			$query = $this->db->get('education');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->school);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to find matching hospitals
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the hospitals
		 */
		public function SearchHospitals($q) {
			$this->db->select('*');
			$this->db->like('hospital', $q);
			$this->db->group_by('hospital');
			$this->db->limit(5);
			$query = $this->db->get('hospital_affiliations');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->hospital);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to find matching awards
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the awards
		 */
		public function SearchAwards($q) {
			$this->db->select('*');
			$this->db->like('award', $q);
			$this->db->group_by('award');
			$this->db->limit(5);
			$query = $this->db->get('awards');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->award);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to find matching interests
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the interests
		 */
		public function SearchInterests($q) {
			$this->db->select('*');
			$this->db->like('interest', $q);
			$this->db->group_by('interest');
			$this->db->limit(5);
			$query = $this->db->get('interests');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->hospital);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to find matching insurances
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the insurances
		 */
		public function SearchInsurances($q) {
			$this->db->select('*');
			$this->db->like('insurance', $q);
			$this->db->group_by('insurance');
			$this->db->limit(5);
			$query = $this->db->get('insurances');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->hospital);

				$i++;
			}

			return $return;
		}

		/**
		 * Query the DB to find matching clubs
		 * @param {array} [$q] Query string
		 * @return {array} An array containing info about each of the clubs
		 */
		public function SearchClubs($q) {
			$this->db->select('*');
			$this->db->like('club', $q);
			$this->db->group_by('club');
			$this->db->limit(5);
			$query = $this->db->get('memberships');
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$return[$i] = array('name' => $row->hospital);

				$i++;
			}

			return $return;
		}

		public function InsertSpecialty($data) {
			$this->db->where(array('real_id' => $data['real_id'], 'doctor_id' => $data['doctor_id']));
			$query = $this->db->get('new_specialties');

			if($query->num_rows() == 0) {
				$this->db->insert('new_specialties', $data);
			}
		}
        
        public function GetProcedureDataFromName($name)
        {
            $this->db->where('name', $name);
            $query = $this->db->get('procedures');
            return $query->result();
        } //
        
        
        
        public function GetDoctorsByParameter($q) {
            $exp = explode(' ', $q);
            $this->db->select('*');
            $this->db->like('first_name', $exp[0]);
            
            $this->db->order_by('id', 'ASC');
            $this->db->group_by('first_name, last_name');
            $this->db->limit(5);
            $query = $this->db->get('doctors');
            $i = 0;
            $return = [];

            foreach($query->result() as $row) {
                $return[$i] = array('first_name' => $row->first_name, 
                                    'last_name' => $row->last_name);                
                $i++;
            }

            return $return;
        }
        
        public function FindProcedure($name) {
            $this->db->select('id');
            $this->db->where('name', $name);
            $query = $this->db->get('procedures');
            
            if($query->num_rows() == 1) {
                $row = $query->result();
                return $row[0]->id;
            } else {
                return NULL;
            }
        }     
        
	}
