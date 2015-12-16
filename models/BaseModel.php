<?php
class Model
{
    protected static $dbc;
    protected static $table;

    // Array to store our key/value data
    private $attributes = [];

    /*
     * Constructor
     */
    public function __construct()
    {
        self::dbConnect();
    }

    /*
     * Connect to the DB
     */
    protected static function dbConnect()
    {
        if (!self::$dbc)
        {
            // @TODO: Connect to database
            require "../database/dbconnect.php";
            self::$dbc = $dbc;
        }
    }

    // Magic setter to populate $contacts array
    public function __set($name, $value)
    {
        // Set the $name key to hold $value in $data
        $this->attributes[$name] = $value;
    }

    // Magic getter to retrieve values from $data
    public function __get($name)
    {
        // Check for existence of array key $name
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }

        return null;
    }

    public function save()
    {
    	if (!empty($this->attributes))
    	{
    		if(isset($this->attributes['id']))
    		{
    			$this->update($this->attributes['id']);
    		} else
    		{
    			$this->insert();
    		}
    	}
    }

    protected function insert()
    {
        $newKeysArray = [];
        $keysArray = array_keys($this->attributes);

		$insert_table = "INSERT INTO " . static::$table . " (";
		$insert_table .= implode(', ', $keysArray);
		$insert_table .= ") VALUES (";
        foreach ($keysArray as $key) { $newKeysArray[] = ':'.$key; }
		$insert_table .= implode(', ', $newKeysArray);
		$insert_table .= ");";

		$stmt = self::$dbc->prepare($insert_table);

        foreach ($this->attributes as $key => $value) { $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR); }
		
		$stmt->execute();

    }

    protected function update($id)
    {
        $updateArray = [];
        $table = static::$table;

        foreach ($this->attributes as $key => $value)
        {
            $update = $key . ' = :' . $key;
            array_push($updateArray, $update);
        }

        $update_table = implode(', ', $updateArray);
        $update_table = "UPDATE $table SET $update_table WHERE id = :id";

        $stmt = self::$dbc->prepare($update_table);
        foreach ($this->attributes as $key => $value)
        {
            $stmt->bindValue(':' . $key, $this->attributes[$key], PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
    }

    /*
     * Find a record based on an id
     */
    public static function find($id)
    {
        // Get connection to the database
        self::dbConnect();
        $table = static::$table;
        // @TODO: Create select statement using prepared statements
        $query = "SELECT * FROM $table WHERE id = :id";
        // @TODO: Store the resultset in a variable named $result
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
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

    public static function getTableName()
    {
    	return static::$table;
    }

    /*
     * Find all records in a table
     */
    public static function all()
    {
        self::dbConnect();
        $table = static::$table;
        $query = "SELECT * FROM $table";
        $stmt = self::$dbc->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // @TODO: Learning from the previous method, return all the matching records
        return $results;
    }

    public function getAttributes()
    {
    	return $this->attributes;
    }

    public static function delete($id)
    {
        // Get connection to the database
        self::dbConnect();
        $table = static::$table;
        // @TODO: Create select statement using prepared statements
        $query = "DELETE FROM $table WHERE id = :id";
        // @TODO: Store the resultset in a variable named $result
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}




