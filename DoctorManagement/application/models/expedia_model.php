<?php
	class Expedia_model extends CI_Model {
		public $secret = '64d5dgfp925je';
		public $api_key = '2264pjjd8k6ql91n5j508gihth';  
		public $cid = 478586;

		public function __construct() {       
			parent:: __construct();

			// Load the database model
			$this->load->model('database_model', 'database');
		}
        
        
        public function getHotel_test($lon, $lat, $limit)
        {
            $secret = '64d5dgfp925je';
            $host = 'http://api.ean.com/';
                                                   
            // build path
            $ver = 'v3/';
            $method = 'list/';
            $path = "ean-services/rs/hotel/{$ver}{$method}";

            // query parameters
            $apiKey = '2264pjjd8k6ql91n5j508gihth';
            $cid = '478586';
            $minorRev = '28';
            $customerUserAgent = 'Mozilla/4.0';
            $customerIpAddress = '23.27.206.118';
            $locale = 'en_US';
            $currencyCode = 'USD';
            $hotelId = '201252';

            $timestamp = gmdate('U');
            $sig = md5($apiKey . $secret . $timestamp);

            /*
            $query = "?apikey={$apiKey}&cid={$cid}&sig={$sig}&minorRev={$minorRev}"
            . "&customerUserAgent={$customerUserAgent}&customerIpAddress={$customerIpAddress}"
            . "&locale={$locale}&currencyCode={$currencyCode}&hotelIdList={$hotelId}";
            */
            
            $query = "?apikey={$apiKey}&cid={$cid}&sig={$sig}&minorRev={$minorRev}"
            . "&customerUserAgent={$customerUserAgent}&customerIpAddress={$customerIpAddress}"            
            . '&longitude=' . $lon . '&latitude=' . $lat . '&searchRadius=5';
                        
            // initiate curl
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $host . $path . $query);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept:application/json'));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $headers = curl_getinfo($ch);

            // close curl
            curl_close($ch);

            // return XML data
            if ($headers['http_code'] != '200') {
                echo "An error has occurred.";
                return false;
            } else {
                echo $data;
                return($data);
            }
        }
        

		public function Credentials() {
			$api_key = '2264pjjd8k6ql91n5j508gihth';  
			$secret = '64d5dgfp925je';    
			$sig = md5($api_key.$secret.time());
			$api_data = array('minorRev' => 28,
							'cid' => 478586, 
							'apiKey' => $api_key,
							'sig' => $sig,
							'locale' => 'en_US',
							// 'currencyCode' => 'USD',
							'customerSessionId' => '0ABAAA78-6A25-E491-4B52-BC9B70191A6F',
							//'customerIpAddress' => '', //'204.148.13.62',
							'customerUserAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.94 Safari/537.36');
			return http_build_query($api_data);
		}

		public function FindHotels($lon, $lat, $limit) {
            $secret = '64d5dgfp925je';
            // query parameters
            $apiKey = '2264pjjd8k6ql91n5j508gihth';
            $cid = '478586';
            $minorRev = '28';
            $customerUserAgent = 'Mozilla/4.0';
            $customerIpAddress = '23.27.206.118';
            
            $timestamp = gmdate('U');
            $sig = md5($apiKey . $secret . $timestamp);

            
            $url = "http://api.ean.com/ean-services/rs/hotel/v3/list?apikey={$apiKey}&cid={$cid}&sig={$sig}&minorRev={$minorRev}"
            //. "&customerUserAgent={$customerUserAgent}&customerIpAddress={$customerIpAddress}"            
            . '&longitude=' . $lon . '&latitude=' . $lat . '&searchRadius=5';
                        
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);
		                
            
		    $results = @json_decode($data, TRUE);
		    // FormatArray($results);
			$hotels = $results['HotelListResponse']['HotelList']['HotelSummary'];
			$count = count($hotels);
			$return = [];

			for($i=0;$i<$count;$i++) {
				$hotel_id = $hotels[$i]['hotelId'];
				$name = $hotels[$i]['name'];
				$address = $hotels[$i]['address1'];
				$description = $hotels[$i]['shortDescription'];
				$rating = $hotels[$i]['hotelRating'];
				$pic = $hotels[$i]['thumbNailUrl'];
				$lon = $hotels[$i]['longitude'];
				$lat = $hotels[$i]['latitude']; 

				if($rating > 2) {
					$index = count($return)-1;

                        if($index < 30) {
                            $return[$index] = array('hotel_id' => $hotel_id,
                                'name' => $name,
                                'address' => $address,
                                'description' => substr(strip_tags(html_entity_decode($description)), 18),
                                'rating' => $rating,
                                'pic' => $pic,
                                'lon' => $lon,
                                'lat' => $lat);
                        }
                    }
                

            }

			// return $results;
			return json_encode($return);
		}

		public function GetHotelImages($hotel_id) {
			$url = 'http://api.ean.com/ean-services/rs/hotel/v3/roomImages?cid='.$this->cid.'&apiKey='.$this->api_key.'&hotelId='.$hotel_id;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);
		    return @json_decode($data, TRUE);
		}

		public function GetHotelInfo($hotel_id) {
			$data = $this->Credentials();
			$url = 'http://api.ean.com/ean-services/rs/hotel/v3/info?'.$data.'&hotelId='.$hotel_id;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$data = curl_exec($ch);
		    curl_close($ch);

		    // Decode the response
		    return @json_decode($data, TRUE);
		}
	}
