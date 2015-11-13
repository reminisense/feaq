<?php

/**
 * Unit test cases for utility methods found in @link Helper.php
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/10/2015
 * Time: 3:23 PM
 */
class HelperTest extends TestCase
{
    // TODO
    // NOTE TO FUTURE DEVELOPERS (error when running test suite via phpunit)
    // - A new instance of this class is generated per method which causes an error in PHP. e.g. ErrorException: Constant REMINISENSE already defined
    // - we have to think of a way to refactor this such that each method will use existing loaded classpath.
    // - see https://github.com/laravel/framework/issues/1798

    // please run this test case separately i.e. #> vendor\bin\phpunit app\tests\HelperTest.php

    public function testGenerateRawCode()
    {
        // NOTE this may cause collisions over a bigger sample size.
        $var1 = Helper::generateRawCode();
        $var2 = Helper::generateRawCode();
        echo "\r\n> compare $var1 and $var2";

        $this->assertNotEquals($var1, $var2);
    }

    public function testIsRawCodeExists()
    {
        // FIXME this should exist in database
        $var1 = Helper::isRawCodeExists("abcd");
        $this->assertNotEquals($var1, 1);
        // FIXME this should not exist in database
        $var2 = Helper::isRawCodeExists(Helper::generateRawCode());
        $this->assertNotEquals($var1, 0);
    }


}