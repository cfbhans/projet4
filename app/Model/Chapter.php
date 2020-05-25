<?php
namespace App\Model;

class Chapter extends Model
{
	private $id;
	private $title;
	private $content;
	private $createdat;
	

	//Constante relatives aux erreurs possibles rencontrées lors de l'execution de la méthode
	const INVALID_TITLE = "Le titre n'est pas valide";
	const INVALID_CONTENT = "Le contenu du chapitre n'est pas valide";
	const INVALID_PAGE = "La page demandée n'est pas accessible";


	/**
	 * List chapters
     * @return array
     */
	public function all(): ?array {
		
		$chapters = [];
		$q = $this->db->query('SELECT id, title, content, DATE_FORMAT(createdAt, \'%d/%m/%Y %Hh%i\') AS createdat FROM chapters');

		$results = $q->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($results as $result) {
			$chapter = new Chapter();
			$chapter->hydrate($chapter, $result);
			$chapters[] = $chapter;
		}

		return $chapters;
	}

	/**
	 * Find a chapter
	 * @param int $id
     * @return array
     */
	public function find($id) {
		$q = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(createdAt, \'%d/%m/%Y %Hh%i\') AS createdat FROM chapters WHERE id = :id');
		$q->execute([
			'id' => $id
		]);

		$data = $q->fetch();

		if(!$data) {
			die("il y a une erreur de chapitre");
		}
		
		$chapter = new Chapter();

		if(!$data) {
			$this->errors[] = self::INVALID_PAGE;
		}

		$chapter->hydrate($chapter, $data);

		return $chapter;
	}
	
	/**
	 * Update a chapter
	 * @param Chapter $chapter
	 * @param int $id
     * @return string
     */
	public function update(Chapter $chapter, $id) {
		$q = $this->db->prepare('UPDATE chapters SET title = :title, content = :content, createdat = NOW() WHERE id = :id');
		
		$q->execute([
			':id' 		=> $id,
			':title'	=> $chapter->getTitle(),
			':content'	=> $chapter->getContent()
		]);
		
		return $q;
		
	}

	/**
	 * Create a new chapter
	 * @param Chapter $chapter
     * @return bool
     */
	public function createChapter(Chapter $chapter){
		$q = $this->db->prepare('INSERT INTO chapters(title, content, createdat) VALUES (:newPostTitle, :newPostContent, NOW())');

		$newChapter = $q->execute([
			':newPostTitle'		=> $chapter->getTitle(),
			':newPostContent'	=> $chapter->getContent()
		]);

		return $newChapter;
	}

	/**
	 * Delete a chapter
	 * @param Chapter $chapter
	 * @param int $id
     */
	public function delete($id) {
		$del = $this->db->prepare('DELETE FROM chapters WHERE id = :id');
		$delCom = $this->db->prepare('DELETE FROM comments WHERE chapterId = :chapterId');
		$del->execute([
			'id' => $id
		]);

		$delCom->execute([
			'chapterId' => $id
		]);


	}

	/**
	 * Limit the chapter's content
	 * @param Chapter $chapter
	 * @param int $id
	 * @return string
     */
	public function excerpt(string $content, int $limit = 200) {
		if (strlen($content) <= $limit) {
			return $content;
		}
		$lastSpace = strpos($content, ' ', $limit);
		return substr($content, 0, $lastSpace).'...';
	}

	public function getId(): ?int {
		return $this->id; 
	}

	public function getTitle(): ?string	{ 
		return $this->title; 
	}

	public function getContent() {
		if($this->content === null)	{
			return null;
		}

		return $this->content; 
	} 

	public function getCreatedat() {
		return $this->createdat; 
	}


	public function setId($id) {
		$id = (int)$id;

		if($id < 0 || !isset($id)) {
			$this->errors[] = self::INVALID_PAGE;
		} else {
			$this->id = $id;
		}
	}

	public function setTitle(string $title) {
		if(!is_string($title) || empty($title))	{
			$this->errors[] = self::INVALID_TITLE; //message d'erreur
		} else {
			$this->title = $title;
		}
	}

	public function setContent(string $content) {
		if(!is_string($content) || empty($content)) {
			$this->errors[] = self::INVALID_CONTENT;
		} else {
			$this->content = $content;
		}
	}

	public function setCreatedat($createdat) {
		$this->createdat = $createdat;
	}
	
}