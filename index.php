<?php

include('./db_connection.php');

if (isset($_POST['createBtn'])) {

    $category_name = $_POST['catgory_name'];
    $category_desc = $_POST['category_desc'];
    $category_status = $_POST['category_status'];

    $cate_sate = '';
    $category_status ? ($cate_sate = 'active') : ($cate_sate = 'inactive');



    echo $category_name . "<br>";
    echo $category_desc . "<br>";
    echo $category_status . "<br>";
}

if ($category_name && $category_desc && $cate_sate) {
    try {
        $query = "insert into category_list (name,description,status) values (:name,:description,:status)";
        // query prepare 
        $stm = $conn->prepare($query);
        // query result 
        $result = $stm->execute([":name" => $category_name, ":description" => $category_desc, ":status" => $category_status]);
        if (!empty($result)) {
            header('Location: index.php');
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit('Error');
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

            <div class="col-6">
                <h3>Category Create</h3>
                <form method="post">
                    <div class="mb-3 ">
                        <label for="exampleFormControlInput1" class="form-label">Category Name: </label>
                        <input required type="text" name='catgory_name' class="form-control" placeholder="Enter Category Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">ategory Descripion: </label>
                        <textarea name="category_desc" required class="form-control" placeholder="Enter Category Description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3 ">
                        <label for="exampleFormControlInput1" class="form-label">Category Status: </label>
                        <select required name="category_status" class="form-select" aria-label="Default select example">
                            <option selected>Select Status</option>
                            <option value=1>Active</option>
                            <option value=0>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" name='createBtn' class="btn btn-info">Create</button>
                </form>
            </div>
            <div class="col-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php include('./cate_list.php')
                        ?>

                        <!-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>