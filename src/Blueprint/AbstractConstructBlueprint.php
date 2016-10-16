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
     * {@inheritdoc}
     *
     * @param bool $recursive True to recursively expand child blueprints in the build data, false to not.
     */
    public function getBuildData($recursive = false)
    {
        $data = $this->_getBuildData();

        if ($recursive) {
            $data = array_map(array($this, 'getBuildDataHelper'), $data);
        }

        return $data;
    }

    /**
     * Helper method for `array_map()` usage in {@link AbstractConstructBlueprint::getBuildData()}.
     *
     * @param BlueprintInterface $item The current iteration item.
     *
     * @return mixed The blueprint's build data if $item was a blueprint, or $item if it wasn't a blueprint.
     */
    protected function getBuildDataHelper($item)
    {
        return ($item instanceof BlueprintInterface)
            ? $item->getBuildData(true)
            : $item;
    }

    /**
     * Internal non-recursive build data getter.
     *
     * @return array An associative array containing the build data.
     */
    abstract protected function _getBuildData();
}
