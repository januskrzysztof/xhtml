<?php

namespace Tutto\Bundle\XhtmlBundle\Logic;

use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Interface XhtmlRendererInterface
 * @package Tutto\Bundle\XhtmlBundle\Logic
 */
interface XhtmlRendererInterface {
    /**
     * @param AbstractTag $tag
     * @return string
     */
    public function render(AbstractTag $tag);
}