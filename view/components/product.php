<div class="card w-full border border-yellow-300 shadow hover:shadow-lg transition-shadow duration-200">
    <div>
        <img class="object-cover w-full max-h-70" src="<?= e($product->avatar) ?>" alt="<?= e($product->name) ?>">
    </div>
    <div class="card-body bg-white p-4 pt-3">
        <p class="font-semibold text-red-500">
            <span class="text-gray-600 font-normal">Price:</span> $<?= e(number_format($product->price, 2)) ?>
            <span class="text-gray-400 font-normal text-xs">✦</span>
            <span class="text-gray-400 font-normal"><?= $product->kind ? e(ucfirst($product->kind)) : '' ?></span>
        </p>

        <a href="/products/<?= e($product->id) ?>" class="font-medium text-lg mt-1"><?= e($product->name) ?></a>

        <div class="flex justify-between mt-5">
            <a href="/products/<?= e($product->id) ?>/cart" class="btn btn-sm btn-primary btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </a>

            <a href="/products/<?= e($product->id) ?>"class="btn btn-sm btn-outline">See more</a>
        </div>
    </div>
</div>
