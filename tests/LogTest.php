<?php


use Edujugon\Log\Log;

class LogTest extends PHPUnit_Framework_TestCase {

    /** @test */
    public function log_with_lines()
    {
        $log = new Log();
        $log->fileName('test')
            ->title('Log with sublines asdf asdf as df asdf as df asdf asdf as df')
            ->line('esta es una sublinea')
            ->line('y esta otra :)')
            ->write();
    }

}