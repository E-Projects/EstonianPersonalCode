<?php

namespace EProjects\EstonianPersonalCode;

/**
 * Class for Personal Code validation
 *
 * @author    Laurynas Gavienas
 * @copyright 2015 Laurynas Gavienas / E-Projects (http://www.e-projects.lt)
 * @licence   http://www.opensource.org/licenses/mit-license.php MIT
 */
class Validator
{

    private static $multiplier = array(
        array(1, 2, 3, 4, 5, 6, 7, 8, 9, 1),
        array(3, 4, 5, 6, 7, 8, 9, 1, 2, 3),
    );

    /**
     * Checks personal code for validity
     *
     * Validates length, symbols and checksum of the input.
     *
     * @param PersonalCodeInterface $personalCode
     *
     * @return bool
     */
    public static function isValid(PersonalCodeInterface $personalCode)
    {
        $id = $personalCode->getId();
        if (strlen($id) !== 11 || ! ctype_digit($id)) {
            return false;
        }

        return (int) substr($id, 10, 1) === self::getChecksum($id);
    }

    /**
     * Retrieves checksum of personal code
     *
     * @param mixed $input
     *
     * @return int
     */
    private static function getChecksum($input)
    {
        $total = 0;
        for ($i = 0; $i < 10; $i ++) {
            $total += (int) substr($input, $i, 1) * self::$multiplier[0][$i];
        }

        $modulus = $total % 11;

        $total = 0;
        if (10 === $modulus) {
            for ($i = 0; $i < 10; $i ++) {
                $total += (int) substr($input, $i, 1) * self::$multiplier[1][$i];
            }
            $modulus = $total % 11;
            if (10 === $modulus) {
                $modulus = 0;
            }
        }

        return $modulus;
    }
}
