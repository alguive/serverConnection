<?php

namespace Server\Tests;

use Server\FtpFactory;
use PHPUnit\Framework\TestCase;

class ServerTests extends TestCase
{
	public function testCaseFirst()
	{
		$params = [
			'server' => 'speedtest.tele2.net',
			'username' => 'anonymous',
			'password' => 'anonymous',
		];

		$ftp = new FtpFactory($params);
		$ftp->connect();
	}
}
