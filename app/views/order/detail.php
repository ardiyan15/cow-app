<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= $order['order_name'] ?></h5>
        <p class="card-text"><?= $order['created_at'] ?></p>
        <p class="card-text"><?= $order['first_name'] ?></p>
        <a href="/order" class="btn btn-warning btn-sm text-white">Back</a>
    </div>
</div>