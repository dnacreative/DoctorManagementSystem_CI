<?php
	class BetterDoctor_model extends CI_Model {
		public function __construct() {       
			parent:: __construct();

			// Load the database model
			$this->load->model('database_model', 'database');

			// Define the bearer token
			$this->token = 'ODI4YTI4ZmMtMmZhNC00ZDY1LThjN2EtM2ViYjUzOGRiYzhj';
		}

		public function GetDoctorInfo($id, $practice_id) {
			$headers = array('Content-Type: application/json', 'Authorization: Bearer '.$this->token);
			$params = array('ratings' => 'yelp,betterdoctor',
							'in_referrals' => 'true',
							'reviews' => 'yelp',
							'insurances_by_provider' => 'true',
							'practice_uid' => $practice_id,
							'specialty_group_uid' => 'primary-care-doctors',
							'_' => time());
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://betterdoctor.com/api/v3/doctors/'.$id.'?'.http_build_query($params));
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_REFERER, 'https://betterdoctor.com/');
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$data = curl_exec($ch);
		    curl_close($ch);
		    return @json_decode($data, TRUE);
		}

		public function SearchDoctors($q) {
			$headers = array('Content-Type: application/json', 'Authorization: Bearer '.$this->token);
			$params = array('name' => $q, 'type' => 'es', 'prefix' => 'true', '_' => time());

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://betterdoctor.com/api/v3/doctors/search?'.http_build_query($params));
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_REFERER, 'https://betterdoctor.com/');
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$data = curl_exec($ch);
		    curl_close($ch);
		    return @json_decode($data, TRUE);
		}

		public function ParseDoctor($json) {	
			$profile = $json['profile'];
			$first = $profile['first_name'];
			$last = $profile['last_name'];
			$middle = $profile['middle_name'];
			$title = $profile['title'];
			$gender = $profile['gender'];
			$img = $profile['img_url'];
			$bio = $profile['dynamic_bio'];
			$dob = $profile['dob'];
			
			// Languages array
			$langs = $profile['languages'];
	
			// Licenses array		
			$licenses = $profile['licenses'];

			// Practice address and location info
			$practices = $json['practices'];
			$practice_name = $practices[0]['name'];
			$addy = $practices[0]['visit_address'];
			$street = $addy['street'];
			$city = $addy['city'];
			$abbrev = $addy['state'];
			$street = $addy['street_long'];
			$zip = $addy['zip'];
			$lat = $addy['lat'];
			$lon = $addy['lon'];

			// Hospital affiliations array
			$hospitals = $json['hospital_affiliations'];

			// Specialties array
			$specialties = $json['specialty_groups'][0]['conditions'];

			// Insurances
			$insurances = $json['insurances_by_provider'];

			for($i=0;$i<count($insurances);$i++) {
				$ins = $insurances[$i]['name'];

				for($x=0;$x<count($insurances[$i]['plans']);$x++) {
					$plan = $insurances[$i]['plans'][$x]['name'];
				}
			}
		}

		
	}