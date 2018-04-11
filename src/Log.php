<?php
namespace Edujugon\Log;

use Monolog\Logger;

class Log
{

    /**
     * Set the logger name
     * @var string
     */
    protected $loggerName;

    /**
     * File Name
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $extension = '.log';

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $line = '';

    /**
     * Available: emergency, alert, critical, error, warning, notice, info and debug
     * @var string
     */
    protected $level;

    /**
     * Days to keep the log
     */
    protected $days;

    /**
     * Exclude from the log line
     * @var array
     */
    protected $excludeFromFormat = [];

    /**
     * @var \Illuminate\Log\Writer
     */
    protected $log;

    /**
     * Log constructor.
     */
    public function __construct()
    {
        $config = e_log_config();

        $this->loggerName = $config['logger-name'];

        $this->path = $config['path'] ;

        $this->level = $config['level'];

        $this->file = $config['fileName'] . $this->extension;

        $this->days = $config['days'];

    }

    /**
     * Set the path to locale the log file.
     * @param $path
     * @return $this
     */
    public function path($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Available levels : emergency, alert, critical, error, warning, notice, info and debug
     *
     * @param  $level
     * @return $this
     */
    public function level($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $line
     * @return $this
     */
    public function line($line)
    {
        $this->line = empty($this->line) ? $line : "$this->line\n$line";

        return $this;
    }

    /**
     * Set the logger name (logging context name)
     * @param $loggerName
     * @return $this
     */
    public function name($loggerName)
    {
        $this->loggerName = $loggerName;

        return $this;
    }
    /**
     * Set the name of the file.
     * No need to pass the extension
     *
     * @param $name
     * @return $this
     */
    public function fileName($name)
    {
        $this->file = $name . $this->extension;

        return $this;
    }

    /**
     * Set amount of files to be kept in server.
     * @param $days
     * @return $this
     */
    public function days($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Exclude datetime from log line
     */
    public function withoutDateTime()
    {
        $this->excludeFromFormat[] = Writer::FORMAT_WITHOUT_DATETIME;

        return $this;
    }

    /**
     * Exclude logger details from log line
     */
    public function withoutLoggerDetails()
    {
        $this->excludeFromFormat[] = Writer::FORMAT_WITHOUT_LOGGER_DETAILS;

        return $this;
    }

    /**
     * Write in log file.
     * @return bool
     */
    public function write()
    {
        $this->loadLogger();

        $fullPathToFile = $this->setFullName();

        $this->createFolderIfNoExists();

        if ($this->days) {
            $this->log->useDailyFiles($fullPathToFile, $this->days);
        } else {
            $this->log->useFiles($fullPathToFile);
        }

        $this->writeInLog();

        $this->clearInput();
        $this->clearFormat();

        return true;
    }

    /**
     * Call write method of \Illuminate\Log\Writer
     */
    private function writeInLog()
    {
        $message = $this->concatTitleAndLines();

        $this->log->write($this->level, $message);
    }
    /**
     * Concat the message with the title and lines
     * @return string
     */
    private function concatTitleAndLines()
    {
        return "$this->title\n$this->line";
    }

    /**
     * Create folder if no exists
     */
    private function createFolderIfNoExists()
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }
    }

    /**
     * Concat path and filename
     * @return string
     */
    private function setFullName()
    {
        return $this->addSlash($this->path) . $this->file;
    }

    /**
     * Add slash if it has not.
     *
     * @param $path
     * @return string
     */
    private function addSlash($path)
    {
        if (substr($path, -1) != '/') {
            return $path . '/';
        }

        return $path;
    }

    /**
     * instance of \Illuminate\Log\Writer
     */
    private function loadLogger()
    {
        $this->log = new Writer(new Logger($this->loggerName));

        $this->log->lineFormat($this->excludeFromFormat);
    }

    /**
     * Clear title and line
     */
    protected function clearInput()
    {
        $this->title = '';
        $this->line = '';
    }

    /**
     * Clear the line format to default
     */
    protected function clearFormat()
    {
        $this->excludeFromFormat = [];
    }

}