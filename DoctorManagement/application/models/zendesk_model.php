<?php
	class Zendesk_model extends CI_Model {
		public $api_key = 'ex8f8fsakvdn5na48g5j2z2u';
		public $cid = '55505';
		// public $username = 'anthony@voyagermed.com';
		// public $password = 'Voyager2014!';
		
		public $username = 'info@voyagermed.com';
		public $password = 'Voyager2014!';

		public function __construct() {       
			parent:: __construct();

			// Load the database model
			$this->load->model('database_model', 'database');
		}

		/**
		 * [CreateTicket description]
		 * @param [type] $name [description]
		 * @param [type] $email [description]
		 * @param [type] $subject [description]
		 * @param [type] $comment [description]
		 */
		public function CreateTicket($first, $last, $zip, $email, $phone, $procedure, $comment) {
			$subject = $first." ".$last." has contacted you regarding an operation in ".$procedure.".";
			
			// Define the message of the ticket
			$msg = $subject;
			$msg .= " Their phone number is ".$phone." and their email is ".$email.".";
			$msg .= " Here is what he/she had to say: ".$comment;

			$headers = array('Content-Type: application/json');
			$data = array('ticket' => array('requester' => array('name' => $first.' '.$last, 'email' => $email),
						'subject' => $subject,
						'comment' => array('body' => $msg)));

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://voyagermed.zendesk.com/api/v2/tickets.json');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_USERPWD, $this->username.':'.$this->password);
			$data = curl_exec($ch);
		    curl_close($ch);
		    return @json_decode($data, TRUE);
		}
	}