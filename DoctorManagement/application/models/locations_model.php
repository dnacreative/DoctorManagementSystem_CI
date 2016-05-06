<?php
	class Locations_model extends CI_Model {
		public $api_key = 'ex8f8fsakvdn5na48g5j2z2u';
		public $cid = '55505';
		
		public function __construct() {       
			parent:: __construct();

			// Define the API key for MapQuest
			$this->mapquest_key = 'Cmjtd|luur2108n1,7w=o5-gz8a';

			// Define the URL for the MapQuest API
			$this->mapquest_url = 'http://www.mapquestapi.com/geocoding/v1/address?';
		}

		public function Abbreviations() {
			return array('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC',
						'FL', 'GA', 'HI', 'ID',	'IL', 'IN', 'IA', 'KS',	'KY',
						'LA', 'ME',	'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 
						'NE', 'NV',	'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH',				
						'OK', 'OR',	'PA', 'RI', 'SC', 'SD', 'TN', 'TX',	'UT',				
						'VT', 'VA', 'WA', 'DC', 'WV', 'WI', 'WY');
		}

		public function BreakState($state) {
			switch($state) {
				case'Carolina':
				case'Dakota':
				case'Hampshire':
				case'Jersey':
				case'Mexico':
				case'York':

					return TRUE;
					break;

				default:

					return FALSE;
					break;
			}
		}

		// Get the city and state from a location name by splitting it by the comma
		public function CityAndState($location) {
			$exp = explode(', ', $location);

			if(count($exp) > 1) {
				return array('city' => trim($exp[0]), 'state' => trim($exp[1]));
			} else {
				return FALSE;
			}
		}

		// Convert a state to its abbrev from its full name
		public function ConvertState($key) {
		    $states = array_flip($this->States());
		    $res = $states[strtoupper($key)];
		    return $res;
		}

		// Calculate the distance between two coordinate places
		public function DistanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km') {
			// Calculate the distance in degrees
			$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
		 
			switch($unit) {
				case'km':
					$distance = $degrees*111.13384; 
					break;

				case'mi':
					$distance = $degrees*69.05482; 
					break;

				case'nmi':
					$distance = $degrees*59.97662;
			}

			return ceil($distance);
		}

		// Get a state's full name from its abbreviation
		public function FullFromAbbrev($state) {
			$states = $this->States();

			foreach($states as $key => $val) {
				if($key == $state) {
					return $val;
					break;
				}
			}
		}

		public function FullStates() {
			return array('ALABAMA',
						'ALASKA',
						'ARIZONA',
						'ARKANSAS',
						'CALIFORNIA',
						'COLORADO',
						'CONNECTICUT',
						'DELAWARE',
						'DISTRICT OF COLUMBIA',
						'FLORIDA',
						'GEORGIA',
						'HAWAII',
						'IDAHO',
						'ILLINOIS',
						'INDIANA',
						'IOWA',
						'KANSAS',
						'KENTUCKY',
						'LOUISIANA',
						'MAINE',
						'MARYLAND',
						'MASSACHUSETTS',
						'MICHIGAN',
						'MINNESOTA',
						'MISSISSIPPI',
						'MISSOURI',
						'MONTANA',
						'NEBRASKA',
						'NEVADA',
						'NEW HAMPSHIRE',
						'NEW JERSEY',
						'NEW MEXICO',
						'NEW YORK',
						'NORTH CAROLINA',
						'NORTH DAKOTA',
						'OHIO',
						'OKLAHOMA',
						'OREGON',
						'PENNSYLVANIA',
						'RHODE ISLAND',
						'SOUTH CAROLINA',
						'SOUTH DAKOTA',
						'TENNESSEE',
						'TEXAS',
						'UTAH',
						'VERMONT',
						'VIRGINIA',
						'WASHINGTON',
						'WASHINGTON D.C.',
						'WEST VIRGINIA',
						'WISCONSIN',
						'WYOMING');
		}

		// Get the name of a city and state from its latitude and longitude coordinates
		public function GeoLocation($lon, $lat) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&sensor=false');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);
		    return @json_decode($data, TRUE);
		}

		// Find the distance between two places
		public function Haversine($lat_from, $lon_from, $lat_to, $lon_to) {
			$lat_from = deg2rad($lat_from);
			$lon_from = deg2rad($lon_from);
			$lat_to = deg2rad($lat_to);
			$lon_to = deg2rad($lon_to);
			$lat_delta = $lat_to-$lat_from;
			$lon_delta = $lon_to-$lon_from;

			$angle = 2 * asin(sqrt(pow(sin($lat_delta / 2), 2) + cos($lat_from) * cos($lat_to) * pow(sin($lon_delta / 2), 2)));
			return ceil(($angle*6371));
		}

		public function LatLonFromAddress($address) {
			$key = 'AIzaSyCy6LbgbzAqWNbPnUQx_lH60pTuurk43Cs';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.$key);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);
		    return @json_decode($data, TRUE);
		}

		// Get the latitude and longitude coordinates from the name of a city and state
		public function LocationFromAddress($address, $city, $state) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($city).','.$state.'&sensor=false');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);

		    // Decode the response
		    $decode = @json_decode($data, TRUE);

		    if(count($decode['results']) > 0) {
		    	return json_encode($decode['results'][0]['geometry']['location']);
		    } else {
		    	return 'error';
		    }
		}

		/**
		 * Make a request to MapQuest's API endpoing to get the name of the city and the name/abbreviation of the state from lon & lat coordinates
		 * @param {decimal} [lat] The latitude coordinate
		 * @param {decimal} [lon] The longitude coordinate
		 * @return {array} An array containing the country, city and state of a location
		 */
		public function MapquestLatLon($lat, $lon) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->mapquest_url.'location='.urlencode($lat.','.$lon).'&key='.$this->mapquest_key);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);

		    // Decode the response
		    $decode = @json_decode($data, TRUE);
		    $location = $decode['results'][0]['locations'][0];
		    FormatArray($location);

		    return array('country' => $location['adminArea1'],
		    			'city' => $location['adminArea5'], 
		    			'state' => $location['adminArea3']);
		}

		/**
		 * Make a request to MapQuest's API endpoing to get the lat & lon coordinates from the a city and/or state name/abbreviation
		 * @param {string} [city] The name of the city
		 * @param {string} [state] The name of the state
		 * @return {array} An array containing the results from MapQuest's API
		 */
		public function MapquestLocation($city, $state) {
			// Define the parameter
			$param = (!empty($city) && !empty($city) ? $city.','.$state : $state);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->mapquest_url.'location='.urlencode($param).'&key='.$this->mapquest_key);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);
		    $decode = @json_decode($data, TRUE);

		    if($decode['info']['statuscode'] == 400) {
		    	return array('lat' => NULL, 'lng' => NULL);
		    } else {
				return $decode['results'][0]['locations'][0]['latLng'];
			}
		}

		// Convert miles to meters
		public function MilesToMeters($miles) {
			return ceil($miles/0.000621371);
		}

		public function States() {
			return array('AL' => 'ALABAMA',
						'AK' => 'ALASKA',
						'AZ' => 'ARIZONA',
						'AR' => 'ARKANSAS',
						'CA' => 'CALIFORNIA',
						'CO' => 'COLORADO',
						'CT' => 'CONNECTICUT',
						'DE' => 'DELAWARE',
						'DC' => 'DISTRICT OF COLUMBIA',
						'FL' => 'FLORIDA',
						'GA' => 'GEORGIA',
						'HI' => 'HAWAII',
						'ID' => 'IDAHO',
						'IL' => 'ILLINOIS',
						'IN' => 'INDIANA',
						'IA' => 'IOWA',
						'KS' => 'KANSAS',
						'KY' => 'KENTUCKY',
						'LA' => 'LOUISIANA',
						'ME' => 'MAINE',
						'MD' => 'MARYLAND',
						'MA' => 'MASSACHUSETTS',
						'MI' => 'MICHIGAN',
						'MN' => 'MINNESOTA',
						'MS' => 'MISSISSIPPI',
						'MO' => 'MISSOURI',
						'MT' => 'MONTANA',
						'NE' => 'NEBRASKA',
						'NV' => 'NEVADA',
						'NH' => 'NEW HAMPSHIRE',
						'NJ' => 'NEW JERSEY',
						'NM' => 'NEW MEXICO',
						'NY' => 'NEW YORK',
						'NC' => 'NORTH CAROLINA',
						'ND' => 'NORTH DAKOTA',
						'OH' => 'OHIO',
						'OK' => 'OKLAHOMA',
						'OR' => 'OREGON',
						'PA' => 'PENNSYLVANIA',
						'RI' => 'RHODE ISLAND',
						'SC' => 'SOUTH CAROLINA',
						'SD' => 'SOUTH DAKOTA',
						'TN' => 'TENNESSEE',
						'TX' => 'TEXAS',
						'UT' => 'UTAH',
						'VT' => 'VERMONT',
						'VA' => 'VIRGINIA',
						'WA' => 'WASHINGTON',
						'DC' => 'WASHINGTON D.C.',
						'WV' => 'WEST VIRGINIA',
						'WI' => 'WISCONSIN',
						'WY' => 'WYOMING');
		}

		public function ValidateLocation($city, $state) {
			$this->db->select('id');
			$this->db->where(array('city' => $city, 'state' => $state));
			$query = $this->db->get('doctors');
			return $query->num_rows();
		}
	}
