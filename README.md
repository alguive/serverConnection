# Server Connection
--

This FTP/SFTP project provides an easy way to stablish connection with FTP/SFTP Servers.

You will be able to put files on the server, list server directories, create directories, remove directories, move inside the server directories, etc...


## List of params
```
server
username
password
port
passive
path
```


## Create new FTP Connection
```
use Server\FtpFactory;

$params[
	'server' => $xx,
	'username' => $xx,
	'password' => $xx,
];

$ftp = new FtpFactory($params);
```


## Create new SFTP Connection
```
use Server\SftpAbstract;

$params[
	'server' => $xx,
	'username' => $xx,
	'password' => $xx,
];

$ftp = new SftpFactory($params);
```