<?php

namespace Tutto\Bundle\XhtmlBundle\Twig;

use Tutto\Bundle\XhtmlBundle\Logic\XhtmlRendererInterface;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

/**
 * Class XhtmlRendererExtension
 * @package Tutto\Bundle\XhtmlBundle\Twig
 */
class XhtmlRendererExtension extends Twig_Extension {
    /**
     * @var XhtmlRendererInterface
     */
    private $renderer;

    /**
     * @param XhtmlRendererInterface $renderer
     */
    public function __construct(XhtmlRendererInterface $renderer) {
        $this->renderer = $renderer;
    }

    /**
     * @return array
     */
    public function getFunctions() {
        return [
            new Twig_SimpleFunction('xhtml', [$this, 'xhtml']),
            new Twig_SimpleFunction('xhtmlRaw', [$this, 'xhtml'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @return array
     */
    public function getFilters() {
        return [
            new Twig_SimpleFilter('xhtml', [$this, 'xhtml']),
            new Twig_SimpleFilter('xhtmlRaw', [$this, 'xhtml'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param AbstractTag $tag
     * @return string
     */
    public function xhtml(AbstractTag $tag) {
        return $this->renderer->render($tag);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName() {
        return 'tutto_xhtml_renderer';
    }
}