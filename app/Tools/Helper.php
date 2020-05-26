<?php
namespace App\Tools;

class Helper{ 
	private static $path = '/projet4/';
	private static $absolutePath = '/projet4/';

	/* Used to create a redirection */
	public static function redirect($uri){
		header("Location: " . self::$path . $uri);
	}

	/* Used to create a link */
	public static function link($url){
		return self::$path . $url;
	}

  	/* Used to create a link to the asset */
	public static function asset($url){
		return self::$absolutePath . '/assets/' . $url;
	}

	/* Used to verify errors */
	public static function hasErrors() {
		if(isset($_SESSION['errors'])){
			if(count($_SESSION['errors']) > 0 ) {
				return true;
			}
		} 
		return false;
	}

	/* Used to verify sessions */
	public static function isConnected() {
		if(isset($_SESSION['connected'])){
			if(isset($_SESSION['connected']) > 0 ) {
				return true;
			}
		} 
		return false;
	}

}