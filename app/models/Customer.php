<?php

require_once __DIR__ . '/../../core/Model.php';
class Customer extends Model
{
    public function getCustomers()
    {
        $query = "SELECT * FROM customers";
        $prepareResult = pg_prepare($this->db, "select_customers_query", $query);
        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }
        $executeResult = pg_execute($this->db, "select_customers_query", []);

        if (!$executeResult) {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }

        $customers = pg_fetch_all($executeResult);

        return $customers;
    }

    public function save($first_name, $last_name)
    {
        $query = "INSERT INTO customers (first_name, last_name) VALUES ($1, $2)";

        $prepareResult = pg_prepare($this->db, "insert_customer_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "insert_customer_query", array($first_name, $last_name));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }

    public function findById($id)
    {
        $query = "SELECT * FROM customers WHERE id = $1";

        $prepareResult = pg_prepare($this->db, "select_customer_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "select_customer_query", array($id));

        if (!$executeResult) {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }

        $customer = pg_fetch_assoc($executeResult);

        return $customer;
    }

    public function update($first_name, $last_name, $id)
    {
        $query = "UPDATE customers SET first_name = $1, last_name = $2 WHERE id = $3";

        $prepareResult = pg_prepare($this->db, "update_customer_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        // Execute the query with parameters
        $executeResult = pg_execute($this->db, "update_customer_query", array($first_name, $last_name, $id));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM customers WHERE id = $1";

        $prepareResult = pg_prepare($this->db, "delete_customer_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "delete_customer_query", array($id));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }
}
