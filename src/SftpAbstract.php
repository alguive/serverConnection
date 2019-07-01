<?php

namespace Server;

use phpseclib\Net\SFTP;

class SftpAbstract extends ServerAbstract
{
	public function __construct(array $params)
	{
		parent::__construct($params);
	}

	public function connect()
	{

		$this->connection = new SFTP($this->getServer());

		if (!$this->connection->login($this->getUsername(), $this->getPassword())) {
			echo 'error';

			die;
		}


		return $this;
	}

	public function login()
	{

	}

	public function createConnection()
	{

	}


}

