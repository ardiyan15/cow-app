<div class="col-6">
    <form method="POST" action="<?= $url ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Order Name</label>
            <input type="text" name="order_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $type == 'edit' ? $order['order_name'] : '' ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Select Customer</label>
            <select name="customer" id="" required class="form-control">
                <option value="">-- Select Customer</option>
                <?php foreach ($customers as $customer): ?>
                    <?php if ($customer['id'] == $order['customer_id']): ?>
                        <option value="<?= $customer['id'] ?>" selected><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></option>
                    <?php else: ?>
                        <option value="<?= $customer['id'] ?>"><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <a href="/customer" class="btn btn-warning btn-sm text-white">Back</a>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>
</div>