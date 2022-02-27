<?php

//---------Using the insert() function---------

$set_array = array(
    'set_insert_value' => $_POST["Value"],
    "set_activate" => 1
);

$db->insert(
    'INSERT INTO insert_table SET 
    insert_value =:set_insert_value,
    activate =:set_activate',
    $set_array
);
