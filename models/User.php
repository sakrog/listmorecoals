<?php 
require_once "Input.php";
require_once "BaseModel.php";
require_once "Auth.php";

class User extends Model
{
	protected static $table = 'users';

	public static function findUserByUsername($username)
	{
		self::dbConnect();
        $table = static::$table;
        $query = "SELECT * FROM $table WHERE username = :username";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // The following code will set the attributes on the calling object based on the result variable's contents

        $instance = null;
        if ($result)
        {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
	}

    public static function findUserByEmail($email)
    {
        self::dbConnect();
        $table = static::$table;
        $query = "SELECT * FROM $table WHERE email = :email";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $instance = null;
        if($result)
        {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }

    public static function ifUserExists($email)
    {
        $user = self::findUserByEmail($email);
        if($user){
            throw new Exception('Email has already been used, please use a new email');
        }
    }
}