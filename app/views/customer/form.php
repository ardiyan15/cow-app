<form method="POST" action="<?= $url ?>">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $type == 'edit' ? $customer['first_name'] : '' ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="<?= $type == 'edit' ? $customer['first_name'] : '' ?>">
    </div>
    <a href="/customer" class="btn btn-warning btn-sm text-white">Back</a>
    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>