<?php

//---------Using the insert() function---------

$delete_array = array(
    'set_delete_id' => $_POST["delete_id"],
);

$db->delete(
    'DELETE FROM insert_table WHERE 
    insert_id =:set_delete_id',
    $delete_array
);
