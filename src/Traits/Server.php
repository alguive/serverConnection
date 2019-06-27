<?php

namespace Server\Traits;

Trait Server
{

	/**
	 * Listing directory
	 *
	 * @param string|null $directory
	 *
	 * @return array
	 */
	public function listDir(string $directory = null): array
	{
		if (null === $directory) {
			$directory = $this->getPath();
		}

		return ftp_nlist($this->getConnection(), $this->getPath());
	}

	public function changeDir(string $path = null): bool
	{
		/** TODO */
	}

	public function putFile(string $remoteFile, string $localFile): bool
	{
		/** TODO */
	}

	public function getCurrentPath(): string
	{
		/** TODO */
	}

	public function formatDirectory(string $path = null): string
	{
		/** TODO */
	}

	protected function hasSlashSeparator(string $path): bool
	{

	}

	protected function addSlash(string $path): string
	{
		/** TODO */
	}

	protected function formatRemoteFile(string $remoteFile): string
	{

	}
}
