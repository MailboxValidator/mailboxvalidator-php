<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class EmailValidationTest extends TestCase
{
    public function testInvalidApiKey() {
        $mbv = new MailboxValidator\EmailValidation ("");
        $result = $mbv->validateEmail('example@example.com');

        $this->assertEquals(
            'API key not found.',
            $result->error_message ,
        );
    }

    public function testApiKeyExist() {
        if ($GLOBALS['testApiKey'] == 'YOUR_API_KEY') {
            echo "/*
* You could enter a MailboxValidator API Key in tests/bootstrap.php
* for real web service calling test.
* 
* You could sign up for a free API key at https://www.mailboxvalidator.com/plans#api
* if you do not have one.
*/";
            $this->assertEquals(
                'YOUR_API_KEY',
                $GLOBALS['testApiKey'],
            );
        } else {
            $this->assertNotEquals(
                'YOUR_API_KEY',
                $GLOBALS['testApiKey'],
            );
        }
    }

    public function testValidateEmail() {
        $mbv = new MailboxValidator\EmailValidation ($GLOBALS['testApiKey']);
        $result = $mbv->validateEmail('example@example.com');

        if ($GLOBALS['testApiKey'] == 'YOUR_API_KEY') {
            $this->assertEquals(
                '101',
                $result->error_code,
            );
        } else {
            $this->assertEquals(
                'False',
                $result->status,
            );
        }
    }

    public function testIsDisposableEmail() {
        $mbv = new MailboxValidator\EmailValidation ($GLOBALS['testApiKey']);
        $result = $mbv->isDisposableEmail('example@example.com');

        if ($GLOBALS['testApiKey'] == 'YOUR_API_KEY') {
            $this->assertEquals(
                '101',
                $result->error_code,
            );
        } else {
            $this->assertEquals(
                'True',
                $result->is_disposable,
            );
        }
    }

    public function testIsFreeEmail() {
        $mbv = new MailboxValidator\EmailValidation ($GLOBALS['testApiKey']);
        $result = $mbv->isFreeEmail('example@example.com');

        if ($GLOBALS['testApiKey'] == 'YOUR_API_KEY') {
            $this->assertEquals(
                '101',
                $result->error_code,
            );
        } else {
            $this->assertEquals(
                'False',
                $result->is_free,
            );
        }
    }
}
