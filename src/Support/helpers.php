<?php

/**
 * Get configuration array data.
 *
 * @return array
 */
function e_log_config()
{
    if(function_exists('config_path'))
    {
        if(file_exists(config_path('log.php')))
        {
            $configuration = include(config_path('log.php'));

            return $configuration;
        }
    }

    return include(__DIR__ . '/../Config/config.php');

}