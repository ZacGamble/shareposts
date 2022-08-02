<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts()
    {
        $this->db->query('SELECT *,
                          posts.id AS postId,
                          users.id AS userId,
                          count(likes.id) as likes,
                          posts.created_at AS postCreated,
                          users.created_at AS userCreated
                          FROM posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          LEFT JOIN likes
                          ON likes.postId = posts.id
                          GROUP BY posts.id
                          ORDER BY posts.created_at DESC');

        $results = $this->db->resultSet();
        foreach ($results as &$item) {
            $item->postCreated = substr($item->postCreated, 0, 10);
        }
        unset($item);
        return $results;
    }

    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, body = :body, likes = :likes WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':likes', $data['likes']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function likePost($post)
    {

        $this->db->query('INSERT INTO likes (user_id, postId) 
                        SELECT :user_id, :postId FROM posts
                        WHERE EXISTS(
                        SELECT id FROM posts WHERE id = :postId)
                        AND NOT EXISTS(
                        SELECT id FROM likes
                        WHERE user_id = :user_id and postId = :postId)
                        LIMIT 1');
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':postId', $post->id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
