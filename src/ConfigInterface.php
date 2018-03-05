<?php

namespace Anonymous\Config;

use Psr\Container\ContainerExceptionInterface;


/**
 * Interface ConfigInterface
 * @package Anonymous\Config
 * @author Anonymous PHP Developer <anonym.php@gmail.com>
 */
interface ConfigInterface
{

    /**
     * Gets value from the config
     * @param string $key
     * @param null $defaultValue
     * @return mixed
     * @throws ContainerExceptionInterface
     */
    public function get($key, $defaultValue = null);

    /**
     * Sets value to the config
     * @param string $key
     * @param $value
     * @return void
     * @throws ContainerExceptionInterface
     */
    public function set($key, $value);

}