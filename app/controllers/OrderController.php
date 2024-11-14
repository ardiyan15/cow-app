<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class OrderController extends Controller
{
    private $orderModel;
    private $customerModel;
    public function __construct()
    {
        AuthMiddleware::is_authenticated();
        $this->orderModel = new Order();
        $this->customerModel = new Customer();
    }
    public function index()
    {
        $orders = $this->orderModel->getOrders();
        $this->renderView('order/index', ['orders' => $orders]);
    }

    public function detail()
    {
        $id = $this->_getIdParam('detail');
        $order = $this->orderModel->findById($id);
        $this->renderView('order/detail', ['order' => $order]);
    }

    public function create()
    {
        $url = '/order/store';
        $type = 'create';
        $customers = $this->customerModel->getCustomers();
        $this->renderView('/order/form', ['url' => $url, 'type' => $type, 'customers' => $customers]);
    }

    public function store()
    {
        $order_name = $_POST['order_name'] ?? '';
        $customer_id = $_POST['customer'] ?? '';

        $date = date_create();
        $created_at = date_format($date, "Y-m-d");

        if (empty($order_name)) {
            echo "Order Name are required.";
            return;
        } else if (empty($created_at)) {
            echo "Created at are required.";
            return;
        } else if (empty($customer_id)) {
            echo "Customer are required.";
            return;
        }

        $result = $this->orderModel->save($order_name, $created_at, $customer_id);

        if ($result) {
            echo "Order added successfully!";
        } else {
            echo "Failed to add order.";
        }
    }

    public function edit()
    {
        $id = $this->_getIdParam('edit');
        $order = $this->orderModel->findById($id);
        $customers = $this->customerModel->getCustomers();

        $url = '/order/update/' . $order['id'];
        $type = 'edit';

        $this->renderView('/order/form', ['order' => $order, 'customers' => $customers, 'url' => $url, 'type' => $type]);
    }

    public function update()
    {
        $id = $this->_getIdParam('update');

        $order_name = $_POST['order_name'] ?? '';
        $customer = $_POST['customer'] ?? '';

        if (empty($order_name)) {
            echo "Order Name are required.";
            return;
        } else if (empty($customer)) {
            echo "Customer are required.";
            return;
        }

        $result = $this->orderModel->update($order_name, $customer, $id);

        if ($result) {
            echo "Order update successfully!";
        } else {
            echo "Failed to update order.";
        }
    }

    public function delete()
    {
        $id = $this->_getIdParam('delete');
        $result = $this->orderModel->delete($id);

        if ($result) {
            echo "Order deleted successfully!";
        } else {
            echo "Failed to delete order.";
        }
    }

    private function _getIdParam($page)
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uriParts = explode('/', $uri);

        if (isset($uriParts[0]) && $uriParts[0] === 'order' && isset($uriParts[1]) && $uriParts[1] === $page) {
            $id = isset($uriParts[2]) ? (int)$uriParts[2] : null;
            return $id;
        } else {
            return null;
        }
    }
}
