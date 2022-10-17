<?php

require_once 'local_db.php';

if (!class_exists('local_db_secure')) {
    class local_db_secure extends local_db
    {

        // constructor
        public function __construct($_file, $_mode)
        {
            // call parent constructor
            parent::__construct($_file, $_mode);
        }

        public function write($data)
        {
            $db = $this->connect();
            $line = base64_encode(serialize($data));
            fwrite($db, $line . PHP_EOL);
            fclose($db);
        }

        public function read()
        {
            $db = $this->connect();
            $i = 0;
            $lines = array();
            while ($line = fgets($db)) {
                // add to each line the line number
                $lines[$i++] = unserialize(base64_decode($line));
            }
            fclose($db);
            return $lines;
        }
    }
}
