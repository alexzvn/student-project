<?php include_view('layouts.header'); ?>

<div class="container mx-auto min-h-screen grid place-items-center">
    <div class="card shadow-lg w-full max-w-xl">
        <form class="card-body bg-white" method="POST" action="/login">
            <h1 class="text-center font-semibold text-2xl">Sign in to xShop</h1>

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
