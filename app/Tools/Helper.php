<?php
namespace App\Tools;

class Helper{ 
	private static $path = '/';
  	private static $absolutePath = 'https://projet4.celine-fafin.fr';

	public static function redirect($uri){
		header("Location: " . self::$path . $uri);
	}

	public static function link($url){
      return self::$path . $url;
	}
  
	public static function asset($url){
      return self::$absolutePath . '/assets/' . $url;
	}

	public static function hasErrors() {
		if(isset($_SESSION['errors'])){
			if(count($_SESSION['errors']) > 0 ) {
				return true;
			}
		} 
		return false;
	}

	public static function isConnected() {
		if(isset($_SESSION['connected'])){
			if(isset($_SESSION['connected']) > 0 ) {
				return true;
			}
		} 
		return false;
	}

}