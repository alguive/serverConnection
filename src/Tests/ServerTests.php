<?php

namespace Server\Tests;

use Server\FtpFactory;
use Server\SftpAbstract;
use PHPUnit\Framework\TestCase;

class ServerTests extends TestCase
{

	protected $ftp;

	protected $sftp;

	protected $ftpParams = ['server' => 'speedtest.tele2.net', 'username' => 'anonymous', 'password' => 'anonymous'];

	protected $sftpParams = ['server' => 'test.rebex.net', 'username' => 'demo', 'password' => 'password', 'port' => 22];

	public function testCaseStablishConnection()
	{
		if (null === $this->ftp) {
			$this->ftp = new FtpFactory($this->ftpParams);
		}

		$this->assertInstanceOf(FtpFactory::class, $this->ftp);
	}

	/**
	 * Direcotry listing
	 */
	public function testCanListDir()
	{
		if (null === $this->ftp) {
			$this->ftp = new FtpFactory($this->ftpParams);
			$this->ftp->connect();
		}

		$this->assertTrue(is_array($this->ftp->nlist()));
	}

	/**
	 * Get path.
	 */
	public function testCanGetCurrentPath()
	{
		if (null === $this->ftp) {
			$this->ftp = new FtpFactory($this->ftpParams);
			$this->ftp->connect();
		}

		$this->assertTrue(is_string($this->ftp->getCurrentPath()));
	}

}
