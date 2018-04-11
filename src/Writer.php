<?php
namespace Edujugon\Log;

use Illuminate\Log\Writer as LogWriter;
use Monolog\Formatter\LineFormatter;

class Writer extends LogWriter
{

    const FORMAT_WITHOUT_DATETIME = "[%datetime%] ";
    const FORMAT_WITHOUT_LOGGER_DETAILS = "%channel%.%level_name%: ";

    protected $format = LineFormatter::SIMPLE_FORMAT;

    /**
     * Get a default Monolog formatter instance.
     *
     * @return \Monolog\Formatter\LineFormatter
     */
    protected function getDefaultFormatter()
    {
        return new LineFormatter($this->format, null, true, true);
    }

    /**
     * Formatting log line
     *
     * @param array $exclude
     * @return null
     */
    public function lineFormat($exclude = [])
    {
        foreach ($exclude as $fragment) {
            $this->format = str_replace($fragment, "", $this->format);
        }

        return $this->format;
    }
}
