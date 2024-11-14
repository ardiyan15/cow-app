<h1 class="mb-3">Data User</h1>
<a href="/user/create" class="mb-3 btn btn-primary btn-sm">Create User</a>
<table id="userTable" class="datatable table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Order Name</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php $number = 1; ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <th scope="row"><?= $number ?></th>
                <td>
                    <a href="/order/detail/<?= $user['id'] ?>">
                        <?= $user['username'] ?>
                    </a>
                </td>
                <td><?= $user['email'] ?></td>
            </tr>
            <?php $number++ ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
</script>