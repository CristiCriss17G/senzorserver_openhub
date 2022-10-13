<?php
define('DB_FILE', 'local_db.txt');

if (!class_exists('local_db')) {
    class local_db
    {
        public function connect()
        {
            return fopen(DB_FILE, 'a+');
        }

        /**
         * Function to write a new line based on an associative array serialized
         * @param array $data
         */
        public function write($data)
        {
            $db = $this->connect();
            $line = serialize($data);
            fwrite($db, $line . PHP_EOL);
            fclose($db);
        }

        /**
         * Function to read all lines from the database and return an array of associative arrays
         * @return array
         */
        public function read()
        {
            $db = $this->connect();
            $i = 0;
            $lines = array();
            while ($line = fgets($db)) {
                // add to each line the line number
                $lines[$i++] = unserialize($line);
            }
            fclose($db);
            return $lines;
        }
    }
}
