<?php

namespace App\classes;

/**
 * Description of Validator
 */
class Validator
{
    /**
     * @param int $input
     * @return array
     */
    public function numeric($input)
    {
        $exp = "/^[0-9]+$/";
        $input = trim($input);
        $res = preg_match($exp, $input);
        $error = false;

        if(!$res) {
            $error = 'This field must be a number.';
        }
        
        return ['data' => $input, 'error' => $error];
    }

    /**
     *
     * @param string $data
     * @return string
     */
    public function testInput($data)
    {
        $data = trim($data);
        $data = str_replace("'", '#', $data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /**
     *
     * @param string $data
     * @return array
     */
    public function required($data)
    {
        $data = $this->TestInput($data);
        $error = false;

        if(!$data) {
            $error = 'This field is required.';
        }

        return ['data' => $data, 'error' => $error];
    }
}