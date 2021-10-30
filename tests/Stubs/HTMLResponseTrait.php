<?php

namespace Aammui\LaravelParser\Tests\Stubs;

trait HTMLResponseTrait
{
    public function getAttributesResponse()
    {
        return <<<HTML
        <body>
        <h1>I am Heading</h1>
            <ul>
                <li class="class-1" data-url="https://google.com">List 1</li>
                <li class="class" data-url="https://google.com">List 2</li>
                <li class="class">List 3</li>
            </ul>
        </body>
        HTML;
    }

    public function getResponse()
    {
        return <<<END
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
    }
}
