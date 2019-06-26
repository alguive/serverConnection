<?php

namespace Server\Traits;

Trait Server
{

	public function listDir()
	{
		dump(ftp_nlist($this->getConnection(), $this->getPath()));
	}
}

