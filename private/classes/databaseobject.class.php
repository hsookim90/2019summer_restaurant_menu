<?php

class DatabaseObject {

/*
  General database query methods
	@author Glenn <jayasugp@myumanitoba.ca>
*/

  static protected $database;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];


  // @param mysqli $database Object returned after DB connect
  static public function set_database($database) {
    self::$database = $database;
  }

  // @param String $sql
  // @return Array $object_array of objects
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  // Get all the rows of a table as an array of objects
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  // @param Int $id The row's corresponding id in DB
  // @return Object on success
  // @return false on failure
  static public function find_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  // Sets the global variables for the class to match DB col values
  // @param Associative Array $record DB row
  // @return Object $object
  static protected function instantiate($record) {
    $object = new static;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  // Makes sure global variables are acceptable
  // Child classes should override this function
  protected function validate() {
    $this->errors = [];
    return $this->errors;
  }

  // Creates a record in the DB of the values of this instance
  // @return False on failure
  // @return True if object succesfully created in DB
  protected function create() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  // Updates a record in the DB with the values of this instance
  // @return False on failure
  // @return True on succesfully updating a row
  protected function update() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  // Updates or creates a new row based on whether the instance has an id
  // If an id exists the object is already in the DB
  // @return True or False on successful sql query
  public function save() {
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  // Sets global variables to associative array
  // @param associative array $args Usually from html array from POST request
  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  // Get the global variables that represent the cols of a DB as a array
  // @return  Associative array, key of col names and value of instance global var
  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  // Escapes each attribute to prevent sql injection
  // @return Associative array of escaped attributes
  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  // Deletes a record in the DB with the values of this instance
  // @return True or False on succesfully deleting row
  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  // TODO not done
  public function find_restaurant_items($restID)
  {
    $sql = "SELECT * FROM item_restaurant ";
    $sql .= "INNER JOIN item_restaurant on menu_item.id = item_restaurant.";
    $sql .= "INNER JOIN menu_item on item_restaurant.restaurant_id = ";
  }
}
?>
