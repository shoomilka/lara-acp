<?php namespace App;

use Nahidz\Imapx\Imapx;

class Shpop3x extends Imapx {

    function __construct() {
    }

    static function create($host, $username, $password, $port)
	{
        $instance = new self();
        
		$instance->driver='pop3';
		$instance->hostname=$host;
		$instance->username=$username;
		$instance->password=$password;
		$instance->port=':'.$port;
		$instance->ssl=config('imapx.ssl')?'/ssl':'';
		$instance->novalidate=config('imapx.novalidate')?'/novalidate-cert':'';

		if(config('imapx.auto-connect')){
			$instance->connect();
		}

        return $instance;
	}
}