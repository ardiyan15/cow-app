<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class CustomerController extends Controller
{

    private $recordsPerPage = 10;
    private $customerModel;
    public function __construct()
    {
        AuthMiddleware::is_authenticated();
        $this->customerModel = new Customer();
    }
    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1);

        $startFrom = ($page - 1) * $this->recordsPerPage;

        $results = $this->customerModel->getCustomers($startFrom, $this->recordsPerPage);

        $this->renderView('customer/index', ['customers' => $results]);
    }

    public function detail()
    {
        $id = $this->_getIdParam('detail');
        $get_customer = $this->customerModel->findById($id);

        $title = "Detail Page";
        $this->renderView('customer/detail', ['title' => $title, 'customer' => $get_customer]);
    }

    public function create()
    {
        $url = '/customer/store';
        $type = 'create';
        $this->renderView('/customer/form', ['url' => $url, 'type' => $type]);
    }

    public function store()
    {
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';

        if (empty($first_name)) {
            echo "First Name are required.";
            return;
        } else if (empty($last_name)) {
            echo "Last Name are required.";
            return;
        }

        $result = $this->customerModel->save($first_name, $last_name);

        if ($result) {
            echo "Customer added successfully!";
        } else {
            echo "Failed to add customer.";
        }
    }

    public function edit()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        $uriParts = explode('/', $uri);

        if (isset($uriParts[0]) && $uriParts[0] === 'customer' && isset($uriParts[1]) && $uriParts[1] === 'edit') {
            $id = isset($uriParts[2]) ? (int)$uriParts[2] : null;

            $get_customer = $this->customerModel->findById($id);

            $url = '/customer/update/' . $get_customer['id'];
            $type = 'edit';
            $this->renderView('/customer/form', ['customer' => $get_customer, 'url' => $url, 'type' => $type]);
        }
    }

    public function update()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uriParts = explode('/', $uri);

        if (isset($uriParts[0]) && $uriParts[0] === 'customer' && isset($uriParts[1]) && $uriParts[1] === 'update') {
            $id = isset($uriParts[2]) ? (int)$uriParts[2] : null;
        }

        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';

        if (empty($first_name)) {
            echo "First Name are required.";
            return;
        } else if (empty($last_name)) {
            echo "Last Name are required.";
            return;
        }

        $result = $this->customerModel->update($first_name, $last_name, $id);

        if ($result) {
            echo "Customer update successfully!";
        } else {
            echo "Failed to update customer.";
        }
    }

    public function delete()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uriParts = explode('/', $uri);

        if (isset($uriParts[0]) && $uriParts[0] === 'customer' && isset($uriParts[1]) && $uriParts[1] === 'delete') {
            $id = isset($uriParts[2]) ? (int)$uriParts[2] : null;
        }

        $result = $this->customerModel->delete($id);

        if ($result) {
            echo "Customer deleted successfully!";
        } else {
            echo "Failed to delete customer.";
        }
    }

    private function _getIdParam($page)
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uriParts = explode('/', $uri);

        if (isset($uriParts[0]) && $uriParts[0] === 'customer' && isset($uriParts[1]) && $uriParts[1] === $page) {
            $id = isset($uriParts[2]) ? (int)$uriParts[2] : null;
            return $id;
        } else {
            return null;
        }
    }
}
