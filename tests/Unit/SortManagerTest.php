<?php

namespace Sorting\Test\Unit;

use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Sorting\Comparable;
use Sorting\ComparatorInterface;
use Sorting\SortManager;
use Sorting\SortManagerInterface;

/**
 * Class SortManagerTest
 *
 * @package Sorting
 */
class SortManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SortManagerInterface
     */
    private $sortManager;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->sortManager = new SortManager();
    }

    /**
     * @test
     */
    public function itShouldReturnAnEmptyListIfAnEmptyListAndAComparatorIsGiven()
    {
        $comparator = $this->getComparator();

        $actual = $this->sortManager->sortWithComparator($comparator->reveal(), []);

        $this->assertSame([], $actual);
    }

    /**
     * @test
     */
    public function itShouldCallTheCompareMethodOnTheComparatorWithTwoValues()
    {
        $comparator = $this->getComparator();
        $comparator->compare(Argument::any(), Argument::any())->willReturn(-1)->shouldBeCalled();

        $this->sortManager->sortWithComparator($comparator->reveal(), [1, 2]);
    }

    /**
     * @test
     */
    public function itShouldReturnAnEmptyListIfAnEmptyListOfComparablesIsGiven()
    {
        $actual = $this->sortManager->sortComparable([]);

        $this->assertSame([], $actual);
    }

    /**
     * @test
     */
    public function itShouldCallCompareToOnOneComparable()
    {
        $comparable1 = $this->getComparable();
        $comparable2 = $this->getComparable();
        $comparable1->compareTo($comparable2->reveal())->willReturn(1)->shouldBeCalled();

        $this->sortManager->sortComparable([$comparable1->reveal(), $comparable2->reveal()]);
    }

    /**
     * @return ObjectProphecy
     */
    private function getComparator()
    {
        return $this->prophesize(ComparatorInterface::class);
    }

    /**
     * @return ObjectProphecy
     */
    private function getComparable()
    {
        return $this->prophesize(Comparable::class);
    }
}