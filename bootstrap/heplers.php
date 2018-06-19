<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_excerpt($value, $lenght=200)
{
    $excerpt = trim(preg_replace('/\r\n|\n|\n+/', '', strip_tags($value)));
    return str_limit($excerpt, $lenght);
}