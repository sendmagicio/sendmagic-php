<?php

namespace SendMagic;

use GuzzleHttp\Client;

class SendMagic {

	public $contacts;

	public function __construct($secret_key)
	{
		$this->contacts = new SendMagicContacts($secret_key);
	}
}
