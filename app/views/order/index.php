<h1 class="mb-3">Data Customer</h1>
<a href="/order/create" class="mb-3 btn btn-primary btn-sm">Create Order</a>
<table id="orderTable" class="datatable table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Order Name</th>
            <th scope="col">Created Date</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $number = 1; ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <th scope="row"><?= $number ?></th>
                <td>
                    <a href="/order/detail/<?= $order['id'] ?>">
                        <?= $order['order_name'] ?>
                    </a>
                </td>
                <td><?= $order['created_at'] ?></td>
                <td><?= $order['first_name'] ?></td>
                <td>
                    <form action="/order/delete/<?= $order['id'] ?>" method="POST">
                        <a href="/order/edit/<?= $order['id'] ?>" class="btn btn-info btn-sm text-white">Edit</a>
                        <button type="submit" class="delete-order btn btn-danger btn-sm text-white">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $number++ ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#orderTable').DataTable();
        $(".delete-order").on('click', function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to delete this order?")) {
                $(this).closest("form").submit();
            }
        });
    });
</script>