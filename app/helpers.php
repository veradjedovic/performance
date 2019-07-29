<?php

/**
 * @param $param
 */
function dd($param)
{
    print_r($param);
    die();
}

/**
 * @param $param
 * @return string
 */
function replace($param)
{
    return str_replace("#", "'", $param);
}