<?php

/**
 * Class RandomStringGenerator
 * @package utils
 *
 * Solution taken from here:
 * http://stackoverflow.com/a/13733588/1056679
 */
class RandomStringGenerator
{
    /** @var string */
    protected static $alphabet;

    /** @var int */
    protected static $alphabetLength;


    /**
     * @param string $alphabet
     */
    //public function __construct($alphabet = '')
    public static function init($alphabet = '')
    {
        if ('' !== $alphabet) {
            RandomStringGenerator::setAlphabet($alphabet);
        } else {
            RandomStringGenerator::setAlphabet(
                implode(range('a', 'z'))
                . implode(range('A', 'Z'))
                . implode(range(0, 9))
            );
        }
    }

    /**
     * @param string $alphabet
     */
    public static function setAlphabet($alphabet)
    {
        RandomStringGenerator::$alphabet = $alphabet;
        RandomStringGenerator::$alphabetLength = strlen($alphabet);
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generate($length)
    {
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $randomKey = RandomStringGenerator::getRandomInteger(0, RandomStringGenerator::$alphabetLength);
            $token .= RandomStringGenerator::$alphabet[$randomKey];
        }

        return $token;
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    protected static function getRandomInteger($min, $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }
}