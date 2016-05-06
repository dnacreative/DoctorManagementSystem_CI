<?php
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		function BioTrim($bio, $len = 255, $ellipsis = '...') {
			return (strlen($bio) > $len ? substr($bio, 0, $len).($ellipsis ? $ellipsis : '') : $bio);
		}

		function GenerateBio($field, $info) {
			if($field == 'Dentist') {
				$default = "Dr. ".$info['name']." is a dentist practicing in ".$info['city'].", ".$info['state'].". 
							For an appointment with Dr. ".$info['name'].", call VoyagerMed today: (888) 892-9572.";

			} else {
				switch($field) {
					case'Orthopedic':

						$term = 'Orthopedic Surgery';
						break;

					case'Spine':

						$term = 'Spine Surgery';
						break;

					case'Fertility':

						$term = 'Fertility Treatment';
						break;

					case'Bariatric':

						$term = 'Bariatric Treatment';
						break;

					default:

						$term = $field;
				}

				// Set the default bio
				$default = "Dr. ".$info['name']." specializes in ".$term." and is located in ".$info['city'].", ".$info['state'].". 
							For an appointment with Dr. ".$info['name'].", call VoyagerMed today: (888) 892-9572.";
			}

			return $default;
		}

		function FormatArray($array) {
			echo '<pre>';
			print_r($array);
			echo '</pre>';
		}

		function FormatProfession($field) {
			switch($field) {
				case'Bariatric':

					$profession = 'Bariatric Doctor';
					break;

				case'Dental':
				case'Dentist':

					$profession = 'Dentist';
					break;

				case'Plastic Surgery':

					$profession = 'Plastic Surgeon';
					break;

				case'Cardiology':

					$profession = 'Cardiologist';
					break;

				case'Fertility':

					$profession = 'Fertility Doctor';
					break;

				case'Oncology':

					$profession = 'Oncologist';
					break;

				case'Spine':

					$profession = 'Spine Surgeon';
					break;

				case'Orthopedic':

					$profession = 'Orthopedic Surgeon';
					break;

				defualt:

					$profession = $field;
					break;
			}

			return $profession;
		}

		function GetCurrency($currency = 'USD', $amount) {
			$url = 'https://openexchangerates.org/api/latest.json?app_id=e21add876e7644bca48542050237fba7';
			$decode = @json_decode(file_get_contents($url), TRUE);
			$rates = $decode['rates'];
			return ceil($amount*$rates[$currency]);
		}

		function ResizePic($first, $last, $size) {
            $exists = file_exists('public/images/doctors/'.$first.'_'.$last.'.jpg');

            // See if the file exists and that it's not empty
            if($exists) {
                $size = filesize('public/images/doctors/'.$first.'_'.$last.'.jpg');

                // Get the new dimensions of the pics
                if($size > 0) {
                	list($width, $height) = getimagesize('public/images/doctors/'.$first.'_'.$last.'.jpg');

                	if($width > $height) {
		                $ratio = $width/$height;
		                $new_height = ceil($width*$ratio);
		                $new_width = ceil($height*$ratio);
		                $style = 'margin-top: 10px;';
		            } elseif($height > $width) {
		                $ratio = $width/$height;
		                $new_height = ceil($size*$ratio);
		                $new_width = ceil($size*$ratio);
		                $style = 'margin-left: 10px;';
		            } else {
		                $new_height = $height;
		                $new_width = $width;
		                $style = '';
		            }

		            return array('width' => $new_width, 'height' => $new_height, 'style' => $style);
           		} else {
           			return FALSE;
           		}
            } else {
                return FALSE;
            }
		}

		function SampleBio($name, $profession, $city, $state, $procedures) {
			$bio = $name.' is a '.$profession.' practicing in '.$city.', '.$state.' focused on the specialties of ';
			$bio .= implode(', ', $procedures).'.';
			return $bio;
		}

    	function SearchMatchText($text, $q, $length) {
	    	$pos = stripos($text, $q);
			$len_city = strlen($text);
			return substr($text, 0, $pos).'<b>'.substr($text, $pos, $length).'</b>'.substr($text, $pos+$length);
		}

		function SortDistance($a, $b) {    
			return $a['distance'] - $b['distance'];
		}

		function SortPriceHigh($a, $b) {    
			return $b['price'] - $a['price'];
		}

		function SortPriceLow($a, $b) {    
			return $a['price'] - $b['price'];
		}

		function SortRating($a, $b) {    
			return $b['rating'] - $a['rating'];
		}

		function TranslateText($q, $source, $target) {
            return $q;
			if($source != $target) {
				$key = 'AIzaSyCKtqDn5R-x8VXPVJy3Tn5ZGCEgRVVsukg';
				$url = 'https://www.googleapis.com/language/translate/v2?key='.$key.'&q='.urlencode($q).'&source='.$source.'&target='.$target;
			
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$data = curl_exec($ch);
		    	curl_close($ch);
		    	$decode = @json_decode($data, TRUE);

		    	if(array_key_exists('data', $decode)) {
		    		return $decode['data']['translations'][0]['translatedText'];
		    	} else {
		    		return $q;
		    	}
			} else {
				return $q;
			}            
		}

        function getLatLong($address){

            $address = str_replace(" ", "+", $address);

            $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
            $json = json_decode($json);
            if(isset($json->{'results'}[0])){
                $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                return $lat.','.$long;
            }else{
                return false;
            }
        }

        /**
         * $unit = M(Miles)
         * $unit = K(Kilometers)
         * $unit = N(Nautical Miles)
         * @param $lat1
         * @param $lon1
         * @param $lat2
         * @param $lon2
         * @param $unit
         * @return float
         */

        function getDistance($lat1, $lon1, $lat2, $lon2, $unit) {

            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return round($miles * 1.609344);
            } else if ($unit == "N") {
                return round($miles * 0.8684);
            } else if ($unit == "M") {
                return round($miles);
            }
        }
	}
?>