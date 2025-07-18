<?php

use PHPUnit\Framework\TestCase;

require_once 'CNPJValidator.php';

class CNPJValidatorTest extends TestCase
{
    public function testIsValid($cnpj, $expected){

    $dataProvider = [

        "11444777000161" => True,
        "11111111111111" => False,

    ];

        foreach ($dataProvider as $data => $expected){

            $validator = new CNPJValidator($data);
            $isValid = $validator(isValid);
            $this->assertEquals($expected, $validator);

        }
        
    }
}
?>