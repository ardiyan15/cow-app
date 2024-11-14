<?php

require_once __DIR__ . '/../../core/Model.php';
class Order extends Model
{
    public function getOrders()
    {
        $query = "SELECT orders.id, orders.order_name, orders.created_at, customers.first_name
        FROM orders
        JOIN customers ON orders.customer_id = customers.id
        ORDER BY orders.id DESC";

        $prepareResult = pg_prepare($this->db, "select_orders_customers_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "select_orders_customers_query", []);

        if (!$executeResult) {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
        $customers = pg_fetch_all($executeResult);

        return $customers;
    }

    public function findById($id)
    {
        $query = "SELECT orders.id, orders.order_name, orders.created_at, orders.customer_id, customers.first_name 
        FROM orders 
        JOIN customers ON orders.customer_id = customers.id 
        WHERE orders.id = $1";

        $prepareResult = pg_prepare($this->db, "select_order_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "select_order_query", array($id));

        if (!$executeResult) {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
        $order = pg_fetch_assoc($executeResult);

        return $order;
    }

    public function save($order_name, $created_at, $customer_id)
    {
        $query = "INSERT INTO orders (order_name, created_at, customer_id) VALUES ($1, $2, $3)";

        $prepareResult = pg_prepare($this->db, "insert_order_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }
        $executeResult = pg_execute($this->db, "insert_order_query", array($order_name, $created_at, $customer_id));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }

    public function update($order_name, $customer_id, $id)
    {
        $query = "UPDATE orders SET order_name = $1, customer_id = $2 WHERE id = $3";

        $prepareResult = pg_prepare($this->db, "update_order_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "update_order_query", array($order_name, $customer_id, $id));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM orders WHERE id = $1";

        $prepareResult = pg_prepare($this->db, "delete_order_query", $query);

        if (!$prepareResult) {
            echo "Error in preparing query: " . pg_last_error($this->db);
            return false;
        }

        $executeResult = pg_execute($this->db, "delete_order_query", array($id));

        if ($executeResult) {
            return true;
        } else {
            echo "Error executing query: " . pg_last_error($this->db);
            return false;
        }
    }
}
