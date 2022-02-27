<?php
//Connect database
require 'basic_database_operations.php';
$db = new basic_database_process();
//Connect database

error_reporting(0);
if ($_POST["insert"]) { //Click Insert Button
    require_once 'insert.php';
    echo '<br>';
    echo '<u>Insert is succesfully</u>';
    $insert_success = "Success";
} elseif ($_POST["update"]) { //Click Update Buttoon
    require_once("update.php");
    echo '<br>';
    echo '<u>Update is succesfully</u>';
    $update_success = "Success";
} elseif ($_POST['delete']) { //Click Delete Button
    require_once 'delete.php';
    echo '<br>';
    echo '<u>Delete is succesfully</u>';
    $delete_success = "Success";
}

$value_list = $db->get_all_object('SELECT * FROM insert_table order by insert_id desc', array()); //Table value

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <form action="" method="post">
        <u><b><label for="">Insert Example</label></b></u>
        <br>
        <br>
        <label for="">Insert Value: </label>
        <input type="text" name="Value" id="" required>
        <br>
        <input type="submit" name="insert" value="Insert" >
        <label for=""><?= $insert_success ?></label>
    </form>
    <br>
    <br>
    <form action="" method="post">
        <u><b><label for="">Update Example</label></b></u>
        <br>
        <br>

        <label for="">Update ID:</label>
        <input type="text" name="update_id" id="" required>
        <br>
        <label for="">Update Value:</label>
        <input type="text" name="update_value" id="" required>
        <br>
        <input type="submit" name="update" value="Update">
        <label for=""><?= $update_success ?></label>

    </form>
    <br>
    <br>
    <form action="" method="post">
        <u><b><label for="">Delete Example</label></b></u>
        <br>
        <br>
        <label for="">Delete ID:</label>
        <input type="text" name="delete_id"  id="" required>
        <br>
        <input type="submit" name="delete" value="Delete">
        <label for=""><?= $delete_success ?></label>

    </form>
    <br>
    <br>
    <b><label for="">Data extraction example</label></b>
    <br>
    <br>
    <div class="col-12 mb-30">
        <div class="box">
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Value</th>
                                <th>Date</th>
                                <th>Activation</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($value_list as $value) { ?>

                                <tr>
                                    <td><?= $value->insert_id ?></td>
                                    <td><?= $value->insert_value ?></td>
                                    <td><?= $value->insert_date ?></td>
                                    <td><?= ($value->activate == 1) ? "Active" : "Deactive" ?></td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</body>

</html>