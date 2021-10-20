<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen px-20">
    <div class="card shadow-md w-full max-w-6xl mx-auto mt-10">
        <div class="card-body bg-white">
            <h1 class="text-xl font-semibold">
                List all Order
            </h1>

            <div class="mt-5">
                <?php include_view('layouts.alert') ?>
            </div>

            <table class="table w-full table-zebra mt-5">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($orders as $order): $user = $order->user(); ?>
                        <tr>
                            <th>#<?= $i++ ?></th>
                            <td><?= e($user->name) ?></td>
                            <td><?= e($user->address) ?></td>
                            <td>
                                <div class="flex">
                                    <a href="/manager/orders/<?= $order->id ?>" class="btn btn-outline btn-circle btn-sm mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="/manager/orders/<?= $order->id ?>/delete" class="btn btn-outline btn-error btn-circle btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
