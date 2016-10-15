<?php

namespace Dhii\CodeGen\Builder;

/**
 * Any object that can build blueprints that represent programming language constructs.
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
