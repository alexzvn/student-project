<form method="GET" action="/search" class="card mx-auto max-w-4xl shadow-sm">
    <div class="card-body bg-white">
        <div class="flex items-center">
            <h1 class="flex-none mr-3 hidden md:block">Search:</h1>

            <div class="form-control flex-1">
                <div class="flex space-x-2">
                    <input type="text" name="query" value="<?= $query ?? '' ?>" placeholder="Search product name" class="w-full input input-primary input-bordered" required>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
