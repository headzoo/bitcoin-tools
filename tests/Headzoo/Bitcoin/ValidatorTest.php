<?php
use Headzoo\Bitcoin\Validator;

class ValidatorTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Headzoo\Bitcoin\Validator::isValid
     * @dataProvider providerIsValid
     */
    public function testIsValid($address, $testnet, $expected)
    {
        $fixture = new Validator($testnet);
        $this->assertEquals(
            $expected,
            $fixture->isValid($address)
        );
    }

    /**
     * Data provider for testIsValid()
     *
     * @return array
     */
    public function providerIsValid()
    {
        return [
            // Address,                            testnet, is_valid
            ["1Headz2mYtpBRo6KFaaUEtcm5Kce6BZRJM", false,   true],
            ["1JBKAM8W9jEnuGNvPRFjtpmeDGvfQx6PLU", false,   true],
            ["1Lh2BVGJhat9bhH8e1u2w4VokGBVLFD7eR", false,   true],
            ["1LH2BVGJhat9bhH8e1u2w4VokGBVLFD7eR", false,   false],
            ["LheadzBgTNAitxYxUTUTTQ3RT7zR5jnkfq", false,   false],
            ["mibNyNV8UNGrW7ySMS4htmvAGkhC1vVmAe", false,   false],
            ["mibNyNV8UNGrW7ySMS4htmvAGkhC1vVmAe", true,    true],
            ["mpPC2P86pS6DBGveP8LYqk1xj5Ekx5cavz", true,    true],
            ["mppC2P86pS6DBGveP8LYqk1xj5Ekx5cavz", true,    false],
            ["1Headz2mYtpBRo6KFaaUEtcm5Kce6BZRJM", true,    false],
            ["LheadzBgTNAitxYxUTUTTQ3RT7zR5jnkfq", true,    false]
        ];
    }
}
