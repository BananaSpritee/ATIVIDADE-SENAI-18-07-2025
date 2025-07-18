<?php

class CNPJValidator
{
    public function isValid(string $cnpj): bool
    {

        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) !== 14) {
            return false;
        }

        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }

        $cnpjBase = substr($cnpj, 0, 12);
        $primeiroDigito = $this->calcularDigito($cnpjBase, [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);
        $segundoDigito = $this->calcularDigito($cnpjBase . $primeiroDigito, [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);

        return $cnpj === ($cnpjBase . $primeiroDigito . $segundoDigito);
    }

    private function calcularDigito(string $base, array $pesos): string
    {
        $soma = 0;

        foreach (str_split($base) as $i => $digito) {
            $soma += intval($digito) * $pesos[$i];
        }

        $resto = $soma % 11;

        return ($resto < 2) ? '0' : strval(11 - $resto);
    }
}

?>