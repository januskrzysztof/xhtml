<?php

namespace Tutto\Bundle\XhtmlBundle\Xhtml;

use Tutto\Bundle\UtilBundle\Logic\Attributes as BaseAttributes;
use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes;
use LogicException;

/**
 * Class AbstractTag
 * @package Tutto\Bundle\XhtmlBundle\Xhtml
 */
abstract class AbstractTag {
    /**
     * @var string
     */
    private $name;

    /**
     * @var AbstractTag[]
     */
    private $children = [];

    /**
     * @var Attributes
     */
    private $attributes;

    /**
     * @var AbstractTag|null
     */
    private $parent = null;

    /**
     * @param string $name
     * @param array $attributes
     * @param AbstractTag[] $children
     */
    public function __construct($name, $attributes = [], array $children = []) {
        $this->setName($name);
        $this->setAttributes($attributes);

        foreach ($children as $child) {
            $this->addChild($child);
        }
    }

    abstract public function getAliasName();

    /**
     * @return null|AbstractTag
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param AbstractTag $child
     */
    public function addChild(AbstractTag $child) {
        $child->parent = $this;
        $this->children[] = $child;
    }

    /**
     * @return AbstractTag[]
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = (string) $name;
    }

    /**
     * @param array|Attributes|BaseAttributes $attributes
     */
    public function setAttributes($attributes) {
        if (is_array($attributes)) {
            $this->attributes = new Attributes($attributes);
        } elseif ($attributes instanceof Attributes) {
            $this->attributes = $attributes;
        } elseif ($attributes instanceof BaseAttributes) {
            $this->attributes = new Attributes($attributes->getAttributes());
        } else {
            throw new LogicException('Attributes is not valid. Only array or Attributes instance.');
        }
    }

    /**
     * @return Attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }
}