<?php


define('DB_NAME', 'databases/senzorRebooters.db');

if (!class_exists('SQLite3'))
    die("SQLite 3 NOT supported.");

if (!class_exists('my_sqlite3')) {
    class my_sqlite3 extends SQLite3
    {
        private $accepted_column_types = array('INTEGER', 'REAL', 'VARCHAR', 'TEXT', 'BLOB', 'NUMERIC', 'BOOLEAN', 'DATE', 'TIME', 'TIMESTAMP');
        public $my_last_error = '';

        function __construct()
        {
            $this->open(DB_NAME);
        }

        /**
         * Create a table if it doesn't exist
         * @param string $table_name The name of the table to create
         * @param array $column An associative array of columns with associative arrays of types and options
         * @param string $args Any additional arguments to pass to the CREATE TABLE query
         * @return bool
         */
        public function maybe_create_table( $table_name, $columns, $args="" )
        {
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (";
            $create_ddl = "";
            foreach ($columns as $column => $attributes) {
                // filter $attributes['type'] for security to only accept valid types
                $attributes['type'] = strtoupper($attributes['type']);
                // and special check for varchar as it can contain a length
                if (!in_array($attributes['type'], $this->accepted_column_types) && strpos($attributes['type'], 'VARCHAR') === false) {
                    $this->my_last_error = "Invalid column type: " . $attributes['type'];
                    return false;
                }

                // check $attributes['options']
                $column_options = "";
                if (isset($attributes['options'])) {
                    foreach ($attributes['options'] as $option) {
                        switch($option) {
                            case 'primary_key':
                                $column_options .= " PRIMARY KEY";
                                break;
                            case 'not_null':
                                $column_options .= " NOT NULL";
                                break;
                            case 'unique':
                                $column_options .= " UNIQUE";
                                break;
                            case 'auto_increment':
                                $column_options .= " AUTOINCREMENT";
                                break;
                            default:
                                $this->my_last_error = "Invalid column option: " . $option;
                                return false;
                        }
                    }
                }
                $create_ddl .= "$column {$attributes['type']} {$column_options}, ";
            }
            $create_ddl = rtrim($create_ddl, ", ");
            $sql .= $create_ddl . $args . ");";
            $this->exec($sql);
            // var_dump($sql);
            $this->my_last_error = $this->lastErrorMsg();
            return true;
        }

        /**
         * Run a query and return the results
         * @param string $query The query to run
         * @return array
         */
        public function myquery($query)
        {
            $result = $this->query($query);

            $results = array();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $results[] = $row;
            }

            return $results;
        }

        /**
         * Insert a row into a table
         * @param string $table_name The name of the table to insert into
         * @param array $data An associative array of data to insert
         * @return bool
         */
        public function insert($table, $data)
        {
            // Check for $table or $data not set
            if (empty($table) || empty($data)) {
                return false;
            }

            // Cast $data and $format to arrays
            $data = (array) $data;

            $fields = implode(', ', array_keys($data));

            // create a array of placeholders of the same length as $fields, with each placeholder having the :{param_name} format
            $placeholders_array = array_map(function ($field) {
                return ':' . $field;
            }, array_keys($data));

            $placeholders = implode(', ', $placeholders_array);

            $stmt = $this->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");

            // create array of datatypes for SQLite3 bindValue function
            $types = array_map(function ($value) {
                if (is_int($value)) {
                    return SQLITE3_INTEGER;
                } elseif (is_float($value)) {
                    return SQLITE3_FLOAT;
                } elseif (is_string($value)) {
                    return SQLITE3_TEXT;
                } else {
                    return SQLITE3_BLOB;
                }
            }, $data);

            // bind values to the statement
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value, $types[$key]);
            }

            // execute the query
            $result = $stmt->execute();

            // check if successful
            if ($result === false) {
                return false;
            }

            return true;

        }

        /**
         * Update entries in the database
         * @param string $table The name of the table to update
         * @param array $data An associative array of columns and values to update
         * @param array $where An associative array of columns and values to use for the WHERE clause
         */
        public function update($table, $data, $where)
        {
            // Check for $table or $data not set
            if (empty($table) || empty($data)) {
                return false;
            }

            // Cast $data and $format to arrays
            $data = (array) $data;


            //Format where clause
            $where_clause = '';
            $count = 0;

            foreach ($where as $key => $value) {
                if ($count > 0) {
                    $where_clause .= ' AND ';
                }
                $where_clause .= $key . ' = :w' . $key;
                $count++;
            }

            //Format data
            $placeholders = '';
            $count = 0;

            foreach ($data as $key => $value) {
                if ($count > 0) {
                    $placeholders .= ', ';
                }
                $placeholders .= $key . ' = :' . $key;
                $count++;
            }

            $stmt = $this->prepare("UPDATE {$table} SET {$placeholders} WHERE {$where_clause}");

            // create array of datatypes for SQLite3 bindValue function for data
            $types = array_map(function ($value) {
                if (is_int($value)) {
                    return SQLITE3_INTEGER;
                } elseif (is_float($value)) {
                    return SQLITE3_FLOAT;
                } elseif (is_string($value)) {
                    return SQLITE3_TEXT;
                } else {
                    return SQLITE3_BLOB;
                }
            }, $data);

            // bind values to the statement
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value, $types[$key]);
            }

            // create array of datatypes for SQLite3 bindValue function for where
            $wtypes = array_map(function ($value) {
                if (is_int($value)) {
                    return SQLITE3_INTEGER;
                } elseif (is_float($value)) {
                    return SQLITE3_FLOAT;
                } elseif (is_string($value)) {
                    return SQLITE3_TEXT;
                } else {
                    return SQLITE3_BLOB;
                }
            }, $where);

            // bind where values to the statement
            foreach ($where as $key => $value) {
                $stmt->bindValue(':w' . $key, $value, $wtypes[$key]);
            }

            // execute the query
            $result = $stmt->execute();

            // check if successful
            if ($result === false) {
                return false;
            }

            return true;
        }

        public function get_results($query)
        {
            return $this->myquery($query);
        }

        public function get_row($query)
        {
            $results = $this->myquery($query);

            return $results[0];
        }

        public function delete($table, $id)
        {
            // Prepary our query for binding
            $stmt = $this->prepare("DELETE FROM {$table} WHERE ID = :id");

            // Dynamically bind values
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

            // execute the query
            $result = $stmt->execute();

            // check if successful
            if ($result === false) {
                return false;
            }

            return true;
        }
    }
}

