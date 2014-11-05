<?php

namespace Tutto\Bundle\XhtmlBundle\Xhtml;

use Tutto\Bundle\UtilBundle\Logic\Attributes as BaseAttributes;

/**
 * Class Attributes
 * @package Tutto\Bundle\XhtmlBundle\Logic
 *
 * @Annotation()
 */
class Attributes extends BaseAttributes {
    /**
     * @param string|array $class
     */
    public function addClass($class) {
        $this->addAttribute('class', $class);
    }

    /**
     * @return array|null
     */
    public function getClass() {
        return $this->getAttribute('class');
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->setAttribute('id', $id);
    }

    /**
     * @return string|null
     */
    public function getId() {
        return $this->getAttribute('id');
    }

    /**
     * @param bool $required
     */
    public function setRequired($required = true) {
        if ($required === true) {
            $this->setAttribute('required', 'required');
        } else {
            $this->removeAttribute('required');
        }
    }

    /**
     * @return bool
     */
    public function isRequired() {
        return $this->hasAttribute('required');
    }
}