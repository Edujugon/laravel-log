<?php
namespace Edujugon\Log\Facades;


use Edujugon\Log\Log as MyLog;
use Illuminate\Support\Facades\Facade;

class Log extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return MyLog::class; }

}