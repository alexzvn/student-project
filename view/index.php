<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen py-24">

    <?php include_view('components.search') ?>

    <div class="card w-full rounded-t-md shadow-sm mt-5">
        <div class="card-header">
            <h2 class="font-semibold text-lg uppercase text-center">All products</h2>
        </div>
        <div class="card-body bg-white">
            <?php include_view('layouts.alert') ?>

            <div class="grid gap-2 gap-y-7 grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 mt-3">
                <?php
                    foreach ($products as $product) include_view('components.product', compact('product'));
                ?>
            </div>
        </div>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
