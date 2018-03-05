<?php

namespace Anonymous\Config;


use Psr\Container\ContainerExceptionInterface;

/**
 * Interface NestedConfigInterface
 * @package Anonymous\Config
 * @author Anonymous PHP Developer <anonym.php@gmail.com>
 */
interface NestedConfigInterface
{

    /**
     * Gets value from the nested container
     * @param $subName
     * @param $key
     * @param null $defaultValue
     * @return mixed
     * @throws ContainerExceptionInterface
     */
    public function subGet($subName, $key, $defaultValue = null);

    /**
     * Sets value to the nested container
     * @param $subName
     * @param $key
     * @param $value
     * @return mixed
     * @throws ContainerExceptionInterface
     */
    public function subSet($subName, $key, $value);

}