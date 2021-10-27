<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen py-20">
    <div class="card shadow-md w-full max-w-2xl mx-auto mt-10">
        <form class="card-body bg-white" method="POST" enctype="multipart/form-data" action="/manager/products/<?= e($product->id) ?>/update">
            <h1 class="text-xl font-semibold mb-5">
                <a href="/manager/products" class="btn btn-outline btn-sm">◀︎ back</a>
                Modify product
            </h1>

            <div class="mt-5">
                <?php include_view('layouts.alert') ?>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Product name</span>
                </label> 
                <input type="text" name="name" placeholder="Product name" value="<?= e(input('name', $product->name)) ?>" class="input input-bordered" required>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Product price</span>
                    </label> 
                    <input type="number" min="00.00" name="price" placeholder="Product name" value="<?= e(input('price', $product->price)) ?>" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Type</span>
                    </label> 
                    <select id="type" name="kind" class="select select-bordered" data-type='<?= json_encode(config('categories')) ?>'>
                        <option value="">Select one</option>
                        <?php foreach (config('categories') as $type => $brands): ?>
                            <option value="<?= e($type) ?>" <?= $type === $product->kind ? 'selected' : '' ?>><?= e(ucfirst($type)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Brand</span>
                    </label>
                    <select id="brand" name="brand" class="select select-bordered">
                        <?php if ($product->kind): ?>
                            <option value="">Select one</option>
                            <?php foreach (config("categories.$product->kind") as $brand): ?>
                                <option value="<?= e($brand) ?>" <?= $brand === $product->brand ? 'selected' : '' ?>><?= e(ucfirst($brand)) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <button class="btn btn-sm" type="button" onclick="document.querySelector('#avatar').click()">Upload avatar</button>
                <input id="avatar" type="file" name="avatar" class="invisible" accept="image/*">
            </div>

            <div class="mt-3">
                <img id="preview" src="<?= e($product->avatar) ?>" class="w-10/12 mx-auto rounded-md">
            </div>

            <div class="mt-3">
                <button id="create-btn" class="btn btn-primary float-right">Save Product</button>
            </div>

        </form>
    </div>
</div>

<script>
const avatar = document.querySelector('#avatar')
const preview = document.querySelector('#preview')
const type = document.querySelector('#type')
const brand = document.querySelector('#brand')

const category = JSON.parse(type.getAttribute('data-type'))

avatar.addEventListener('change', (e) => {
    const [file] = e.target.files
    preview.src = URL.createObjectURL(file)
})

type.addEventListener('change', (e) => {
    brand.innerHTML = ''

    brand.insertAdjacentHTML('beforeend', `<option selected value="">Select one</option>`);

    category[type.value].forEach(vendor => {
        brand.insertAdjacentHTML('beforeend', `<option value="${vendor}">${vendor.charAt(0).toUpperCase() + vendor.slice(1)}</option>`);
    })
})
</script>

<?php include_view('layouts.footer'); ?>
