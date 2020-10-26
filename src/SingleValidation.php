<?php // MBV codeigniter and yii need to be updated as well
namespace MailboxValidator;

class EmailValidation {
    private $apikey = '';
    private $singlevalidationapiurl = 'https://api.mailboxvalidator.com/v1/validation/single';
    private $disposableemailapiurl = 'https://api.mailboxvalidator.com/v1/email/disposable';
    private $freeemailapiurl = 'https://api.mailboxvalidator.com/v1/email/free';
    
    public function __construct($key) {
        $this->apikey = $key;
    }
    
    public function __destruct() {
    
    }
    
    public function validateEmail($email) {
        /*
        * Validate whether an email address is a valid email or not.
        */
        try {
            $params = [ 'email' => $email, 'key' => $this->apikey, 'format' => 'json' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = file_get_contents($this->singlevalidationapiurl . '?' . $params);
            
            if ($results !== false) {
                return json_decode($results);
            }
            else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function isDisposableEmail($email) {
        /*
        * Validate whether an email address is a disposable email or not.
        */
        try {
            $params = [ 'email' => $email, 'key' => $this->apikey, 'format' => 'json' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = file_get_contents($this->disposableemailapiurl . '?' . $params);
            
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
    
    public function isFreeEmail($email) {
        /*
        * Validate whether an email address is a free email or not.
        */
        try {
            $params = [ 'email' => $email, 'key' => $this->apikey, 'format' => 'json' ];
            $params2 = [];
            foreach ($params as $key => $value) {
                $params2[] = $key . '=' . rawurlencode($value);
            }
            $params = implode('&', $params2);
            
            $results = file_get_contents($this->freeemailapiurl . '?' . $params);
            
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
?>