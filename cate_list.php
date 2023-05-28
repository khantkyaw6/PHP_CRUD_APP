<?php

include('./db_connection.php');

$stm = $conn->query('select * from category_list');
$stm->execute();

$result = $stm->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    foreach ($result as $key => $cate) :
    ?>
        <tr>
            <th><?php echo $key + 1 ?></th>
            <td><?php echo $cate['name'] ?></td>
            <td><?php echo $cate['description'] ?></td>
            <td><?php
                echo   $cate['status'] == 1 ?  "Active" : 'Inactive'
                ?></td>
            <td>
                <a href='./cate_update.php?id=<?php echo $cate['id'] ?>' class="btn btn-success">
                    Edit
                </a>

                <a href="./cate_delete.php?id=<?php echo $cate['id'] ?>" class="btn btn-danger">
                    Delete
                </a>

            </td>
        </tr>

    <?php endforeach; ?>


</body>

</html>