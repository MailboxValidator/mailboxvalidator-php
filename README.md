MailboxValidator PHP Module
===========================

This PHP module provides an easy way to call the MailboxValidator API which validates if an email address is a valid one.

This module can be used in many types of projects such as:

 - validating a user's email during sign up
 - cleaning your mailing list prior to an email marketing campaign
 - a form of fraud check


Installation Using PHP Composer
===============================

Add the following to your composer.json file:

```
"require": {
	"mailboxvalidator/email-validation": "1.0.*"
}
```


Dependencies
============

An API key is required for this module to function.

Go to http://www.mailboxvalidator.com/plans#api to sign up for FREE API plan and you'll be given an API key.


Sample Usage
============

```php
require_once __DIR__ . '/vendor/autoload.php';

use MailboxValidator\SingleValidation;

$mbv = new SingleValidation('PASTE_YOUR_API_KEY_HERE');

$results = $mbv->ValidateEmail('example@example.com');

if ($results === false) {
	echo "Error connecting to API.\n";
}
else if (trim($results->error_code) == '') {
	echo 'email_address = ' . $results->email_address . "\n";
	echo 'domain = ' . $results->domain . "\n";
	echo 'is_free = ' . $results->is_free . "\n";
	echo 'is_syntax = ' . $results->is_syntax . "\n";
	echo 'is_domain = ' . $results->is_domain . "\n";
	echo 'is_smtp = ' . $results->is_smtp . "\n";
	echo 'is_verified = ' . $results->is_verified . "\n";
	echo 'is_server_down = ' . $results->is_server_down . "\n";
	echo 'is_greylisted = ' . $results->is_greylisted . "\n";
	echo 'is_disposable = ' . $results->is_disposable . "\n";
	echo 'is_suppressed = ' . $results->is_suppressed . "\n";
	echo 'is_role = ' . $results->is_role . "\n";
	echo 'is_high_risk = ' . $results->is_high_risk . "\n";
	echo 'is_catchall = ' . $results->is_catchall . "\n";
	echo 'mailboxvalidator_score = ' . $results->mailboxvalidator_score . "\n";
	echo 'time_taken = ' . $results->time_taken . "\n";
	echo 'status = ' . $results->status . "\n";
	echo 'credits_available = ' . $results->credits_available . "\n";
}
else {
	echo 'error_code = ' . $results->error_code . "\n";
	echo 'error_message = ' . $results->error_message . "\n";
}
```


Copyright
=========

Copyright (C) 2017 by MailboxValidator.com, support@mailboxvalidator.com
