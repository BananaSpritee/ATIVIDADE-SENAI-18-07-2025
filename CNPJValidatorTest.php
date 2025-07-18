<?php

use PHPUnit\Framework\TestCase;

require_once 'CNPJValidator.php';

class CNPJValidatorTest extends TestCase{

    /**
    * @dataProvider provideCnpjsParaValidacao
    */

    public function testIsValid(string $cnpj, bool $expectedResult){

        $validator = new CNPJValidator();
        $result = $validator->isValid($cnpj);

        $this->assertSame($expectedResult, $result, "Falha ao validar o CNPJ: {$cnpj}");

    }

    public static function provideCnpjsParaValidacao(){

        return [

            'CNPJ válido sem máscara' => ['11444777000161', true],
            'CNPJ válido com máscara' => ['11.444.777/0001-61', true],
            'CNPJ inválido (todos os dígitos iguais)' => ['11111111111111', false],
            'CNPJ inválido (dígitos verificadores errados)' => ['11444777000162', false],
            'CNPJ inválido (comprimento incorreto)' => ['12345', false],
            'String vazia' => ['', false],

        ];

    }

}