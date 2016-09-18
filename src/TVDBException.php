<?php

namespace Dawson\TVDB;

class TVDBException extends \Exception
{
	/**
	 * Status Code
	 * 
	 * @var integer
	 */
	protected $code;

	/**
	 * Status Message
	 * 
	 * @var string
	 */
	protected $message;

	/**
	 * Constructor
	 */
	public function __construct($exception)
	{
		$this->message = $exception->getResponse()->getReasonPhrase();
		$this->code    = $exception->getResponse()->getStatusCode();

		parent::__construct($this->message, $this->code, $exception);
	}
}