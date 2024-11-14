<form method="POST" action="<?= $url ?>">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= $type == 'edit' ? $user['username'] : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= $type == 'edit' ? $user['email'] : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" value="">
    </div>
    <a href="/user" class="btn btn-warning btn-sm text-white">Back</a>
    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>