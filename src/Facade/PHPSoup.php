<?php

namespace Aammui\LaravelParser\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Aammui\LaravelParser\Parser\PHPSoup parse(string $html)
 */
class PHPSoup extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'php-soup';
    }
}
