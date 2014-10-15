<?php

namespace Tutto\Bundle\XhtmlBundle\Xhtml;

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
     * @var array
     */
    private $attributes = [];

    /**
     * @var AbstractTag|null
     */
    private $parent = null;

    /**
     * @param string $name
     * @param array $attributes
     * @param AbstractTag[] $children
     */
    public function __construct($name, array $attributes = [], array $children = []) {
        $this->name       = $name;
        $this->attributes = $attributes;

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
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param mixed $class
     */
    public function addClass($class) {
        $this->addAttribute('class', $class);
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->setAttribute('id', $id);
    }

    /**
     * @param mixed $required
     */
    public function setRequired($required = true) {
        if ((boolean) $required) {
            $this->setAttribute('required', 'required');
        } else {
            $this->removeAttribute('required');
        }
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes) {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setAttribute($name, $value) {
        $this->attributes[$name] = $value;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addAttribute($name, $value) {
        $this->attributes[$name][] = $value;
    }

    /**
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name) {
        return isset($this->attributes[$name]);
    }

    /**
     * @param string $name
     * @param null|mixed $default
     * @return mixed
     */
    public function getAttribute($name, $default = null) {
        return $this->hasAttribute($name) ? $this->attributes[$name] : $default;
    }

    /**
     * @param string $name
     */
    public function removeAttribute($name) {
        if ($this->hasAttribute($name)) {
            unset($this->attributes[$name]);
        }
    }
}