<div class="d-flex justify-content-center">
    <form action="/base/login" method="POST">
        <div class="card shadow" style="width: 30em;">
            <div class="card-body">
                <p>Please Enter Your Username and Password</p>
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn btn-primary btn-sm mt-3">Login</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $(".navbar").hide()
    })
</script>