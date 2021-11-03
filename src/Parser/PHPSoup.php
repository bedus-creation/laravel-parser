<?php

namespace Aammui\LaravelParser\Parser;

use Doctrine\Common\Annotations\PhpParser;
use Illuminate\Support\Facades\Route;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @method \Aammui\LaravelParser\Parser\PHPSoup first()
 *
 * Class PHPSoup
 *
 * @package Aammui\LaravelParser\Parser
 */
class PHPSoup extends Crawler
{
    /**
     * @param null $node
     *
     * @return $this
     */
    public function parse($node = null)
    {
        return new static($node);
    }

    /**
     * @param string $attribute
     *
     * @return string
     */
    public function attributes(string $attribute)
    {
        return $this->getNode(0)
            ->attributes
            ->getNamedItem($attribute)
            ->textContent;
    }

    /**
     * @param string $filter
     *
     * @return PHPSoup|object
     */
    public function get(string $filter)
    {
        return $this->filter($filter);
    }

    /**
     * @param int $position
     *
     * @return PHPSoup|object
     */
    public function index(int $position)
    {
        return $this->eq($position);
    }
}
