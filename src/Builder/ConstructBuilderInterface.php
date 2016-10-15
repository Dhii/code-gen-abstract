<?php

namespace Dhii\CodeGen\Builder;

/**
 * Any object that can build blueprints that represent programming language constructs.
 *
 * Construct builders are responsible for generating the source code of a programming language construct.
 * These types of builders should be agnostic of the context in which the construct is being built. At the same, they
 * should be able to delegate blueprint dependencies to other builders where necessary.
 *
 * The use of a container makes the delegation process easy and efficient. The container is expected to contain builder
 * instances, pre-configured, as services mapped to a the "build type" service ID. This should match the string returned
 * by {@link \Dhii\CodeGen\Blueprint\ConstructBlueprintInterface::getBuildType()} for supported blueprints.
 * 
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
interface ConstructBuilderInterface extends \Dhii\Blueprint\BuilderInterface
{
    /**
     * Gets the delegation container.
     *
     * @return \Interop\Container\ContainerInterface The delegation container.
     */
    public function getDelegationContainer();
}
