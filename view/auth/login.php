<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen grid place-items-center">
    <div class="card shadow-lg w-full max-w-xl">
        <form class="card-body bg-white" method="POST" action="/login">
            <h1 class="text-center font-semibold text-2xl mb-3">Sign in to xShop</h1>

            <?php include_view('layouts.alert'); ?>

            <?php if ($error = old('errors.login')): ?>
            <div class="alert alert-error mt-3">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>                      
                    </svg> 
                    <label><?= e($error) ?></label>
                </div>
            </div>
            <?php endif; ?>

            <div class="form-control">
                <label class="label"><span class="label-text">Email</span></label>
                <input name="email" type="email" placeholder="Username" class="input input-primary input-bordered" required>
            </div>
            <div class="form-control">
                <label class="label"><span class="label-text">Password</span></label>
                <input name="password" type="password" placeholder="Your password" class="input input-primary input-bordered" required>
            </div>

            <span class="mt-4 text-gray-500 text-sm">
                Need an account? <a href="/register" class="text-blue-400">Create new account</a>
            </span>

            <button type="submit" class="btn mt-5">Sign in</button> 
        </form>
    </div>
</div>

<?php include_view('layouts.footer'); ?>
