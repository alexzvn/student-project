<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen grid place-items-center">
    <div class="card shadow-lg w-full max-w-3xl">
        <div class="card-body bg-white text-center">
            <h1 class="font-thin text-5xl"><strong>#<?= $order->id ?></strong> Order placed</h1>
            <h2 class="mt-3 font-semibold text-xl text-warning">Please wait us to confirm your order!</h2>

            <div class="divider text-gray-600 mt-5">Order details</div>
            <?php include_view('components.orders', ['items' => $order->products()]) ?>
        </div>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
