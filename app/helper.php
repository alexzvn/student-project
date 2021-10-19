<?php

/**
 * Undocumented function
 *
 * @return \App\Support\Cart
 */
function cart()
{
    return app()->container()->make(App\Support\Cart::class);
}
