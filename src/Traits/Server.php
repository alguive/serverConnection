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
	public function listDir(string $directory = null, bool $recursive = false): array
	{
		if (null === $directory) {
			$directory = $this->getPath();
		}

		if ($this->getConnection() instanceof \phpseclib\Net\SFTP) {
			return $this->getConnection()->nlist($directory, $recursive);
		}

		$dir = ftp_nlist($this->getConnection(), $this->getPath());

		return !$dir ? [] : $dir;
	}

	/**
	 * Change the current directory
	 *
	 * @param string|null $path
	 *
	 * @return bool|Exception
	 */
	public function changeDir(string $path = null)
	{
		if (!ftp_chdir($this->getConnection(), $this->formatDirectory($path))) {
			throw new Exception('Error changing directory.');
		}

		return $this;
	}

	/**
	 * Put file in the FTP server.
	 *
	 * @param string $remoteFile
	 * @param string $localFile
	 *
	 * @return bool|Exception
	 */
	public function putFile(string $remoteFile, string $localFile): bool
	{
		$remoteFile = $this->formatRemoteFile($remoteFile);

		if(!ftp_put($this->getConnection(), $remoteFile, $this->formatDirectory($localFile), FTP_BINARY)) {
			throw new Exception('Error putting file into server');
		}

		return true;
	}

	/**
	 * Getting the current FTP path
	 *
	 * @return string
	 */
	public function getCurrentPath(): string
	{
		return ftp_pwd($this->getConnection());
	}

	/**
	 * Format the path if required
	 *
	 * @param string|null $path
	 *
	 * @return string
	 */
	protected function formatDirectory(string $path = null): string
	{
		if (null === $path || '' == trim($path)) {
			$path = $this->addSlash('');
		}

		return $this->hasSlashSeparator($path) ? $this->addSlash($path) : $path;
	}

	/**
	 * Check if the path has slash separator
	 *
	 * @param string $path
	 *
	 * @return boolean
	 */
	private function hasSlashSeparator(string $path): bool
	{
		preg_match('/^(\/).*(\/)$/', $path, $matches);

		return !empty($matches);
	}

	/**
	 * Return formatted path with slash
	 *
	 * @param string $path
	 */
	private function addSlash(string $path): string
	{
		return sprintf('/%s', ltrim($path, '/'));
	}

	/**
	 * Formatting remote path file
	 *
	 * @param string $remoteFilestring
	 *
	 * @return [type]
	 */
	private function formatRemoteFile(string $remoteFile): string
	{
		return false != strpos($remoteFile, '/') ? $this->formatDirectory($remoteFile) : sprintf('%s/%s', $this->getCurrentPath(), $remoteFile);
	}
}
