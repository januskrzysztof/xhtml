<?php

namespace Tutto\Bundle\XhtmlBundle\Xhtml;

/**
 * Class Text
 * @package Tutto\Bundle\XhtmlBundle\Xhtml
 */
class Text extends AbstractTag {
    /**
     * @var string
     */
    private $text;

    /**
     * @param string $text
     * @param array $children
     */
    public function __construct($text = '', array $children = []) {
        parent::__construct('', [], $children);
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getAliasName() {
        return 'text';
    }
}