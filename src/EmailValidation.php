<?php
namespace MailboxValidator;

class EmailValidation
{
    private $apiKey = '';
    private $singleValidationApiUrl = 'https://api.mailboxvalidator.com/v2/validation/single';
    private $disposableEmailApiUrl = 'https://api.mailboxvalidator.com/v2/email/disposable';
    private $freeEmailApiUrl = 'https://api.mailboxvalidator.com/v2/email/free';
    
    public function __construct($key)
    {
        $this->apiKey = $key;
    }
    
    public function __destruct()
    {
    
    }
	
	/*
	* Custom wrapper function for CURL
	*/
	public function curl($url) {
		// Initialize cURL session
		$ch = curl_init();
		
		// Set cURL options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it

		// Execute cURL session and store the response in a variable
		$response = curl_exec($ch);

		// Check for cURL errors
		if (curl_errno($ch)) {
			// echo 'cURL Error: ' . curl_error($ch);
			return null;
		}

		// Close cURL session
		curl_close($ch);
		
		return $response;
	}
    
    /*
    * Validate whether an email address is a valid email or not.
    */
    public function validateEmail($email)
    {
        try {
            $params = [ 'email' => $email, 'key' => $this->apiKey, 'format' => 'json', 'source' => 'sdk-php-mbv' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = $this->curl($this->singleValidationApiUrl . '?' . $params);
            
            if ($results !== false) {
                return json_decode($results);
            }
            else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
		// restore_error_handler();
    }
    
    /*
    * Validate whether an email address is a disposable email or not.
    */
    public function isDisposableEmail($email)
    {
        try {
            $params = [ 'email' => $email, 'key' => $this->apiKey, 'format' => 'json', 'source' => 'sdk-php-mbv' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = $this->curl($this->disposableEmailApiUrl . '?' . $params);
            
            if ($results !== false) {
                return json_decode($results);
            }
            else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    
    /*
    * Validate whether an email address is a free email or not.
    */
    public function isFreeEmail($email)
    {
        try {
            $params = [ 'email' => $email, 'key' => $this->apiKey, 'format' => 'json', 'source' => 'sdk-php-mbv' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = $this->curl($this->freeEmailApiUrl . '?' . $params);
            
            if ($results !== false) {
                return json_decode($results);
            }
            else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
	
	/*private function ()
	{
		set_error_handler(
			function ($severity, $message, $file, $line) {
				throw new ErrorException($message, $severity, $severity, $file, $line);
			}
		);
	}*/
}
