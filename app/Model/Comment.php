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
	const INVALID_COMMENT = "Le commentaire n'est pas valide";

/*Requetes SQL*/
  	/**
     * récupère les commentaires d'un article à partir de l'id de l'article.
     * @param int $id
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
            $comment->hydrate($comment, $result);
            $comments[] = $comment;
       	}

    	return $comments;
	}

	public function find($id) {        
        $q = $this->db->prepare('SELECT id, chapterId, author, comment, DATE_FORMAT(commentedAt, \'%d/%m/%Y %Hh%i\'), isReported, enum AS commentedat FROM comments WHERE id = :id');
        $q->execute([
        	'id' => $id
        ]);

        $data = $q->fetch();
        if(!$data) {
        	die("il y a une erreur");
        }
        
        $comment = new Comment();

        if(!$data) {
			$this->errors[] = self::INVALID_PAGE;
		}

		$comment->hydrate($comment, $data);

        return $comment;
    }

	/**
     * insère les commentaires dans la db à partir de l'id de l'article.
     * @param int $id
     */
    public function save(Comment $comment) {
        if(count($this->errors) === 0) {
        
            $q = $this->db->prepare('INSERT INTO comments(chapterId, author, comment, commentedAt) 
            	VALUES (:chapterId, :author, :comment, NOW())');

            $comment = $q->execute([
                ':chapterId'	=> $comment->getChapterId(),
                ':author'		=> $comment->getAuthor(), 
                ':comment'		=> $comment->getComment()
            ]);

            return $comment;

           /* $this->hydrate($this, $data);//A QUOI SERT CE hydrate?????

        	return $this;*/
        }
    }

    /**
     * signalement d'un commentaire page article
     * @param int $id
     * @return bool
     */
	public function reported($id) {
		$q = $this->db->prepare('UPDATE comments SET isReported = 1, enum = "" WHERE id = :id');
		$reported = $q->execute([
			'id' => $id
		]);
		
		return $reported;
	}

	/**
     * Récuperation des commentaires signalés
     */	
	public function allCommentsReported() {
	    $q = $this->db->prepare('SELECT id, chapterId, author, comment, DATE_FORMAT(commentedAt, \'%d/%m/%Y à %Hh%i\') AS commented, isReported FROM comments WHERE isReported = 1 ORDER BY commentedAt DESC');
	    $q->execute(['']);

	    $results = $q->fetchAll(\PDO::FETCH_ASSOC);

	    if(!$results) {
	    	return [];
	    }

	    foreach($results as $result) {
            $comment = new Comment();

            $comment->hydrate($comment, $result);
            
            $comments[] = $comment;
       	}

    	return $comments;
	}

	/**
     * Modification du commentaires signalés
     */
	public function update(Comment $comment, $id) {
		$q = $this->db->prepare('UPDATE comments SET author= :author, comment = :comment, isReported = :isReported, enum = :enum WHERE id = :id');
		
		$q->execute([
			'id' 		=> $id,
			'author'	=> $comment->getAuthor(),
			'comment'	=> $comment->getComment(),
			'isReported'=> 0,
			'enum'		=> "confirmed"
		]);
		
		return $q;
	}

	/**
     * Suppression du commentaires signalés
     */
	public function delete($id) {
		$q = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$deleted = $q->execute([
			'id' => $id
		]);
	}

/**
     * Confirmation du commentaires signalés
     */
	public function confirm($id) {
		$q = $this->db->prepare('UPDATE comments SET isReported = 0, enum = "confirmed" WHERE id = :id');
		$updated = $q->execute([
			'id' => $id
		]);
	}

	/**
     * Validation du commentaires signalés
     */

/*GETTERS*/
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


/*SETTERS*/
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
		if (!is_string($author) || empty($author) || strlen($author) > 20) {
	      $this->errors[] = self::INVALID_AUTHOR;
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