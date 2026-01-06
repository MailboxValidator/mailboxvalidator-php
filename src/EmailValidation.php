<?php
namespace MailboxValidator;

class EmailValidation
{
    private $apiKey = '';
    private $baseUrl = 'https://api.mailboxvalidator.com/v2/';
    
    public function __construct($key)
    {
        $this->apiKey = $key;
    }
    
    public function __destruct()
    {
    
    }

    /**
     * Internal helper to handle API requests
     */
    private function request($path, $email)
    {
        $params = array(
            'email'  => $email,
            'key'    => $this->apiKey,
            'format' => 'json',
            'source' => 'sdk-php-mbv'
        );

        $url = $this->baseUrl . $path . '?' . http_build_query($params);
        $results = $this->curl($url);

        if ($results) {
            return json_decode($results);
        }

        return null;
    }
	
	/**
	 * Custom wrapper function for CURL
	 */
	public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Optimization: Added a timeout to prevent script hanging
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
        
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        return $response;
    }
    
    /**
     * Validate whether an email address is a valid email or not.
     */
    public function validateEmail($email)
    {
        return $this->request('validation/single', $email);
    }
    
    /**
     * Validate whether an email address is a disposable email or not.
     */
    public function isDisposableEmail($email)
    {
        return $this->request('email/disposable', $email);
    }
    
    /**
     * Validate whether an email address is a free email or not.
     */
    public function isFreeEmail($email)
    {
        return $this->request('email/free', $email);
    }
}
