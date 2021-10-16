<?php

namespace Core\Contracts;


interface ApplicationContract
{
    /**
     * Get container
     *
     * @return \Core\Container
     */
    public function container();
}
