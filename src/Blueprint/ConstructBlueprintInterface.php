<?php

namespace Dhii\CodeGen\Blueprint;

/**
 * A blueprint for any generic programming language construct.
 *
 * Construct blueprints are considered to "recursive", in that their build data can potentially consist of
 * other construct blueprints that will require building before the actual construct itself can be built.
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
interface ConstructBlueprintInterface extends \Dhii\Blueprint\BlueprintInterface
{
    /**
     * Get the type of construct described by this blueprint.
     *
     * @return string A string that uniquely identifies the type of construct described by this blueprint.
     */
    public function getBuildType();
}
