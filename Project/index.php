<!-- $sql = "INSERT INTO `notes` (`Srno`, `Title`, `Description`, `TimeStamp`) VALUES (NULL, 'Attend Lecture', 'attend the lecture as well the practicals to score well in the exams', current_timestamp()); "; -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$insert = false;
$update = false;
$delete = false;
$cont = mysqli_connect($servername,$username,$password,$database);
if (!$cont) {
    die("Sorry we failed to connect".mysqli_connect_error());
}
if (isset($_GET['delete'])) {
    $srno = $_GET['delete'];
    // $delete = true;
    $sql = "DELETE FROM `notes` WHERE `notes`.`Srno` = $srno";
    $result = mysqli_query($cont,$sql);
    if ($result) {
        $delete = true;
    } 

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        $title = $_POST['titleEdit'];
        $description = $_POST['descriptionEdit'];
        $srno = $_POST['snoEdit'];
        $sql = "UPDATE `notes` SET `Title` = '$title',`Description` = '$description' WHERE `notes`.`Srno` =$srno; ";
        $result = mysqli_query($cont,$sql);
        if ($result) {
            $update = true;
        } 

        }
    else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $sql = "INSERT INTO `notes` (`Title`, `Description`) VALUES ('$title', '$description');";
        $result = mysqli_query($cont,$sql);
        if ($result) {
            $insert = true;
            // echo "record inserted created";
        } else {
            echo "record not  inserted created".mysqli_error($cont) ;
        }
            }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Make Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
</head>

<body>
    <!-- edit modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
Edit ModalLabel
</button> -->

    <!-- edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editModalLabel">Edit this note</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/Project/index.php" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <h5 class="card-title my-3">Add a title</h5>
                            <input type="text" class="form-control" id="titleEdit" aria-describedby="title" placeholder="Enter a title"
                                name="titleEdit">
                        </div>
                        <h5 class="card-title my-3">Add a Description</h5>
                        <div class="input-group">
            
                            <textarea class="form-control" aria-label="With textarea" id="descriptionEdit"
                                name="descriptionEdit"></textarea>
                        </div>
                        <button class="btn btn-primary my-3" id="addBtn">Update Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid" style="color: whitesmoke;">
            <a class="navbar-brand" href="#">MakeNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input id="searchTxt" class="form-control me-2" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has been inserted Succcessfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>" ;
    }
    ?>
    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has been updated Succcessfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>" ;
    }
    ?>
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has been deleted Succcessfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>" ;
    }
    ?>
    <div class="container my-3">
        <h1>Welcome to Make Notes</h1>
        <!-- <div class="card"> -->
        <!-- <div class="card-body"> -->
        <form action="/Project/index.php" method="post">
            <div class="form-group">
                <h5 class="card-title my-3">Add a title</h5>
                <input type="text" class="form-control" id="title" aria-describedby="title" placeholder="Enter a title"
                    name="title">
            </div>
            <h5 class="card-title my-3">Add a Description</h5>
            <div class="input-group">

                <textarea class="form-control" aria-label="With textarea" id="description"
                    name="description"></textarea>
            </div>
            <button class="btn btn-primary my-3" id="addBtn">Add Note</button>
        </form>
        <!-- </div> -->

        <h1>Your Notes</h1>

        <div id="notes" class="row container-fluid">

            <table id="myTable" class="table my-3">
                <thead>
                    <tr>
                        <th scope="col">Srno</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($cont,$sql);
                $num = mysqli_num_rows($result);

                if ($num>0) {
                    $srno=1;
                    while($row = mysqli_fetch_assoc($result)){
                        // echo var_dump(($row));
                        //  echo $row['Srno']." Title is ". $row['Title'] . " and Description is ".$row['Description'];
                        // echo"<br>";
                        echo "<tr>
                                <th scope='row'>".$srno."</th>
                                <td>".$row['Title']."</td>
                                <td>".$row['Description']."</td>
                                <td><button class='btn btn-sm btn-primary edit' id=".$row['Srno'].">Edit</button><button id=d".$row['Srno']." class=' mx-3 btn btn-sm btn-primary delete'>Delete</button></td>
                              </tr>";
                        $srno++;
                        
                    }
                }
                     ?>
                </tbody>
            </table>
        </div>

        <!-- </div> -->
    </div>
    <hr>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                description = tr.getElementsByTagName('td')[1].innerText;
                console.log(tr,title,description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');

            })
        })


        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                console.log("delete ");
                srno = e.target.id.substr(1,);
                if (confirm("Are you sure you want to delete it!")) {
                    console.log("yes");
                    window.location = `/Project/index.php?delete=${srno}`;
                } else {
                    console.log("no");
                }

            })
        })
        </script>
</body>

</html>