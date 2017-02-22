<?php
/**
 * Project: laravel-log.
 * User: Edujugon
 * Email: edujugon@gmail.com
 * Date: 22/2/17
 * Time: 13:39
 */


/**
 * Get configuration array data.
 *
 * @return array
 */
function eConfig()
{
    if(function_exists('config_path'))
    {
        if(file_exists(config_path('log.php')))
        {
            $configuration = include(config_path('log.php'));

            return $configuration;
        }
    }

    $configuration = include(__DIR__ . '/../Config/config.php');

    return $configuration;
}