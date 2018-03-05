<?php

namespace Anonymous\Config;


use Anonymous\Containers\Exceptions\ContainerException;
use Anonymous\Containers\SettableContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Config which use PSR-11 Container to store its data
 * @package Anonymous\Config
 * @author Anonymous PHP Developer <anonym.php@gmail.com>
 */
class Config implements ConfigInterface
{

    /** @var ContainerInterface */
    protected $container;


    /**
     * Config constructor
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function get($key, $defaultValue = null)
    {
        return $this->getOn($this->container, $key, $defaultValue);
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        $this->setOn($this->container, $key, $value);
    }

    /**
     * Gets value from the specified container
     * @param ContainerInterface $container
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    protected function getOn(ContainerInterface $container, $key, $defaultValue = null)
    {
        try {
            return $container->get($key);
        } catch (\Exception $exception) {
            if ($exception instanceof NotFoundExceptionInterface) {
                return $defaultValue;
            }

            throw $exception;
        }
    }

    /**
     * Sets value to the specified container
     * @param ContainerInterface $container
     * @param $key
     * @param $value
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws \Exception
     */
    protected function setOn(ContainerInterface $container, $key, $value)
    {
        if (!$container instanceof SettableContainerInterface && !method_exists($container, 'set')) {
            $className = get_class($container);
            throw new ContainerException("Container '{$className}' is not settable");
        }

        try {
            $container->set($key, $value);
        } catch (\Exception $exception) {
            if (!$exception instanceof ContainerExceptionInterface) {
                throw $exception;
            }
        }
    }

}