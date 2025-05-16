<?php
/**
 * Clase para convertir n?meros a letras en escala larga
 * @author Martin Roberto Mondragon; martin@aquainteractive.com.mx
 *
 * Test ::toWord("$100,000,000,000,000,000,000,000,000,000,000,000,000,000,000,000,000,000")
 * Resultado: "cien mil octillones"
 *
 * Test  ::toCurrency("- $15,936,535,897,932,384,626,433,832,795.1988")
 * Resultado: "menos quince mil novecientos treinta y seis cuatrillones
 * quinientos treinta y cinco mil ochocientos noventa y siete trillones
 * novecientos treinta y dos mil trescientos ochenta y cuatro billones
 * seicientos veintis?is mil cuatrocientos treinta y tres millones
 * ochocientos treinta y dos mil setecientos noventa y cinco pesos 20/100 M.N."
 *
 * Test ::toWord("00001.00001")
 * Resultado:  "uno punto cero cero cero cero uno"
 *
 * Referencias:
 * http://es.wikipedia.org/wiki/Escalas_num%C3%A9ricas_larga_y_corta
 * http://es.wikipedia.org/wiki/Nombres_de_los_n%C3%BAmeros_en_espa%C3%B1ol
 */
class AifLibNumber {
    /**
    * Arreglo de palabras representando a las letras
    * [0] Cero y Uno
    * [1] Unidades(1-9) donde 1=>Un, n?meros (10-29) y 100
    * [2] Decenas del (30-90)
    * [3] Centenas(100-900) donde 100 => Ciento
    * [4] Notaci?n larga Cifras cerradas
    * [5] Notaci?n larga para los sufijos..
    * El arreglo 4 y 5 se puede incrementar para soportar numeros superiores
    * @var array
    */
    private static $nStr = array(array('cero', 'uno'),
            array('', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete',
                    'ocho', 'nueve', 'diez', 'once', 'doce', 'trece',
                    'catorce', 'quince', 'diecis?is', 'diecisite', 'dieciocho',
                    'diecinueve', 'veinte', 'veintiuno', 'veintid?s',
                    'veintitr?s', 'veinticuatro', 'veinticinco', 'veintis?is',
                    'veintisiete', 'veintiocho', 'veintinueve', 100 => 'cien'),
            array('', '', '', 'treinta', 'cuarenta', 'cincuenta', 'sesenta',
                    'setenta', 'ochenta', 'noventa'),
            array('', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos',
                    'quinientos', 'seicientos', 'setecientos', 'ochocientos',
                    'novecientos'),
            array('', '', 'mil', 'mill?n', 'mil', 'bill?n', 'mil', 'trill?n',
                    'mil', 'cuatrill?n', 'mil', 'quintill?n', 'mil',
                    'sextill?n', 'mil', 'septill?n', 'mil', 'octill?n'),
            array('', '', 'mil', 'millones', 'mil', 'billones', 'mil',
                    'trillones', 'mil', 'cuatrillones', 'mil', 'quintillones',
                    'mil', 'sextillones', 'mil', 'septillones', 'mil',
                    'octillones', 'mil'));
    /**
    * Obtiene un nombre que respresenta al n?mero en letras
    * @param integer $n N?mero del 0 al 29, 100 y 1000
    * @param integer $c 1=Unidad, 2=Decena y 3=Centena 4,5 Millar y *illones
    * @param integer $l Numero de nivel de agrupaciones de  3 ceros
    * @return string
    */
    private static function _num($n, $c = 1, $l = 1) {
        return ($n == 1 && !($l % 2)) || !$l ? '' : self::$nStr[$c][$n] . ' ';
    }
    /**
    * Convierte recursivamente un numero a letras
    * @param integer $lev Numero de cifras agrupadas en 3: Ej. 100101 = 2
    * @param srting $number N?mero a convetir a letras
    * @return string
    */
    private static function _i2str($lev, $number) {
        $int = intval($num = substr($number, 0, 3));
        $next = substr($number, 3);
        $str = ''; //echo "($lev|$num|$int|$number)<hr>n"; //Debug
        if ($int) {
            if ($int == 100)
                $str = self::_num($int, 1);
            else {
                list($c, $d, $u) = $num;//centenas, decenas y unidad
                $str = $c ? self::_num($c, 3) : '';
                if (($du = (($d * 10) + $u)) < 30)
                    $str .= self::_num($du, $du == 1 && $lev < 2 ? 0 : 1, $lev);
                else {
                    $str .= $d ? self::_num($d, 2) . ($u ? 'y ' : '') : '';
                    $str .= $u ? self::_num($u, $u + $lev < 3 ? 0 : 1) : '';
                }
            }
            $str .= self::_num($lev, $int == 1 && ($lev % 2) ? 4 : 5)
                    . (preg_match('/^000+/', $next) ? self::_num($lev - 1, 5,
                                    !($lev % 2)) : '');
        }
        return $lev ? ($str . self::_i2str($lev - 1, $next)) : '';
    }
    /**
    * Convierte una cadena numerica o numero a letras
    * @param string $number
    * @return boolean|string
    */
    public static function toWord($number) {
        $less = preg_match('/^-/', $number);
        $number = preg_replace('/[^0-9.]/', '', $number);
        if (preg_match('/^(d{1,54})$/', $number)) {
            $lev = (floor(strlen($number) / 3) + 1);
            $number = str_pad($number, ($lev * 3), '0', STR_PAD_LEFT);
            $result = self::_i2str($lev, $number);
            $result || ($result = self::_num(0, 0));
        } elseif (preg_match('/^d{1,54}.d{1,54}$/', $number)) {
            list($number, $decimal) = explode('.', $number);
            $result = self::toWord($number) . ' punto ';
            for ($i = 0; $i < (strlen($decimal) - 1); $i++) {
                if ($decimal[$i])
                    break;
                $result .= self::_num(0, 0);
            }
            $result .= self::toWord($decimal);
        }
        return isset($result) ? ($less ? 'menos ' : '') . $result : FALSE;
    }
    /**
    * Convierte una cifra tipo moneda a letras
    * @param string $number
    * @return boolean|string
    */
    public static function toCurrency($number) {
        $number = preg_replace('/[^0-9.-]/', '', $number);
        if (preg_match('/^[-]{0,1}(d{1,54})$/', $number))
            $number .= '.00';
        elseif (!preg_match('/^[-]{0,1}d{1,54}.d{1,54}$/', $number))
            return FALSE;
        list($number, $decimal) = explode('.', $number);
        $number = self::toWord($number);
        if (!$number)
            return FALSE;
        if (preg_match('/(llones|ll?n)$/', $number))
            $number .= ' de pesos ';
        else
            $number = preg_match('/uno$/', $number) ? (preg_replace('/uno$/',
                            '', $number) . ' un peso ') : ($number . ' pesos ');
        $decimal = round($decimal[0] . $decimal[1] . '.' . substr($decimal, 2));
        return $number . $decimal . '/100 M.N.';
    }
}