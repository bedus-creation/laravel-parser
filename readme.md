# Laravel Parser

HTML parser for Laravel/PHP.

### Introduction

This packages parses html responses, with very efficient APIs. But it doesn't parse any url.

> This package is Laravel wrapper of https://github.com/symfony/dom-crawler

### Installation
```shell
composer require aammui/laravel-parser
```

### Uses

```php
use Aammui\LaravelParser\Facade\PHPSoup;

$html = <<<END
<html lang="en">
  <head>
   <title>
    The Dormouse's story
   </title>
  </head>
  <body>
   <p class="title">
    <b>
     The Dormouse's story
    </b>
   </p>
   <p class="story">
    Once upon a time there were three little sisters; and their names were
    <a class="sister" href="http://example.com/elsie" id="link1">
     Elsie
    </a>
    ,
    <a class="sister" href="http://example.com/lacie" id="link2">
     Lacie
    </a>
    and
    <a class="sister" href="http://example.com/tillie" id="link3">
     Tillie
    </a>
    ; and they lived at the bottom of a well.
   </p>
   <p class="story">
    ...
   </p>
  </body>
 </html>
END;

$soup = PHPSoup::Parse($html);

// Outputs: <title>The Dormouse's story</title> 
echo $soup->get('title')->first()->outerHtml();

// Outputs: The Dormouse's story
echo $soup->get('title')->first()->text();

// Output: 
echo $soup->get('p')->first()->attributes("href");

// [<a class="sister" href="http://example.com/elsie" id="link1">Elsie</a>,
//  <a class="sister" href="http://example.com/lacie" id="link2">Lacie</a>,
//  <a class="sister" href="http://example.com/tillie" id="link3">Tillie</a>]
echo $soup->get("a");

// Search by attributes
echo $soup->get("li[data-item]")->outerHtml();
echo $soup->get("li[data-item='2']")->outerHtml();

// Search by Css
echo $soup->get("head > title")->outerHtml();
# [<title>The Dormouse's story</title>]

// Find the siblings of tags:
echo $soup->get("#link1 ~ .sister")->outerHtml();
# [<a class="sister" href="http://example.com/lacie" id="link2">Lacie</a>,
#  <a class="sister" href="http://example.com/tillie"  id="link3">Tillie</a>]
```



