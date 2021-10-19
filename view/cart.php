<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen py-24">

    <div class="card w-full rounded-t-md shadow-sm mt-5 max-w-4xl mx-auto">
        <div class="card-header">
            <h2 class="font-semibold text-lg uppercase text-center">Cart Items</h2>
        </div>
        <form action="/cart/checkout" method="POST" class="card-body bg-white">
            <?php include_view('layouts.alert') ?>

            <table class="table w-full table-zebra mt-3">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($items as $item): [$product, $amount] = $item; ?>
                    <tr>
                        <th><?= $i++ ?></th>
                        <td><?= e($product->name) ?></td>
                        <td>$<?= e(number_format($product->price, 2)) ?></td>
                        <td><input name="item[<?= $product->id ?>]" type="number" min="1" max="99" step="1" placeholder="username" class="input input-sm" style="max-width: 5rem;" value="<?= $amount ?>"></td>
                        <td>
                            <a href="<?= "/cart/$product->id/remove" ?>" class="btn btn-circle btn-outline btn-error btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="flex justify-between mt-5">
                <button class="btn btn-success btn-outline">◀︎ Continue Shopping</button>
                <button class="btn btn-primary">Checkout & Order</button>
            </div>
        </form>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
