<?php
abstract class Model {
    protected static $dbc;
    protected static $table;
    private $attributes = array();
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
    private static function dbConnect()
    {
        if (!self::$dbc)
        {
            self::$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
    /*
     * Get a value from attributes based on name
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
        return null;
    }
    /*
     * Set a new attribute for the object
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
    /*
     * Persist the object to the database
     */
    public function save()
    {
        $table = static::$table;
        if ($this->id != '') {
            // there is an id key, so we need to update
            // remove the id so it is not part of the update query
            // add it back later
            $id = $this->id;
            unset($this->attributes['id']);
            $columns = array_keys($this->attributes);
            $updateStmt = array_map(function($key){
                return "$key = :$key";
            }, $columns);
            $updateStmt = implode(', ', $updateStmt);
            $query = "UPDATE $table SET $updateStmt WHERE id=$id";
            $stmt = static::$dbc->prepare($query);
            foreach ($this->attributes as $key => $value) {
                $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
            }
            $stmt->execute();
            $this->attributes['id'] = $id;
        } else {
            // no id, so we need to insert
            // without manually sorting the array, mysql does some sort of
            // sorting that screws up the order of the values inserted
            asort($this->attributes);
            $columns = array_keys($this->attributes);
            $paramatizedValues = array_map(function($col){
                return ":$col";
            }, $columns);
            $paramatizedValues = implode(', ', $paramatizedValues);
            $columnNames = implode(', ', $columns);
            $query = "INSERT INTO $table ($columnNames) VALUES ($paramatizedValues)";
            $stmt = static::$dbc->prepare($query);
            // bind each value
            foreach ($this->attributes as $key => $value) {
                $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
            }
            $stmt->execute();
        }
    }
    /*
     * Find a record based on an id
     */
    public static function find($id)
    {
        self::dbConnect();
        $table = static::$table;
        $query = "SELECT * from {$table} WHERE id = :id";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
    /*
     * Find all records in a table
     */
    public static function all()
    {
        self::dbConnect();
        $table = static::$table;
        $myQuery = "SELECT * FROM $table";
        $stmt = self::$dbc->query($myQuery);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
    public static function delete($id)
    {
        self::dbConnect();
        $table = static::$table;
        $query = "DELETE FROM $table WHERE id=$id";
        self::$dbc->query($query);
    }
    public function doStuff()
    {
        echo 'Doing stuff...' . PHP_EOL;
        sleep(1);
        echo 'Working...' . PHP_EOL;
        sleep(2);
        echo 'Done!' . PHP_EOL;
    }
}