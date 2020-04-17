<?php
namespace App\Model;

use \PDO;

abstract class Model
{
    protected $db;
    protected $errors = [];
    protected $sessions = [];

    public function __construct() {
        $this->dbConnect();
    }

	protected function dbConnect() {
        try{
            $this->db = new PDO('mysql:host=db5000345937.hosting-data.io;dbname=dbs336371;port=3306;charset=utf8', 'dbu460871', 'Ionos-cfb48', [\PDO::ATTR_PERSISTENT => true]);
        	$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $pe){
            echo $pe->getMessage();
        } 
	}

	public static function hydrate($instance, array $data) {
        foreach($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if(method_exists($instance, $method) || is_callable([$instance, $method])) {
                $instance->$method($value);
            }
        }
    }

    /**
     * Start session and get errors
     * @param void
     */
    protected function getErrors() {   
        $_SESSION['errors'] = $this->errors;
        return $this->errors; 
    }

    public function hasErrors() {
        return count($this->getErrors()) > 0; 
    }
}
