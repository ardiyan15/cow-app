<h1 class="mb-3">Data Customer</h1>
<a href="/customer/create" class="mb-3 btn btn-primary btn-sm">Create Customer</a>
<table id="customerTable" class="datatable table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $number = 1; ?>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <th scope="row"><?= $number ?></th>
                <td>
                    <a href="/customer/detail/<?= $customer['id'] ?>">
                        <?= $customer['first_name'] ?>
                    </a>
                </td>
                <td><?= $customer['last_name'] ?></td>
                <td>
                    <form action="/customer/delete/<?= $customer['id'] ?>" method="POST">
                        <a href="/customer/edit/<?= $customer['id'] ?>" class="btn btn-info btn-sm text-white">Edit</a>
                        <button type="submit" class="delete-customer btn btn-danger btn-sm text-white">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $number++ ?>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- <nav>
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav> -->

<script>
    $(document).ready(function() {
        $('#customerTable').DataTable();
        $(".delete-customer").on('click', function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to delete this customer?")) {
                $(this).closest("form").submit();
            }
        });
    });
</script>