MailboxValidator PHP Module
===========================
[![Latest Stable Version](https://img.shields.io/packagist/v/mailboxvalidator/mailboxvalidator-php)](https://packagist.org/packages/mailboxvalidator/mailboxvalidator-php)
![Packagist](https://img.shields.io/packagist/dt/mailboxvalidator/mailboxvalidator-php)

This PHP module enables user to easily validate if an email address is valid, a type of disposable email or free email.

This module can be useful in many types of projects, for example

 - to validate an user's email during sign up
 - to clean your mailing list prior to email sending
 - to perform fraud check
 - and so on


Installation Using PHP Composer
===============================

Add the following to your composer.json file:

```
"require": {
	"mailboxvalidator/mailboxvalidator-php": "2.1.*"
}
```


Dependencies
============

An API key is required for this module to function.

Go to https://www.mailboxvalidator.com/plans#api to sign up for FREE API plan and you'll be given an API key.


Functions
=========

## **EmailValidation** (api_key)

Creates a new instance of the MailboxValidator object with the API key.

## validateEmail (email_address)

Performs email validation on the supplied email address.

### Return Fields

| Field Name | Description |
|-----------|------------|
| email_address | The input email address. |
| domain | The domain of the email address. |
| is_free | Whether the email address is from a free email provider like Gmail or Hotmail. Return values: True, False |
| is_syntax | Whether the email address is syntactically correct. Return values: True, False |
| is_domain | Whether the email address has a valid MX record in its DNS entries. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_smtp | Whether the mail servers specified in the MX records are responding to connections. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_verified | Whether the mail server confirms that the email address actually exist. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_server_down | Whether the mail server is currently down or unresponsive. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_greylisted | Whether the mail server employs greylisting where an email has to be sent a second time at a later time. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_disposable | Whether the email address is a temporary one from a disposable email provider. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_suppressed | Whether the email address is in our blacklist. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_role | Whether the email address is a role-based email address like admin@example.net or webmaster@example.net. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_high_risk | Whether the email address contains high risk keywords. Return values: True, False, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| is_catchall | Whether the email address is a catch-all address. Return values: True, False, Unknown, -&nbsp;&nbsp;&nbsp;(- means not applicable) |
| mailboxvalidator_score | Email address reputation score. Score > 0.70 means good; score > 0.40 means fair; score <= 0.40 means poor. |
| time_taken | The time taken to get the results in seconds. |
| status | Whether our system think the email address is valid based on all the previous fields. Return values: True, False |
| credits_available | The number of credits left to perform validations. |
| error_code | The error code if there is any error. See error table in the below section. |
| error_message | The error message if there is any error. See error table in the below section. |

## isDisposableEmail (email_address)

Check if the supplied email address is from a disposable email provider.

### Return Fields

| Field Name | Description |
|-----------|------------|
| email_address | The input email address. |
| is_disposable | Whether the email address is a temporary one from a disposable email provider. Return values: True, False |
| credits_available | The number of credits left to perform validations. |
| error_code | The error code if there is any error. See error table in the below section. |
| error_message | The error message if there is any error. See error table in the below section. |

## isFreeEmail (email_address)

Check if the supplied email address is from a free email provider.

### Return Fields

| Field Name | Description |
|-----------|------------|
| email_address | The input email address. |
| is_free | Whether the email address is from a free email provider like Gmail or Hotmail. Return values: True, False |
| credits_available | The number of credits left to perform validations. |
| error_code | The error code if there is any error. See error table in the below section. |
| error_message | The error message if there is any error. See error table below. |

Sample Codes
============

## Validate email

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use MailboxValidator\EmailValidation ;

$mbv = new EmailValidation ('PASTE_YOUR_API_KEY_HERE');

$results = $mbv->validateEmail('example@example.com');

if ($results === null) {
	echo "Error connecting to API.\n";
}
else if (!isset($results->error)) {
	echo 'email_address = ' . $results->email_address . "\n";
	echo 'domain = ' . $results->domain . "\n";
	echo 'is_free = ' . var_export($results->is_free, true) . "\n";
	echo 'is_syntax = ' . var_export($results->is_syntax, true) . "\n";
	echo 'is_domain = ' . var_export($results->is_domain, true) . "\n";
	echo 'is_smtp = ' . var_export($results->is_smtp, true) . "\n";
	echo 'is_verified = ' . var_export($results->is_verified, true) . "\n";
	echo 'is_server_down = ' . var_export($results->is_server_down, true) . "\n";
	echo 'is_greylisted = ' . var_export($results->is_greylisted, true) . "\n";
	echo 'is_disposable = ' . var_export($results->is_disposable, true) . "\n";
	echo 'is_suppressed = ' . var_export($results->is_suppressed, true) . "\n";
	echo 'is_role = ' . var_export($results->is_role, true) . "\n";
	echo 'is_high_risk = ' . var_export($results->is_high_risk, true) . "\n";
	echo 'is_catchall = ' . var_export($results->is_catchall, true) . "\n";
	echo 'mailboxvalidator_score = ' . $results->mailboxvalidator_score . "\n";
	echo 'time_taken = ' . $results->time_taken . "\n";
	echo 'status = ' . var_export($results->status, true) . "\n";
	echo 'credits_available = ' . $results->credits_available . "\n";
}
else {
	echo 'error_code = ' . $results->error->error_code . "\n";
	echo 'error_message = ' . $results->error->error_message . "\n";
}
?>
```


## Check if an email is from a disposable email provider

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use MailboxValidator\EmailValidation;

$mbv = new EmailValidation('PASTE_YOUR_API_KEY_HERE');

$results = $mbv->isDisposableEmail('example@example.com');

if ($results === null) {
	echo "Error connecting to API.\n";
}
else if (!isset($results->error)) {
	echo 'email_address = ' . $results->email_address . "\n";
	echo 'is_disposable = ' . var_export($results->is_disposable, true) . "\n";
	echo 'credits_available = ' . $results->credits_available . "\n";
}
else {
	echo 'error_code = ' . $results->error->error_code . "\n";
	echo 'error_message = ' . $results->error->error_message . "\n";
}
?>
```

## Check if an email is from a free email provider

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use MailboxValidator\EmailValidation;

$mbv = new EmailValidation('PASTE_YOUR_API_KEY_HERE');

$results = $mbv->isFreeEmail('example@example.com');

if ($results === null) {
	echo "Error connecting to API.\n";
}
else if (!isset($results->error)) {
	echo 'email_address = ' . $results->email_address . "\n";
	echo 'is_free = ' . var_export($results->is_free, true) . "\n";
	echo 'credits_available = ' . $results->credits_available . "\n";
}
else {
	echo 'error_code = ' . $results->error->error_code . "\n";
	echo 'error_message = ' . $results->error->error_message . "\n";
}
?>
```

Errors
======

| error_code | error_message |
| ---------- | ------------- |
| 100 | Missing parameter. |
| 101 | API key not found. |
| 102 | API key disabled. |
| 103 | API key expired. |
| 104 | Insufficient credits. |
| 105 | Unknown error. |

Copyright
=========

Copyright(C) 2018-2023 by MailboxValidator.com.
