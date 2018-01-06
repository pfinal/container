<?php

namespace PFinal\Container;

use Psr\Container\ContainerInterface;

/**
 * Container
 *
 * @author  Zou Yiliang
 * @since   1.0
 */
class Container extends \Pimple\Container implements ContainerInterface
{
    public function get($id)
    {
        return $this[$id];
    }

    public function has($id)
    {
        return isset($this[$id]);
    }

    /**
     * 从容器中解析给定的类型
     *
     * @param string $abstract 服务名或类名
     * @param array $parameters 构造参数
     * @return mixed
     */
    public function make($abstract, array $parameters = array())
    {
        if ($this->offsetExists($abstract)) {
            $abstract = $this->offsetGet($abstract);
            if (is_object($abstract)) {
                return $abstract;
            }
        }

        $ref = new \ReflectionClass((string)$abstract);
        $constructor = $ref->getConstructor();
        if ($constructor === null) {
            return new $abstract();
        }

        $arguments = array();
        foreach ($constructor->getParameters() as $param) {
            if (array_key_exists($param->name, $parameters)) {
                $arguments[] = $parameters[$param->name];
                continue;
            } else if ($param->getClass() !== null) {
                $paramClassName = $param->getClass()->getName();
                if ($this->offsetExists($paramClassName)) {
                    $arguments[] = $this->offsetGet($paramClassName);
                    continue;
                } else if (class_exists($paramClassName)) {
                    $arguments[] = $this->make($paramClassName);
                    continue;
                } else {
                    break;
                }
            }

            if ($param->isDefaultValueAvailable()) {
                $arguments[] = $param->getDefaultValue();
            } else {
                break;
            }
        }

        return $ref->newInstanceArgs($arguments);
    }
}