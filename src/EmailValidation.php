<?php
namespace MailboxValidator;

class EmailValidation
{
    private $apiKey = '';
    private $singleValidationApiUrl = 'https://api.mailboxvalidator.com/v1/validation/single';
    private $disposableEmailApiUrl = 'https://api.mailboxvalidator.com/v1/email/disposable';
    private $freeEmailApiUrl = 'https://api.mailboxvalidator.com/v1/email/free';
    
    public function __construct($key)
    {
        $this->apiKey = $key;
    }
    
    public function __destruct()
    {
    
    }
    
    /*
    * Validate whether an email address is a valid email or not.
    */
    public function validateEmail($email)
    {
        try {
            $params = [ 'email' => $email, 'key' => $this->apiKey, 'format' => 'json' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = file_get_contents($this->singleValidationApiUrl . '?' . $params);
            
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
    * Validate whether an email address is a disposable email or not.
    */
    public function isDisposableEmail($email)
    {
        try {
            $params = [ 'email' => $email, 'key' => $this->apiKey, 'format' => 'json' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = file_get_contents($this->disposableEmailApiUrl . '?' . $params);
            
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
            $params = [ 'email' => $email, 'key' => $this->apiKey, 'format' => 'json' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = file_get_contents($this->freeEmailApiUrl . '?' . $params);
            
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
}
