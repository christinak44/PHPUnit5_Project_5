<?php
namespace App\Model;
use App\Exception\ApiException;

class Entry
{
    protected $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    public function getEntries()
    {
        $sql = $this->db->prepare(
            'SELECT * FROM  ORDER BY id'
        );
        $sql->execute();
        $entries = $sql->fetchAll();
        if (empty($entries)) {
            throw new ApiException(ApiException:ENTRY_NOT_FOUND, 404);
        }
        return $entries;
    }
    public function getEntry($entry_id)
    {
        $sql = $this->db->prepare(
            'SELECT * FROM  WHERE id=:id'
        );
        $sql->bindParam('id', $entry_id);
        $sql->execute();
        $entry = $sql->fetch();
        if (empty($entries)) {
            throw new ApiException(ApiException:ENTRY_NOT_FOUND, 404);
        }
        return $entry;
    }
    public function createEntry($data)
    {
        if (empty($data['title']) || empty($data['date']) || empty($data['body'])) {
            throw new ApiException(ApiException:ENTRY_INFO_REQUIRED);
        }
        $sql = $this->db->prepare(
            'INSERT INTO (title, date, body) VALUES(:title, :date, :body)'
        );
        $sql->bindParam('title', $data['title']);
        $sql->bindParam('date', $data['date']);
        $sql->bindParam('date', $data['body']);
        $sql->execute();
        if ($sql->rowCount()<1) {
            throw new ApiException(ApiException:ENTRY_CREATION_FAILED);
        }
        return $this->getEntry($this->db->lastInsertId());
    }
    public function updateEntry($data)
    {
        if (empty($data['entry_id']) || empty($data['title']) || empty($data['date']) || empty($data['body'])) {
            throw new ApiException(ApiException:ENTRY_INFO_REQUIRED);
        }
        $sql = $this->db->prepare(
            'UPDATE  SET title=:title, date=:date WHERE id=:id'
        );
        $sql->bindParam('title', $data['title']);
        $sql->bindParam('date', $data['date']);
        $sql->bindParam('date', $data['body']);
        $sql->bindParam('id', $data['entry_id']);
        $sql->execute();
        if ($sql->rowCount()<1) {
            throw new ApiException(ApiException:ENTRY_UPDATE_FAILED);
        }
        return $this->getEntry($data['entry_id']);
    }
    public function deleteEntry($entry_id)
    {
        $this->getEntry($entry_id);
        $sql = $this->db->prepare(
            'DELETE FROM  WHERE id=:id'
        );
        $sql->bindParam('id', $entry_id);
        $sql->execute();
        if ($sql->rowCount()<1) {
            throw new ApiException(ApiException:ENTRY_DELETE_FAILED);
        }
        return ['message' => 'The entry was deleted'];
    }
}
