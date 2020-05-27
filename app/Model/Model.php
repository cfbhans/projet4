<?php
namespace App\Model;

use \PDO;

/** 
* Class Manager
* Used to connect to database
* Used to hydrate data
* Used to get errors
**/

abstract class Model
{
	protected $db;
	protected $errors = [];
	protected $sessions = [];

	public function __construct() {
		$this->dbConnect();
	}

	/**
	 * connection to the database
	 */
	protected function dbConnect() {
		$this->db = new PDO('mysql:host='. env('DB_HOST') .';dbname='. env('DB_NAME') . ';port='. env('DB_PORT') .';charset=utf8', env('DB_USERNAME'), env('DB_PASSWORD'));
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * hydratation datas
	 */
	public function hydrate(array $data) {
		
		foreach($data as $key => $value) {
			
			$method = 'set'.ucfirst($key);
			
			if(method_exists($this, $method) || is_callable([$this, $method])) {
				$this->$method($value);
			}
		}
	}

	/**
	 * get errors
	 */
	protected function getErrors() {   
		$_SESSION['errors'] = $this->errors;
		return $this->errors; 
	}

	public function hasErrors() {
		return count($this->getErrors()) > 0; 
	}
}
