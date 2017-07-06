<?php namespace MailboxValidator;

class SingleValidation {
	private $apikey = '';
	private $apiurl = 'http://api.mailboxvalidator.com/v1/validation/single';
	
	public function __construct($key) {
		$this->apikey = $key;
	}
	
	public function __destruct() {
	
	}
	
	public function ValidateEmail($email) {
		try{
			$params = [ 'email' => $email, 'key' => $this->apikey, 'format' => 'json' ];
			$params2 = [];
			foreach($params as $key => $value) {
				$params2[] = $key . '=' . rawurlencode($value);
			}
			$params = implode('&', $params2);
			
			$results = file_get_contents($this->apiurl . '?' . $params);
			
			if ($results !== false) {
				return json_decode($results);
			}
			else {
				return false;
			}
		}
		catch(Exception $e) {
			return false;
		}
	}
}
?>