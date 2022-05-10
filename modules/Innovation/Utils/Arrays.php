<?php

namespace Innovation\Utils;

class Arrays
{
    /**
     * @param array $array
     * @return int
     */
    public static function getArrayAsValue(array $array): int
    {
        $encodedValue = 0;
        foreach ($array as $value) {
            $encodedValue += pow(2, $value);
        }
        return $encodedValue;
    }

    /**
     * @param int $encoded_value
     * @return array
     */
    public static function getValueAsArray(int $encoded_value): array
    {
        $array = [];
        $value = 0;
        while ($encoded_value > 0) {
            if ($encoded_value % 2 == 1) {
                $array[] = $value;
            }
            $encoded_value /= 2;
            $value++;
        }
        return $array;
    }

    /**
     * Encodes multiple integers into a single integer
     *
     * @param array $array
     * @return int
     */
    public static function getValueFromBase16Array(array $array): int
    {
        // Due to the maximum data value of 0x8000000, only 5 elements can be encoded using this function.
        if (count($array) > 5) {
            throw new \BgaVisibleSystemException("setGameStateBase16Array() cannot encode more than 5 integers at once");
        }
        $encoded_value = 0;
        foreach ($array as $value) {
            // This encoding assumes that each integer is in the range [0, 15].
            if ($value < 0 || $value > 15) {
                throw new \BgaVisibleSystemException("setGameStateBase16Array() cannot encode integers smaller than 0 or larger than 15");
            }
            $encoded_value = $encoded_value * 16 + $value;
        }
        return $encoded_value * 6 + count($array);
    }

    /**
     * Decodes an integer representing multiple integers
     *
     * @param int $encoded_value
     * @return array
     */
    public static function getBase16ArrayFromValue(int $encoded_value): array
    {
        $count = $encoded_value % 6;
        $encoded_value /= 6;
        $return_array = [];
        for ($i = 0; $i < $count; $i++) {
            $return_array[] = $encoded_value % 16;
            $encoded_value /= 16;
        }
        return $return_array;
    }

}
