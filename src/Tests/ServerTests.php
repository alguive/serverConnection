<?php

namespace Server\Tests;

use Server\FtpFactory;
use PHPUnit\Framework\TestCase;

class ServerTests extends TestCase
{

	protected $ftp;

	protected $ftpParams = ['server' => 'speedtest.tele2.net', 'username' => 'anonymous', 'password' => 'anonymous'];

	public function testCaseStablishConnection()
	{
		if (null === $this->ftp) {
			$this->ftp = new FtpFactory($this->ftpParams);
		}

		$this->assertInstanceOf(FtpFactory::class, $this->ftp);
	}

	public function testCanListDir()
	{
		if (null === $this->ftp) {
			$this->ftp = new FtpFactory($this->ftpParams);
			$this->ftp->connect();
		}

		$this->assertTrue(is_array($this->ftp->listDir()));
	}

	public function testCanGetCurrentPath()
	{
		if (null === $this->ftp) {
			$this->ftp = new FtpFactory($this->ftpParams);
			$this->ftp->connect();
		}

		$this->assertTrue(is_string($this->ftp->getCurrentPath()));
	}

}
