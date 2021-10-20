<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen px-20">
    <div class="card shadow-md w-full max-w-6xl mx-auto mt-10">
        <div class="card-body bg-white">
            <h1 class="text-xl font-semibold">
                List all products
                <a href="/manager/products/create" class="btn btn-outline btn-sm btn-success">create</a>
            </h1>

            <div class="mt-5">
                <?php include_view('layouts.alert') ?>
            </div>

            <table class="table w-full table-zebra mt-5">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Kind</th>
                    <th>Brand</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($products as $product): ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= e($product->name) ?></td>
                            <td> $<?= number_format($product->price) ?></td>
                            <td><?= e(ucfirst($product->kind ?? '-/-')) ?></td>
                            <td><?= e(ucfirst($product->brand ?? '-/-')) ?></td>
                            <td>
                                <div class="flex">
                                    <a href="/manager/products/<?= $product->id ?>" class="btn btn-outline btn-circle btn-sm mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a href="/manager/products/<?= $product->id ?>/delete" class="btn btn-outline btn-error btn-circle btn-sm">
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
