<?php
namespace App\Model;

use \PDO;

class User extends Model
{
	private $id;
	private $email;
	private $password;
	private $isAdmin;
	private $confirmPassword;
	private $emailConnect;
	private $passwordConnect;

	const INVALID_MAIL = "L'utilisateur n'est pas valide";
	const EMPTY = "L'utilisateur ou le mot de passe sont vides";
	const INVALID_LENGTH = "L'email ou le mot de passe doivent comporter plus de 5 caractères";
	const TAKEN_MAIL = "Le nom d'utilisateur est déjà pris";
	const INVALID_PASSWORD = "Le mot de passe n'est pas valide";
	const INVALID_CONFIRM = "Le mot de passe n'est pas vérifié";
	const INVALID_STATUS = "Vous n'avez pas le statut pour vous connecter à l'espace d'administration";

	/**
	 * Create a new user
     */
	public function create() {
		$q = $this->db->prepare('INSERT INTO users(email, password) VALUES(:email, :password)');
		
		return $q->execute([
			'email'		=> $this->getEmail(),
			'password' 	=> password_hash($this->getPassword(), PASSWORD_DEFAULT)
		]);

	}

	/**
	 * Find a user
	 * @param int $id
     */
	public function find($id) {        
		$q = $this->db->prepare('SELECT id FROM users WHERE id = :id');
		$q->execute([
			'id' => $id
		]);

		$data = $q->fetch();
		
		$user = new User();

		$user->hydrate($data);

		return $user;
	}

	/**
	 * get email users
     */
	public function get($email) {
		$q = $this->db->prepare('SELECT email, password, isAdmin FROM users WHERE email = :email');
		$q->execute([
			'email'	=> $email
		]);

		$data = $q->fetch(\PDO::FETCH_ASSOC);

		return $data;
	}

	/**
	 * unregister users
     */
	public function unregister() {
		$usersAdmin = [];

		$q = $this->db->query('SELECT id, email, isAdmin FROM users');
		$results = $q->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($results as $result) {
			$user = new User();
			$user->hydrate($result);
			$usersAdmin[] = $user; 
		}

		return $usersAdmin;
	}

		/**
	 * Delete an user
	 * @param int $id
     */
	public function delete($id) {
		$del = $this->db->prepare('DELETE FROM users WHERE id = :id');
		$del->execute([
			'id' => $id
		]);
	}

	public function getId(): int {
		return $this->id; 
	}

	public function getEmail(): string {
		return $this->email;
	}

	public function getPassword(): string {
		return $this->password;
	}

	public function getEmailConnect(): string {
		return $this->emailConnect;
	}

	public function isAdmin(): bool {
		return !!$this->isAdmin;
	}

	public function setId($id) {
		$id = (int)$id;
		if($id > 0) {
			$this->id = $id;
		}
	}

	public function setEmail(string $email) {
		if(!is_string($email)){
			$this->errors[] = self::INVALID_MAIL;
		}
		if (empty($email)){
			$this->errors[] = self::EMPTY;
		}
		if(!(strlen($email) > 5)) {
			$this->errors[] = self::INVALID_LENGTH;
		}
		$this->email = $email;
		return true;
	}

	public function setPassword(string $password) {
		if(!is_string($password)){
			$this->errors[] = self::INVALID_PASSWORD;
		}
		if (empty($password)){
			$this->errors[] = self::EMPTY;
		}
		if(!(strlen($password) > 5)) {
			$this->errors[] = self::INVALID_LENGTH;
		}
		$this->password = $password;
		return true;
	}

	public function exists($email) {
		if($email !=  $this->get($email)['email']) {
			return false;
		}
		return true;
	}

	public function setIsAdmin(bool $isAdmin) {
		if (!$isAdmin) {
			$this->errors[] = self::INVALID_STATUS;
		}
		$this->isAdmin = $isAdmin;
	}

	public function verifyRegister(array $data) {
		/*si l'email est valide*/
		if(!$this->setEmail($data['email'])) {
			return false;
		}
		/*si l'email n'est pas déjà dans la db*/
		if($this->exists($data['email'])) {
			$this->errors[] = self::TAKEN_MAIL;
			return false;
		}

		/*si le mot de passe est confirmé*/
		if ($data['password'] != $data['confirmPassword']) {
			$this->errors[] = self::INVALID_CONFIRM;
			return false;
		}

		/*si le mot de passe est valide*/
		if(!!$this->setPassword($data['password'])) {
			return false;
		}
		return true;
	}

	public function connect() {
        if(session_status() === PHP_SESSION_NONE) {
        	//session_start();
            $_SESSION['connected'] = $this->getEmail();
        }
        $_SESSION['connected'] = $this->getEmail(); 
    }

    public function verifyConnect($email, $password) {
    	/*si le mail existe dans la db*/

    	if(!$this->exists($email)) {
    		$this->errors[] = self::INVALID_MAIL;
			return false;
		}
 
		/*si le mot de passe est valide*/
		$this->setPassword($password);

		$user = $this->get($email);
		if(!password_verify($password, $user['password'])) {
			$this->errors[] = self::INVALID_PASSWORD;
			return false;
		}

		if(!$this->setIsAdmin($user['isAdmin'])) {
			return false;
		}

		return true;
    }

    public function switchAdmin ($id, $isAdmin){
		$q = $this->db->prepare('UPDATE users SET isAdmin = :isAdmin WHERE id = :id');

		$q->execute([
			'id'		=> $id,
			'isAdmin'	=> (int)$isAdmin
		]);
	}
}