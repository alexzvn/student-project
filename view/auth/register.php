<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen grid place-items-center">
    <div class="card shadow-lg w-full max-w-xl">
        <form class="card-body bg-white" method="POST" action="/register">
            <h1 class="text-center font-semibold text-2xl">Register Account xShop</h1>

            <div class="form-control">
                <label class="label"><span class="label-text">Name</span></label>
                <input name="name" type="text" placeholder="Your name" value="<?= input('name') ?>" class="input input-bordered <?= error('name') ? 'input-error' : 'input-primary'; ?>" required>
                <?php if (error('name')): ?>
                <label class="label">
                    <span class="label-text-alt text-red-500"><?= error('name') ?></span>
                </label>
                <?php endif; ?>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Email</span></label>
                <input name="email" type="email" placeholder="Email address" value="<?= input('email') ?>" class="input input-bordered <?= error('email') ? 'input-error' : 'input-primary'; ?>" required>
                <?php if (error('email')): ?>
                <label class="label">
                    <span class="label-text-alt text-red-500"><?= error('email') ?></span>
                </label>
                <?php endif; ?>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Address <small>(optional)</small></span></label>
                <input name="address" type="text" value="<?= input('address') ?>" placeholder="Your address for delivery product" class="input input-bordered">
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Password</span></label>
                <input name="password" type="password" placeholder="Your password" class="input input-bordered <?= error('password') ? 'input-error' : 'input-primary'; ?>" required>
                <?php if (error('password')): ?>
                <label class="label">
                    <span class="label-text-alt text-red-500"><?= error('password') ?></span>
                </label>
                <?php endif; ?>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Confirm Password</span></label>
                <input name="confirmed_password" type="password" placeholder="Confirmed password" class="input input-primary input-bordered" required>
            </div>

            <span class="mt-4 text-gray-500 text-sm">
                Already have an account? <a href="/login" class="text-blue-400">Go to sign in</a>
            </span>

            <button type="submit" class="btn mt-5 btn-success">Register Account</button> 
        </form>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
