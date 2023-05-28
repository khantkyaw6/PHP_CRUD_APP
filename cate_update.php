<?php

include('./db_connection.php');

$id = $_GET['id'];
$stm = $conn->query("select * from category_list where id=$id");

$result = $stm->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";

// var_dump($result);

echo "</pre>";

if (isset($_POST["updateBtn"])) {
    $category_updatename = $_POST['catgory_name'];
    $category_updatedesc = $_POST['category_desc'];
    $category_updatestatus = $_POST['category_status'];
    $data = [
        "id" => $id,
        "name" => $category_updatename,
        "description" => $category_updatedesc,
        "status" => $category_updatestatus
    ];

    $cate_sate = '';
    $category_updatestatus ? ($cate_sate = 'active') : ($cate_sate = 'inactive');

    var_dump($category_name && $category_desc);

    if ($category_updatename && $category_updatedesc && $cate_sate) {
        try {
            $query = "UPDATE category_list SET name=:name,description=:description,status=:status WHERE id=:id";

            $stm = $conn->prepare($query);
            $result = $stm->execute($data);

            if (!empty($result)) {
                header("Location: index.php");
            }
        } catch (Exception $ex) {
            echo "Error";
        }
    } else {
        echo "error";
    }
}





?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container  my-5">
        <div class="row">

            <div>
                <h3>Category Create</h3>
                <form method="post">
                    <div class=" mb-3 ">
                        <label for=" exampleFormControlInput1" class="form-label">Category Name: </label>
                        <input value=" <?php echo $result[0]['name']  ?>" required type="text" name='catgory_name' class="form-control" placeholder="Enter Category Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Category Descripion: </label>
                        <textarea name="category_desc" required class="form-control" placeholder="Enter Category Description" id="exampleFormControlTextarea1" rows="3"><?php echo $result[0]['description']  ?></textarea>
                    </div>
                    <div class="mb-3 ">
                        <label for="exampleFormControlInput1" class="form-label">Category Status: </label>
                        <select required name="category_status" class="form-select" aria-label="Default select example">
                            <option selected>Select Status</option>
                            <option <?php if ($result[0]['status'] == 1) echo "selected" ?> value=1>Active</option>
                            <option <?php if ($result[0]['status'] == 0) echo "selected"  ?> value=0>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" name='updateBtn' class="btn btn-info">Update</button>
                </form>
            </div>

        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>