<?php
namespace App\Model;

use PDO;

class Comment extends Model
{
	private $id;
	private $chapterId;
	private $author;
	private $comment;
	private $commented;
	private $isReported;
	private $enum;

	const INVALID_AUTHOR = "L'auteur n'est pas valide";
	const INVALID_LENGTH = "La longueur du champ saisi n'est pas valide";
	const INVALID_COMMENT = "Le commentaire n'est pas valide";

	/**
	 * List comments
     */
	public function allComments($id) {
		$q = $this->db->prepare('SELECT id, chapterId, author, comment, DATE_FORMAT(commentedAt, \'%d/%m/%Y à %Hh%i\') AS commented, isReported, enum FROM comments WHERE chapterId = ? ORDER BY commentedAt DESC');
		$q->execute(array($id));

		$results = $q->fetchAll(\PDO::FETCH_ASSOC);

		if(!$results) {
			return [];
		}

		foreach($results as $result) {
			$comment = new Comment();
			$comment->hydrate($result);
			$comments[] = $comment;
		}

		return $comments;
	}

	/**
	 * Find a chapter
	 * @param int $id
     */
	public function find($id) {        
		$q = $this->db->prepare('SELECT id, chapterId, author, comment, DATE_FORMAT(commentedAt, \'%d/%m/%Y %Hh%i\'), isReported, enum AS commentedat FROM comments WHERE id = :id');
		$q->execute([
			'id' => $id
		]);

		$data = $q->fetch();

		if(!$data) {
			$this->errors[] = self::INVALID_PAGE;
		}
		
		$comment = new Comment();

		$comment->hydrate($data);

		return $comment;
	}

	/**
	* Save the comment
	*/
	public function save() {
		if($this->hasErrors()) {
			return ;
		}
		
		$q = $this->db->prepare('INSERT INTO comments(chapterId, author, comment, commentedAt) 
			VALUES (:chapterId, :author, :comment, NOW())');

		return $q->execute([
			':chapterId'	=> $this->getChapterId(),
			':author'		=> $this->getAuthor(), 
			':comment'		=> $this->getComment()
		]);
	}

	/**
	* Reported a comment
	* @param int $id
	*/
	public function report($id) {
		$q = $this->db->prepare('UPDATE comments SET isReported = 1, enum = "" WHERE id = :id');
		$report = $q->execute([
			'id' => $id
		]);

		return $report;
	}

	/**
	* update reported comment
	* @param int $id
	*/
	public function update($id) {
		$q = $this->db->prepare('UPDATE comments SET author = :author, comment = :comment, isReported = :isReported, enum = :enum WHERE id = :id');
		
		return $q->execute([
			'id' 		=> $id,
			'author'	=> $this->getAuthor(),
			'comment'	=> $this->getComment(),
			'isReported'=> 0,
			'enum'		=> "confirmed"
		]);

	}

	/**
	 * Delete a comment
	 * @param int $id
     */
	public function delete($id) {
		$q = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$deleted = $q->execute([
			'id' => $id
		]);
	}

	/**
	* Confirm reported comment
	* @param int $id
	*/
	public function confirm($id) {
		$q = $this->db->prepare('UPDATE comments SET isReported = 0, enum = "confirmed" WHERE id = :id');
		$q->execute([
			'id' => $id
		]);

	}

	public function getId(): ?int {
		return $this->id; 
	}

	public function getChapterId(): ?int {
		return $this->chapterId; 
	}

	public function getAuthor(): ?string {
		return $this->author; 
	}

	public function getComment(): ?string {
		return $this->comment; 
	} 

	public function getCommented(): ?string {
		return $this->commented; 
	}

	public function getIsReported()	{
		return !! $this->isReported; 
	}

	public function getEnum() : ?string {
		return $this->enum;
	}


	public function setId($id) {
		$id = (int)$id;
		if($id > 0) {
			$this->id = $id;
		}
	}

	public function setChapterId(int $chapterId) {
		$chapterId = (int)$chapterId;
		if($chapterId > 0) {
			$this->chapterId = $chapterId;
		}
	}

	public function setAuthor(string $author) {
		if (!is_string($author) || empty($author) ) {
		  $this->errors[] = self::INVALID_AUTHOR;
		}
		else if(strlen($author) > 20) {
			 $this->errors[] = self::INVALID_LENGTH;
		}
		else {
		  $this->author = $author;
		}
	}

	public function setComment(string $comment) {
		if(!is_string($comment) || empty($comment) || strlen($comment) > 150) {
			$this->errors[] = self::INVALID_COMMENT;
		} else {
			$this->comment = $comment;
		}
	}
	
	public function setCommented(string $commented) {
		$this->commented = $commented;
	}

	public function setIsReported($isReported)
	{
		$isReported = (int)$isReported;
		if($isReported === null || $isReported === 1) {
			$this->isReported = $isReported;
		}
	}

	public function setEnum(string $enum)
	{
		$this->enum = $enum;
	}
}