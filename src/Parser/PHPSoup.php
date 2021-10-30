<?php

namespace Aammui\LaravelParser\Parser;

use DOMDocument;
use DOMNode;
use DOMNodeList;
use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

class PHPSoup
{
    /**
     * @var
     */
    private $document;

    private $nodes = [];

    public function parse($node = null)
    {
        $this->add($node);

        return $this;
    }

    public function get(string $filter)
    {
        $converter = new CssSelectorConverter();

        $xPathFilter = $converter->toXPath($filter);

        $crawler = $this->createPartialSoup(null);

        foreach ($this->nodes as $node) {
            $domXpath = new DOMXpath($node->ownerDocument);
            $crawler->add($domXpath->query($xPathFilter, $node));
        }

        return $crawler;
    }

    public function first(string $filter = null)
    {
        $soup = $this->index(0);

        if (is_null($filter)) {
            return $soup;
        }

        return $soup->get($filter)->index(0);
    }

    public function index($position)
    {
        if (isset($this->nodes[$position])) {
            return $this->createPartialSoup($this->nodes[$position]);
        }

        return $this->createPartialSoup(null);
    }

    public function html()
    {
        $html = "";

        foreach ($this->nodes as $node) {
            $html .= $node->ownerDocument->saveHtml($node);
        }

        return $html;
    }

    public function text($trim = false)
    {
        $text = "";

        foreach ($this->nodes as $node) {
            $text .= $node->nodeValue;
        }

        return $trim ? trim($text) : $text;
    }

    public function attributes(string $attribute)
    {
        return $this->getNode(0)
            ->attributes
            ->getNamedItem($attribute)
            ->textContent;
    }

    /**
     * @param $position
     *
     * @return DOMNode|void
     */
    public function getNode($position)
    {
        if (isset($this->nodes[$position])) {
            return $this->nodes[$position];
        }
    }

    public function add($node)
    {
        if ($node instanceof DOMNodeList) {
            $this->addNodeList($node);
        } elseif ($node instanceof DOMNode) {
            $this->addNode($node);
        } elseif (is_array($node)) {
            $this->addNodes($node);
        } elseif (is_string($node)) {
            $this->addContent($node);
        }
    }

    public function addContent($html)
    {
        $dom = new DOMDocument();

        $dom->loadHTML($html);

        $this->addDocument($dom);
    }

    /**
     * @param DOMDocument $dom
     */
    public function addDocument(DOMDocument $dom)
    {
        if ($dom->documentElement) {
            $this->addNode($dom->documentElement);
        }
    }


    public function addNodeList(DOMNodeList $nodes)
    {
        foreach ($nodes as $node) {
            if ($node instanceof DOMNode) {
                $this->addNode($node);
            }
        }
    }

    public function addNodes(array $nodes)
    {
        foreach ($nodes as $node) {
            $this->add($node);
        }
    }

    public function addNode(DOMNode $node)
    {
        if ($node instanceof DOMDocument) {
            $node = $node->documentElement;
        }

        $this->nodes[] = $node;
    }

    public function createPartialSoup($nodes)
    {
        $soup = (new static())->parse($nodes);

        $soup->document = $this->document;

        return $soup;
    }
}
