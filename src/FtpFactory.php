<?php
declare(strict_types=1);

namespace Server;

use Exception;

class FtpFactory extends ServerAbstract
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
	protected function login(): ?self
	{
		if (!ftp_login($this->getConnection(), $this->getUsername(), $this->getPassword())) {
			throw new Exception('Error Login to the server.');
		}

		return $this;
	}

	/**
	 * @inheritdoc
	 */
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
