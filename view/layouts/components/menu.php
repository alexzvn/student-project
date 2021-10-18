<div class="navbar mb-2 shadow-lg fixed w-full bg-gray-50 z-10">
  <div class="container mx-auto">
    <div class="flex-1 lg:flex-none px-2 mx-2">
        <a href="/" class="text-lg font-bold text-yellow-400 hover:text-yellow-500 transition-colors duration-200">
            xShop
        </a>
    </div> 
    <div class="flex-1 hidden px-2 mx-2 lg:flex">
        <div class="flex items-stretch">
            <?php foreach (config('categories') as $category => $categories): ?>
            <div class="dropdown dropdown-hover">
                <div tabindex="0" class="btn btn-ghost btn-sm rounded-btn"><?= $category ?></div>
                <?php if (is_array($categories)): ?>
                    <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                        <?php foreach ($categories as $category): ?>
                            <li><a><?= ucfirst($category) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="hidden lg:flex">
        <?php if ($user = auth()->user()): ?>
        <div class="dropdown dropdown-hover dropdown-end">
            <button tabindex="0" class="btn btn-ghost btn-sm rounded-btn">
                Hi, <span class="underline ml-1"><?= $user->name?></span>
            </button>
            <ul class="shadow-md menu dropdown-content bg-base-100 rounded-md w-52">
                <li>
                    <a href="#">Account</a>
                </li>
                <li>
                    <a href="#">Orders</a>
                </li>
                <?php if ($user->is_admin): ?>
                    <li><a href="/manager/products">Manage products</a></li>
                    <li><a href="#">Manage orders</a></li>
                <?php endif; ?>
                <li class="text-red-500">
                    <a href="/logout">Sign Out</a>
                </li>
            </ul>
        </div>
        <?php else: ?>
        <div class="flex items-stretch">
            <a href="/login" class="btn btn-ghost btn-sm rounded-btn hover:bg-transparent hover:text-secondary">
                Sign in
            </a>
           <a href="/register" class="btn btn-primary btn-sm rounded-btn">
                Register
            </a>
        </div>
        <?php endif; ?>
    </div>

    <div class="flex-none lg:hidden">
        <button class="btn btn-square btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        </button>
    </div>
  </div>
</div>
