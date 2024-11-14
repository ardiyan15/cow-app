<?php

require_once __DIR__ . '/../../core/Model.php';

class User extends Model
{
    public function getUsers()
    {
        $result = pg_query($this->db, "SELECT * FROM users ORDER BY id DESC");
        $users = pg_fetch_all($result);
        return $users;
    }

    public function save($username, $email, $password)
    {
        $query = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";

        $prepareResult = pg_prepare($this->db, "insert_user_query", $query);

        if (!$prepareResult) {
            // Handle query preparation failure
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "insert_user_query", array($username, $email, $password));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }

    public function findUser($username)
    {
        $query = "SELECT * FROM users WHERE username = $1 LIMIT 1";
        $prepareResult = pg_prepare($this->db, "select_user_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "select_user_query", array($username));

        if (!$executeResult) {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }

        $customer = pg_fetch_assoc($executeResult);
        return $customer;
    }
}
