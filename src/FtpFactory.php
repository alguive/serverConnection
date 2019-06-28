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
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $this;
	}


	protected function login(): ?self
	{
		if (!ftp_login($this->getConnection(), $this->getUsername(), $this->getPassword())) {
			throw new Exception('Error Login to the server.');
		}

		return $this;
	}


	protected function createConnection(): ?self
	{
		$this->connection = ftp_connect($this->getServer(), $this->getPort());

		if (!$this->connection) {
			throw new Exception('Error connecting to the server.');
		}

		$this->setPassiveMode();

		$this->login();

		return $this;
	}
}
