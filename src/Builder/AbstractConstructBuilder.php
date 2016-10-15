<?php

namespace Dhii\CodeGen\Builder;

use Dhii\Blueprint\AbstractBuilder;
use Dhii\Blueprint\BlueprintInterface;
use Dhii\CodeGen\Blueprint\ConstructBlueprintInterface;

/**
 * Abstract implementation of a construct builder.
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
abstract class AbstractConstructBuilder extends AbstractBuilder implements ConstructBuilderInterface
{
    /**
     * The delegation container instance.
     *
     * @var ContainerInterface
     */
    protected $delegationContainer;

    /**
     * {@inheritdoc}
     */
    public function getDelegationContainer()
    {
        return $this->delegationContainer;
    }

    /**
     * Sets the delegation container instance.
     *
     * @param ContainerInterface $delegationContainer The new delegation container instance.
     *
     * @return AbstractConstructDelegationBuilder This instance.
     */
    public function setDelegationContainer(ContainerInterface $delegationContainer)
    {
        $this->delegationContainer = $delegationContainer;

        return $this;
    }

    /**
     * Checks if the builder supports the given construct blueprint.
     *
     * @return bool True if this build supports the given blueprint, false if not.
     */
    abstract protected function _supports(ConstructBlueprintInterface $blueprint);

    /**
     * {@inheritdoc}
     */
    public function supports(BlueprintInterface $blueprint)
    {
        return $blueprint instanceof ConstructBlueprintInterface && $this->_supports($blueprint);
    }
}
