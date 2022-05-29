<?php

namespace Tests;

use App\NameParser;
use PHPUnit\Framework\TestCase;

class NameParserTest extends TestCase
{
    /**
     * @dataProvider functionalNameProvider
     */
    public function testName($name, $expected_result)
    {
        $parser = new NameParser();
        $split_name = $parser->parse_name($name);
        $this->assertSame($expected_result, $split_name);
    }


    public function functionalNameProvider()
    {
        return array(
            array(
                "Mr John Smith",
                array(
                    array(
                        "title"         => "Mr",
                        "first_name"    => "John",
                        "initial"       => 'null',
                        "last_name"     => "Smith",
                    )
                )
            ),
            array(
                "Mr and Mrs Smith",
                array(
                    array(
                        "title"         => "Mr",
                        "first_name"    => 'null',
                        "initial"       => 'null',
                        "last_name"     => "Smith",
                    ),
                    array(
                        "title"         => "Mrs",
                        "first_name"    => 'null',
                        "initial"       => 'null',
                        "last_name"     => "Smith",
                    )
                )
            ),
            array(
                "Mr J. Smith",
                array(
                    array(
                        "title"         => "Mr",
                        "first_name"    => 'null',
                        "initial"       => "J.",
                        "last_name"     => "Smith",
                    )
                )
            ),
        );
    }

}
