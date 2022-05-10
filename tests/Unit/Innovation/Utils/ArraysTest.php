<?php

namespace Unit\Innovation\Utils;

use Unit\BaseTest;
use Innovation\Utils\Arrays;

class ArraysTest extends BaseTest
{
    public function testGetArrayAsValue()
    {
        $a = [10, 20, 30];
        $v = Arrays::getArrayAsValue($a);
        $this->assertEquals(1074791424, $v);
    }
}
