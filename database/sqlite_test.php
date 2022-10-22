<?php

require_once 'my_sqlite_class.php';

function highlight_array($array, $name = 'var') {
   highlight_string("<?php\n\$$name =\n" . var_export($array, true) . ";\n?>");
}

$db = new my_sqlite3();
$db->maybe_create_table(
   "variousdata",
   array(
      'ID' => array('type' => 'INTEGER', 'options' => array('primary_key', 'auto_increment')),
      'varchartext' => array('type' => 'VARCHAR(255)'),
      'post_content' => array('type' => 'TEXT'),
      'date' => array('type' => 'DATE'),
      'time' => array('type' => 'TIME'),
      'timestamp' => array('type' => 'TIMESTAMP'),
      'boolean' => array('type' => 'BOOLEAN'),
      'float' => array('type' => 'REAL'),
   )
);

$db->insert(
   "variousdata",
   array(
      'varchartext' => 'This is a varchar',
      'post_content' => 'This is a text',
      'date' => '2013-01-01',
      'time' => '12:00:00',
      'timestamp' => '2013-01-01 12:00:00',
      'boolean' => true,
      'float' => floatval('2.234174156789'),
   )
);

highlight_array($db->get_results("SELECT * FROM variousdata"));

// echo $db->my_last_error;

// print_r($db->insert('objects', array('post_title'=>'Abstraction Test', 'post_content' => 'Abstraction test content')));
// highlight_array($db->update('objects', array('post_title'=>'Abstraction Test Update', 'post_content' => 'Abstraction test update content'), array('ID'=>1)), 'update');
// highlight_array($db->get_results("SELECT * FROM objects"),"query_results");
// highlight_array($db->get_row("SELECT * FROM objects"),"query_row");
// print_r($db->delete('objects', 9));
