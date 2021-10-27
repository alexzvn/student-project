<?php include_view('layouts.header'); ?>

<?php $user = $order->user(); ?>

<div class="container mx-auto min-h-screen py-20">
    <div class="card shadow-md w-full max-w-4xl mx-auto mt-10">
        <div class="card-body bg-white">
            <h1 class="text-xl font-semibold">
                <a href="/manager/orders" class="btn btn-outline btn-sm">◀︎ back</a>
                List all Order
            </h1>

            <div class="mt-5">
                <?php include_view('layouts.alert') ?>
            </div>

            <p><strong>User:</strong> <?= $user->name ?></p>
            <p><strong>Address:</strong> <?= empty($user->address) ? '-/-' : $user->address ?></p>

            <?php include_view('components.orders', ['items' => $order->products()]) ?>
        </div>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
