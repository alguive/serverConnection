<?php

namespace Server;

use Exception;
use Server\Traits\Server;

abstract class ServerAbstract
{
	use Server;

	const DEFAULT_PORT = 21;

	const DEFAULT_USERNAME = 'anonymous';

	/**
	 * @var String
	 */
	protected $path;

	/**
	 * @var integer
	 */
	protected $port;

	/**
	 * @var String
	 */
	protected $server;

	/**
	 * @var String
	 */
	protected $password;

	/**
	 * @var String
	 */
	protected $username;

	/**
	 * @var resource
	 */
	protected $connection;

	/**
	 * @var array
	 */
	protected $parameters = ['server', 'username', 'password', 'port', 'passive', 'path'];

	/**
	 * Initialize parameters.
	 *
	 * @param array $params
	 */
	public function __construct(array $params)
	{
		$this->initParams($params);
	}

	/**
	 * Initialize parameters.
	 *
	 * @param  array  $params
	 */
	public function initParams(array $params)
	{
		foreach ($this->parameters as $parameter) {
			$functionName = sprintf('set%s', ucfirst($parameter));

			if (method_exists($this, $functionName)) {
				$param = empty($params[$parameter]) ? null : $params[$parameter];
				$this->$functionName($param);
			}
		}
	}

	public function __destruct()
	{

	}

	/**
	 * Setting server address
	 *
	 * @param string|null $server
	 */
	public function setServer(string $server = null): self
	{
		if (null === $server) {
			throw new InvalidArgumentException('Invalid Server addres.');
		}

		$this->server = $server;

		return $this;
	}

	/**
	 * Setting username
	 *
	 * @param string|null $username
	 */
	public function setUsername(string $username = null): self
	{
		$this->username = null === $username ? self::DEFAULT_USERNAME : $username;

		return $this;
	}

	/**
	 * Setting password
	 *
	 * @param string|null $password
	 */
	public function setPasssword(string $password = null): self
	{
		$this->password = null === $password ? '' : $password;

		return $this;
	}

	/**
	 * Setting server port
	 *
	 * @param int|null $port
	 */
	public function setPort(int $port = null): self
	{
		$this->port = null === $port ? self::DEFAULT_PORT : $port;

		return $this;
	}

	/**
	 * Setting passive mode
	 *
	 * @param bool|null $passive
	 */
	public function setPassive(bool $passive = null): self
	{
		$this->passive = null === $passive ? true : $passive;

		return $this;
	}

	/**
	 * Setting passive mode to connection
	 */
	public function setPassiveMode(): self
	{
		try {
			ftp_pasv($this->getConnection(), $this->getPassive());
		} catch (Exception $e) {
			/**  */
		}

		return $this;
	}

	/**
	 * Setting server path
	 *
	 * @param string|null $path
	 */
	public function setPath(string $path = null): self
	{
		$this->path = null === $path ? '' : $path;

		return $this;
	}

	/**
	 * Getting server
	 *
	 * @return ?string
	 */
	protected function getServer(): ?string
	{
		return $this->server;
	}

	/**
	 * Getting username
	 *
	 * @return ?string
	 */
	protected function getUsername(): ?string
	{
		return $this->username;
	}

	/**
	 * Getting password
	 *
	 * @return ?string
	 */
	protected function getPassword(): ?string
	{
		return $this->password;
	}

	/**
	 * Getting port
	 *
	 * @return int
	 */
	protected function getPort(): int
	{
		return $this->port;
	}

	/**
	 * Getting passive mode
	 *
	 * @return bool
	 */
	protected function getPassive(): bool
	{
		return $this->passive;
	}

	protected function getPath(): string
	{
		return $this->path;
	}

	/**
	 * Getting connection
	 *
	 * @return resource
	 */
	protected function getConnection()
	{
		if (null === $this->connection) {
			$this->createConnection();
		}

		return $this->connection;
	}

	abstract public function connect(); /** @TODO declare(strict_types=1) */

	abstract protected function login();

	abstract protected function createConnection();
}
