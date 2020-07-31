<?php

if (! function_exists('isActive')) {
    /**
     * @param $href
     * @param string $class
     * @return string
     */
    function isActive($href, $class="active")
    {
        return strpos(Route::currentRouteName(), $href) === 0 ? $class : "";
    }
}
