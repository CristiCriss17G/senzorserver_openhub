<?php
define('DB_FILE', dirname(__FILE__) . '/databases/local_db.txt');

if (!class_exists('local_db')) {
    class local_db
    {
        private $file;
        private $mode;

        // constructor
        public function __construct($_file = DB_FILE, $_mode = 'a+')
        {
            $this->file = $_file;
            $this->mode = $_mode;
        }

        public function connect()
        {
            return fopen($this->file, $this->mode);
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

        /**
         * Function to delete the database file
         */
        public function delete()
        {
            unlink($this->file);
        }
    }
}
