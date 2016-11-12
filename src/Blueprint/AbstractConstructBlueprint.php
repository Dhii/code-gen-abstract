<?php

namespace Dhii\CodeGen\Blueprint;

use Dhii\Blueprint\BlueprintInterface;

/**
 * An abstract implementation of a construct blueprint.
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
abstract class AbstractConstructBlueprint implements ConstructBlueprintInterface
{
    /**
     * The default build type - only used if the {@link AbstractConstructBlueprint::buildType} property is null.
     */
    const DEFAULT_BUILD_TYPE = 'construct';

    /**
     * The type of construct described by this blueprint.
     *
     * If null, the {@link AbstractConstructBlueprint::DEFAULT_BUILD_TYPE} constant is used.
     *
     * @var string|null
     */
    protected $buildType = null;

    /**
     * {@inheritdoc}
     */
    public function getBuildType()
    {
        return is_null($this->buildType)
            ? static::DEFAULT_BUILD_TYPE
            : $this->buildType;
    }

    /**
     * Sets the construct build type.
     *
     * @param string $buildType A string that uniquely identifies the type of construct described by this blueprint.
     *
     * @return static This instance.
     */
    public function setBuildType($buildType)
    {
        $this->buildType = $buildType;

        return $this;
    }

}
