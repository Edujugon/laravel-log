<?php
namespace Edujugon\Log;


use Illuminate\Log\Writer;
use Monolog\Logger;

class Log
{

    /**
     * Set the logger name
     * @var string
     */
    protected $loggerName = 'my-logger';

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
     * @var \Illuminate\Log\Writer
     */
    protected $log;

    /**
     * Log constructor.
     * @param $name
     * @internal param Writer|null $log
     */
    function __construct($name = null)
    {

        $this->loggerName = $name ? $name : $this->loggerName;

        $this->path = eConfig()['path'] ;

        $this->level = eConfig()['level'];

        $this->file = eConfig()['fileName'] . $this->extension;

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
    function level($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $line
     * @return $this
     */
    function line($line)
    {
        $this->line = empty($this->line) ? $line : "$this->line\n$line";

        return $this;
    }

    /**
     * Set the logger name
     * @param $loggerName
     * @return $this
     */
    function name($loggerName)
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
    function fileName($name)
    {
        $this->file = $name . $this->extension;

        return $this;
    }


    /**
     * Write in log file.
     * @param null $title
     * @return bool
     */
    function write($title = null)
    {
        $title = $title ? $title :  $this->title;

        $this->log = new Writer(new Logger($this->loggerName));

        $message = $this->createMessageWithSubLines($title);

        $fullPathToFile = $this->setFullName();

        $this->createFileIfNoExists($fullPathToFile);


        $this->log->useFiles($fullPathToFile);
        $this->log->write($this->level,$message);

        return true;
    }

    /**
     * Concar the message with the title and lines
     * @param $title
     * @return string
     */
    private function createMessageWithSubLines($title)
    {
        return "$title\n$this->line";
    }

    /**
     * @param $fullPathToFile
     */
    private function createFileIfNoExists($fullPathToFile)
    {
        if(!is_dir($this->path))
            mkdir($this->path);

        if(!file_exists($fullPathToFile))
            touch($fullPathToFile);
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
        if(substr($path,-1) != '/')
            return $path . '/';

        return $path;
    }

}