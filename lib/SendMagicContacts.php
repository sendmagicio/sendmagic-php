<?php

namespace SendMagic;

class SendMagicContacts extends ApiResource {

	private $resourcePath = "/contacts";

	public function create($params = null)
	{
		$this->validateParams($params);
		
		$response = $this->post($this->resourcePath, $params);
		return $response;

		// $obj = \Stripe\Util\Util::convertToStripeObject($response->json, $opts);
		// $obj->setLastResponse($response);
		// return $obj;
	}

	public function delete($id)
	{
		$response = $this->delete($this->resourcePath . '/' . $id);
		return $response;
	}
}
