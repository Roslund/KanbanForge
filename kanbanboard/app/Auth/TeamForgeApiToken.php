<?php

namespace App\Auth;

use Carbon\Carbon; 

class TeamForgeApiToken {
	static $credentials = NULL;
	static $token = NULL;
	static $updatedAt = NULL;

	public static function requestToken($credentials){
		$url = 'https://teamforge.srv247.se/oauth/auth/token';
	    $data = array(
	    'grant_type' => 'password',
	    'client_id' => 'api-client',
	    'scope' => 'urn:ctf:services:ctf',
	    'username' => $credentials->username,
	    'password' => $credentials->password
	    );

	    $options = array(
	      'http' => array(
	          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	          'method'  => 'POST',
	          'content' => http_build_query($data),
	      ),
	      'ssl' => array(
	          'verify_peer' => false,
	          'verify_peer_name'=>false,
	      )
	    );

	    $context  = stream_context_create($options);
	    try {
	        $contents = file_get_contents($url, false, $context);
	        $contents = utf8_encode($contents); 
	      	$result = json_decode($contents); 
	        return $result->access_token;
	    }
	    catch (\Exception $e) {
	        //\Log::error('request_teamforge_token failed: probbably invalid teamforge credentials or unable to access teamforge');
	        return null;
	    }

	    return null;
	}

	public static function getToken(){

		if(self::$token == NULL || self::$updatedAt->lte(Carbon::now()->subMinutes(59))){
			if(self::$credentials == NULL){
				self::$credentials = (object)config('teamforge.credentials');
			}
			self::$token = self::requestToken(self::$credentials);
			self::$updatedAt = Carbon::now();
			//\Log::info('TeamForgeApiToken requested new static token');
		}

		if(self::$token == NULL ){
			\Log::warning('Unable to get api access to teamforge! Check that propper credentials are provided in the .env file, and that teamforge is accessable on the url provided in /app/config/teamforge.');
		}

		return self::$token;
	}

}

