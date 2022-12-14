<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register a user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login user
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getUserPosts($id)
    {
        $this->db->query('SELECT p.*,
        u.name AS name,
        p.id AS postId,
        count(l.id) as likes,
        p.created_at AS postCreated,
        u.created_at AS userCreated
        FROM posts p
        INNER JOIN users u
        ON p.user_id = u.id
        LEFT JOIN likes l
        ON l.postId = p.id
        WHERE p.user_id = :id
        GROUP BY p.id
        ORDER BY p.created_at DESC');

        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        foreach ($results as &$item) {
            $item->postCreated = substr($item->postCreated, 0, 10);
        }
        unset($item);
        return $results;
    }
}
