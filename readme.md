# Laravel Log Package

Simple API to write logs for Laravel.

##  Installation

##### Type in console:

```
composer require edujugon/laravel-log
```

**Laravel 5.5 or higher?**

Then you don't have to either register or add the alias, this package uses Package Auto-Discovery's feature, and should be available as soon as you install it via Composer.

(Laravel < 5.5) Register the Log service by adding it to the providers array.

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
- [days](https://github.com/edujugon/laravel-log/#days)
- [withoutDateTime](https://github.com/edujugon/laravel-log/#withoutdatetime)
- [withoutLoggerDetails](https://github.com/edujugon/laravel-log/#withoutloggerdetails)
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

#### days

`days` method sets amount of days to be kept in server.

**Syntax**

```php
Edujugon\Log\Log object days($days)
```
> A value "0" means no day limit

#### withoutDateTime

`withoutDateTime` method excludes datetime from log line.

**Syntax**

```php
Edujugon\Log\Log object withoutDateTime()
```

#### withoutLoggerDetails

`withoutLoggerDetails` method excludes logger details from log line.

**Syntax**

```php
Edujugon\Log\Log object withoutLoggerDetails()
```
> Exclude logger name and level

#### write

`write` method writes in log file.

**Syntax**

```php
boolean write()
```

##  Usage samples

```
$log = new Log();
$log->fileName('my-personal-log')
    ->title('Stored new record')
    ->line('the record id is 3')
    ->line('Stored by John')
    ->line('This is antoher line')
    ->days(3)
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