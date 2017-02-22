# Laravel Log Package

Simple API to write logs for Laravel.

##  Installation

##### Type in console:

```
composer require edujugon/laravel-log
```

##### Register the GoogleAds service by adding it to the providers array.

```
'providers' => array(
        ...
        Edujugon\Log\Providers\LogServiceProvider::class
    )
```

##### Publish the package's configuration file to the application's own config directory.

```
php artisan vendor:publish --provider="Edujugon\Log\Providers\LogServiceProvider" --tag="config"
```

The above command will generate a new file under your laravel app config folder called `log.php`

##  Configuration

Update the `log.php` file with your data.

##  API List

- [path](https://github.com/edujugon/laravel-log/#path)
- [level](https://github.com/edujugon/laravel-log/#level)
- [title](https://github.com/edujugon/laravel-log/#title)
- [line](https://github.com/edujugon/laravel-log/#line)
- [name](https://github.com/edujugon/laravel-log/#logname)
- [fileName](https://github.com/edujugon/laravel-log/#filename)
- [write](https://github.com/edujugon/laravel-log/#write)

#### path

`path` method sets the path where create / storage the log file.

**Syntax**

```php
Edujugon\Log\Log object path($path)
```

#### level

`level` method sets the logging level.

> Available levels: emergency, alert, critical, error, warning, notice, info and debug.

**Syntax**

```php
Edujugon\Log\Log object level($level)
```

#### title

`title` method sets the title or main message to be written.

**Syntax**

```php
Edujugon\Log\Log object title($title)
```

#### line

`line` method sets a line below the title.

>   Notice that you can call this method as many time as lines you need to be written.

**Syntax**

```php
Edujugon\Log\Log object line($line)
```

#### logname

`name` method sets the logger name.

>   By default this name is "my-logger"

**Syntax**

```php
Edujugon\Log\Log object name($loggerName)
```

#### fileName

`fileName` method sets the file name.

>   Remember to put the name without any extension.

**Syntax**

```php
Edujugon\Log\Log object fileName($name)
```

#### write

`write` method writes in log file.

>   If passed number of days it will register a daily file log handler.

**Syntax**

```php
boolean write($days = 0)
```

##  Usage samples

```
$log = new Log();
$log->fileName('my-personal-log')
    ->title('Stored new record')
    ->line('the record id is 3')
    ->line('Stored by John')
    ->line('This is antoher line')
    ->write();
```

Also can do it by its Facade:

```
Log::fileName('my-personal-log')
    ->title('Stored new record')
    ->line('the record id is 3')
    ->line('Stored by John')
    ->line('This is antoher line')
    ->write();
```