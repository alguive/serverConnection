<?php
declare(strict_types=1);

namespace Server;

use Exception;
use phpseclib\Net\SFTP;

class SftpAbstract extends ServerAbstract
{

	/**
	 * @inheritdoc
	 */
	public function __construct(array $params)
	{
		parent::__construct($params);
	}

	/**
	 * @inheritdoc
	 */
	public function connect()
	{
		try {
			$this->createConnection();
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function login(): ?self
	{
		if (!$this->connection->login($this->getUsername(), $this->getPassword())) {
			throw new Exception('Error login to SFTP server.');
		}

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function createConnection(): ?self
	{
		$this->connection = new SFTP($this->getServer());

		if (!$this->connection) {
			throw new Exception('Error connecting SFTP server.');
		}

		$this->login();

		return $this;
	}


}

