<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $host = "localhost";  // Database host
        $port = "5432";       // PostgreSQL port (default is 5432)
        $dbname = "cow-play"; // Database name
        $user = "postgres";   // Your PostgreSQL username (default is usually 'postgres')
        $password = "root";       // Your PostgreSQL password (default is empty for local setups)
    
        // Create connection string
        $connectionString = "host=$host port=$port dbname=$dbname user=$user password=$password";
    
        // Connect to PostgreSQL
        $this->db = pg_connect($connectionString);
    
        // Check connection
        if (!$this->db) {
            die("Connection failed: " . pg_last_error());
        }
    }
    
}
