<?php

namespace Tutto\Bundle\XhtmlBundle\Logic;

use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\SingleTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;

/**
 * Class XhtmlRenderer
 * @package Tutto\Bundle\XhtmlBundle\Logic
 */
class XhtmlRenderer implements XhtmlRendererInterface {
    /**
     * @param AbstractTag $tag
     * @return string
     */
    public function render(AbstractTag $tag) {
        return $this->open($tag).$this->children($tag->getChildren()).$this->close($tag);
    }

    /**
     * @param AbstractTag[] $children
     * @return string
     */
    private function children(array $children) {
        $xhtml = '';
        foreach ($children as $child) {
            $xhtml.= $this->render($child);
        }
        return $xhtml;
    }

    /**
     * @param AbstractTag $tag
     * @return string
     */
    private function attributes(AbstractTag $tag) {
        $xhtml = '';
        foreach ($tag->getAttributes() as $name => $value) {
            if (is_array($value)) {
                $value = implode(' ', $value);
            }

            $xhtml = $name.'="'.$value.'"';
        }

        return empty($xhtml) ? '' : ' '.$xhtml;
    }

    /**
     * @param AbstractTag $tag
     * @return string
     */
    private function open(AbstractTag $tag) {
        if ($tag instanceof Text) {
            return $tag->getText();
        } elseif ($tag instanceof SingleTag) {
            return '<'.trim($tag->getName()).$this->attributes($tag).' />';
        } else {
            return '<'.trim($tag->getName()).$this->attributes($tag).'>';
        }
    }

    /**
     * @param AbstractTag $tag
     * @return string
     */
    private function close(AbstractTag $tag) {
        if ($tag instanceof Tag) {
            return '</'.$tag->getName().'>';
        } else {
            return '';
        }
    }
}