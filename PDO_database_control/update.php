<?php
//---------Using the update() function---------

$update_array = array(
    "set_update_value" => $_POST["update_value"],
    "set_which_id" => $_POST["update_id"]
);
$db->update(
    "UPDATE insert_table set 
    insert_value =:set_update_value 
    WHERE insert_id=:set_which_id",
    $update_array
);

