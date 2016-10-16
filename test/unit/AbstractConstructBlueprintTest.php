<?php

namespace Dhii\CodeGen\Test;

use \Dhii\CodeGen\Blueprint\AbstractConstructBlueprint;

/**
 * Tests {@see Dhii\CodeGen\AbstractConstructBlueprint}
 *
 * @since [*next-version*]
 */
class AbstractConstructBlueprintTest extends \Xpmock\TestCase
{

    /**
     * Creates a mock instance for testing purposes.
     *
     * @since [*next-version*]
     *
     * @return AbstractConstructBlueprint
     */
    public function createInstance()
    {
        $mock = $this->mock('Dhii\CodeGen\Blueprint\AbstractConstructBlueprint',
            array(
                'buildType'     => 'mock',
                '_getBuildData' => function () {
                    return get_object_vars($this);
                }
            )
        );

        return $mock;
    }

    /**
     * Tests whether instances can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf('Dhii\Blueprint\BlueprintInterface', $subject, 'Subject is not a valid blueprint.');
        $this->assertInstanceOf('Dhii\CodeGen\Blueprint\ConstructBlueprintInterface', $subject, 'Subject is not a valid construct blueprint.');
        $this->assertInstanceOf('Dhii\CodeGen\Blueprint\AbstractConstructBlueprint', $subject, 'Subject is not a valid abstract construct blueprint instance.');
    }

    /**
     * Tests whether the build data is retrieved correctly.
     *
     * @since [*next-version*]
     *
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::_getBuildData
     */
    public function testGetBuildData()
    {
        $subject = $this->createInstance();

        $expected = array(
            'buildType' => 'mock'
        );

        $this->assertEquals($expected, $subject->getBuildData());
    }

    /**
     * Tests whether the build data is retrieved correctly when it contains a hierarchy of blueprints.
     *
     * @since [*next-version*]
     *
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::_getBuildData
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::getBuildDataHelper
     */
    public function testGetBuildDataHierarchy()
    {
        $subject = $this->createInstance();

        $subject->child = $this->createInstance();

        $expected = array(
            'buildType' => 'mock',
            'child'     => $subject->child
        );
        $actual = $subject->getBuildData(false);

        $this->assertEquals($expected, $actual);
        $this->assertSame($subject->child, $actual['child'], 'The child instance is not the same instance as the one in the build data.');
    }

    /**
     * Tests whether the build data is retrieved correctly when it contains a hierarchy of blueprints and is retrieved recursively.
     *
     * @since [*next-version*]
     *
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::_getBuildData
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::getBuildDataHelper
     */
    public function testGetBuildDataHierarchyRecursive()
    {
        $subject = $this->createInstance();

        $subject->child = $this->createInstance();
        $subject->child->this()->buildType = 'child';

        $expected = array(
            'buildType' => 'mock',
            'child'     => array(
                'buildType' => 'child'
            )
        );

        $this->assertEquals($expected, $subject->getBuildData(true));
    }

    /**
     * Tests the build type getter method.
     *
     * @since [*next-version*]
     *
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::getBuildType
     */
    public function testGetBuildType()
    {
        $subject = $this->createInstance();

        $this->assertEquals('mock', $subject->getBuildType());
    }

    /**
     * Tests the build type getter method when it falls back to the constant,
     *
     * @since [*next-version*]
     *
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::getBuildType
     */
    public function testGetBuildTypeDefault()
    {
        $subject = $this->createInstance();
        $subject->this()->buildType = null;

        $this->assertEquals(AbstractConstructBlueprint::DEFAULT_BUILD_TYPE, $subject->getBuildType());
    }

    /**
     * Tests the build type setter method.
     *
     * @since [*next-version*]
     *
     * @covers Dhii\CodeGen\Blueprint\AbstractConstructBlueprint::setBuildType
     */
    public function testSetBuildType()
    {
        $subject = $this->createInstance();
        $subject->setBuildType('someBuildType');

        $this->assertEquals('someBuildType', $subject->this()->buildType);
    }

}
