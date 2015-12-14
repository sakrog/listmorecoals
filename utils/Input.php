
<?php

class Input
{
    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */

    public static function notEmpty($key) 
    {
        if (isset($_REQUEST[$key]) && $_REQUEST[$key] != '') {
            return true;
        }
    }

    public static function has($key)
    {
        return (isset($_REQUEST[$key]));
    }
    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        return self::has($key)? $_REQUEST[$key] : $default;
    }

    public static function getString($key, $min, $max)
    {
        $string = self::get($key);
        if (preg_match('/[^\s]/', $string)) {
            if(!is_string($string)){
                throw new Exception('Incorrect String Format');
            }
            return $string;
        } else {
            throw new Exception('No string. Try again.');
        }

    }



    public static function getNumber($key)
    {
        $number = self::get($key);
        if (preg_match('/[^\d\.]/', $number)) {
            throw new Exception('Expecting number except no number');
        }
        if (preg_match('/\./', $number)) {
            return (float) $number;
        }
        return (int) $number;
    }

    public static function getDate($key)
    {
        $date = self::get($key);
        if (strtotime($date)) {
            return new DateTime($date);
        }
        throw new Exception('Date format does not work.');
    
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
