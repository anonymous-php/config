<?php

namespace Anonymous\Config;


use Anonymous\Containers\NestedContainer;

/**
 * Config which can get values from nested containers instead of use global one
 * @package Anonymous\Config
 * @property NestedContainer $container
 * @author Anonymous PHP Developer <anonym.php@gmail.com>
 */
class NestedConfig extends Config implements NestedConfigInterface
{

    /**
     * NestedConfig constructor
     * @param NestedContainer $container
     */
    public function __construct(NestedContainer $container)
    {
        parent::__construct($container);
    }

    /**
     * @inheritdoc
     */
    public function subGet($subName, $key, $defaultValue = null)
    {
        return $this->getOn($this->container->getContainer($subName), $key, $defaultValue);
    }

    /**
     * @inheritdoc
     */
    public function subSet($subName, $key, $value)
    {
        $this->setOn($this->container->getContainer($subName), $key, $value);
    }

}