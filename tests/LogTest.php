<?php


use Edujugon\Log\Log;

class LogTest extends PHPUnit_Framework_TestCase {

    /** @test */
    public function log_with_lines()
    {
        $log = new Log();
        $log->fileName('test')
            ->title('Edujugon Log title')
            ->line('First line')
            ->line('second :)')
            ->withoutDateTime()
            ->withoutLoggerDetails()
            ->write();
    }

}