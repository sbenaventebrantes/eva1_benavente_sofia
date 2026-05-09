<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidRut implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidRut($value)) {
            $fail('El :attribute debe ser un RUT válido.');
        }
    }

    /**
     * Valida un RUT chileno.
     * Formato: XX.XXX.XXX-X o XXXXXXXX-X
     *
     * @param string $rut
     * @return bool
     */
    private function isValidRut(string $rut): bool
    {
        // Remover puntos y espacios
        $rut = str_replace(['.', ' '], '', $rut);

        // Verificar formato básico (debe tener guión)
        if (strpos($rut, '-') === false) {
            return false;
        }

        // Separar número y dígito verificador
        $partes = explode('-', $rut);
        if (count($partes) !== 2) {
            return false;
        }

        [$numero, $dv] = $partes;

        // Validar que el número sea numérico y el DV sea alfanumérico
        if (!is_numeric($numero) || !preg_match('/^[0-9kK]$/', $dv)) {
            return false;
        }

        // Calcular dígito verificador correcto
        $dvCalculado = $this->calcularDv($numero);

        return strtoupper($dv) === $dvCalculado;
    }

    /**
     * Calcula el dígito verificador de un RUT.
     *
     * @param string $numero
     * @return string
     */
    private function calcularDv(string $numero): string
    {
        $suma = 0;
        $multiplicador = 2;

        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $suma += (int)$numero[$i] * $multiplicador;
            $multiplicador++;

            if ($multiplicador > 7) {
                $multiplicador = 2;
            }
        }

        $resto = $suma % 11;
        $dv = 11 - $resto;

        if ($dv === 11) {
            return '0';
        } elseif ($dv === 10) {
            return 'K';
        } else {
            return (string)$dv;
        }
    }
}
