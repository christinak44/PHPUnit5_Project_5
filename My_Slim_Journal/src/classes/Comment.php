<?php
namespace App\Classes;
use App\Exception\ApiException;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   //public $timestamps = false;
   protected $table = 'comments';
   //protected $fillable = ['commenter','comment'];
}
/*{
    protected $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    public function getReviewsByCourseId($course_id)
    {
        if (empty($course_id)) {
            throw new ApiException(ApiException::REVIEW_INFO_REQUIRED);
        }
        $statement = $this->db->prepare('SELECT * FROM reviews WHERE course_id=:course_id');
        $statement->bindParam('course_id', $course_id);
        $statement->execute();
        $reviews = $statement->fetchAll();
        if (empty($reviews)) {
            throw new ApiException(ApiException::REVIEW_NOT_FOUND, 404);
        }
        return $reviews;
    }
    public function getReview($review_id)
    {
        if (empty($review_id)) {
            throw new ApiException(ApiException::REVIEW_INFO_REQUIRED);
        }
        $statement = $this->db->prepare('SELECT * FROM reviews WHERE id=:id');
        $statement->bindParam('id', $review_id);
        $statement->execute();
        $review = $statement->fetch();
        if (empty($review)) {
            throw new ApiException(ApiException::REVIEW_NOT_FOUND, 404);
        }
        return $review;
    }
    public function createReview($data)
    {
        if (empty($data['course_id']) || empty($data['rating']) || empty($data['comment'])) {
            throw new ApiException(ApiException::REVIEW_INFO_REQUIRED);
        }
        $statement = $this->db->prepare('INSERT INTO reviews (course_id, rating, comment) VALUES (:course_id, :rating, :comment)');
        $statement->bindParam('course_id', $data['course_id']);
        $statement->bindParam('rating', $data['rating']);
        $statement->bindParam('comment', $data['comment']);
        $statement->execute();
        if ($statement->rowCount()<1) {
            throw new ApiException(ApiException::REVIEW_CREATION_FAILED);
        }
        return $this->getReview($this->db->lastInsertId());
    }
    public function updateReview($data)
    {
        $this->getReview($data['review_id']);
        $statement = $this->db->prepare('UPDATE reviews SET rating=:rating, comment=:comment WHERE id=:id');
        $statement->bindParam('id', $data['review_id']);
        $statement->bindParam('rating', $data['rating']);
        $statement->bindParam('comment', $data['comment']);
        $statement->execute();
        if ($statement->rowCount()<1) {\
            throw new ApiException(ApiException::REVIEW_UPDATE_FAILED);
        }
        return $this->getReview($data['review_id']);
    }
    public function deleteReview($review_id)
    {
        $this->getReview($review_id);
        $statement = $this->db->prepare('DELETE FROM reviews WHERE id=:id');
        $statement->bindParam('id', $review_id);
        $statement->execute();
        if ($statement->rowCount()<1) {
            throw new ApiException(ApiException::REVIEW_DELETE_FAILED);
        }
        return ['message' => 'The review was deleted.'];
    }
}*/
