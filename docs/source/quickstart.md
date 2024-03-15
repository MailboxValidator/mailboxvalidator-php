# Quickstart

## Dependencies

An API key is required for this module to function.

Go to https://www.mailboxvalidator.com/plans#api to sign up for FREE API plan and you'll be given an API key.

## Installation

Add the following to your composer.json file:

```
"require": {
	"mailboxvalidator/mailboxvalidator-php": "2.1.*"
}
```

## Sample Codes

### Validate email

You can validate whether an email address is invalid or not as below:

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
	echo 'base_email_address = ' . $results->base_email_address . "\n";
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
	echo 'is_dmarc_enforced = ' . var_export($results->is_dmarc_enforced, true) . "\n";
	echo 'is_strict_spf = ' . var_export($results->is_strict_spf, true) . "\n";
	echo 'website_exist = ' . var_export($results->website_exist, true) . "\n";
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

### Check if an email is from a disposable email provider

You can validate whether an email address is disposable email address or not as below:

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

### Check if an email is from a free email provider

You can validate whether an email address is free email address or not as below:

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
