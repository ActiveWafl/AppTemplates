<?php

namespace MyApp\Tests\Integration;

class OtherTestSuite
extends \Wafl\Extensions\Selenium\TestCase
implements \DblEj\UnitTesting\ITestCase
{

    public function Get_TestType()
    {
        return TestCase::INTEGRATION_TEST;
    }

    public function GetHumanReadableTestType()
    {
        return "Integration Test";
    }

    /**
     * @test
     * @return boolean
     */
    function SomeOtherMethod()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @return boolean
     */
    function AnotherSomeOtherMethod()
    {
        $this->assertTrue(true);
    }

}
?>