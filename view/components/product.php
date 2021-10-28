<div class="card w-full border border-yellow-300 shadow hover:shadow-lg transition-shadow duration-200">
    <div class="h-full grid place-items-center">
        <img class="object-cover w-full max-h-70" src="<?= e($product->avatar) ?>" alt="<?= e($product->name) ?>">
    </div>
    <div class="card-body bg-white p-4 pt-3">
        <p class="font-semibold text-red-500">
            <span class="text-gray-600 font-normal">Price:</span> $<?= e(number_format($product->price, 2)) ?>
            <span class="text-gray-400 font-normal text-xs">✦</span>
            <span class="text-gray-400 font-normal"><?= $product->kind ? e(ucfirst($product->kind)) : '' ?></span>
        </p>

        <p class="font-medium text-lg mt-1"><?= e($product->name) ?></p>

        <a href="/products/<?= e($product->id) ?>/add" class="btn btn-sm btn-success btn-outline mt-5">Add to cart</a>
    </div>
</div>
