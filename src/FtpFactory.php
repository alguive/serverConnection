<?php

namespace Server;

use Exception;

class FtpFactory extends ServerAbstract
{

	public function __construct(array $params)
	{
		parent::__construct($params);
	}


	public function connect()
	{
		try {
			$this->createConnection();
			$this->login();

			$this->listDir();
		} catch (Exception $e) {
			/** Throw Exception */
			dump($e->getMessage());
		}
	}

	protected function login()
	{
		try {
			ftp_login($this->getConnection(), $this->getUsername(), $this->getPassword());
		} catch (Exception $e) {
			dump($e->getMessage());
		}
	}

	protected function createConnection(): self
	{
		try {
			$this->connection = ftp_connect($this->getServer(), $this->getPort());
			$this->setPassiveMode();
		} catch (Exception $e) {
			dump($e->getMessage());
		}


		return $this;
	}
}

