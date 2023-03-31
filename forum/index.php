<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lets Discuss - A leading Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 50vh;
        }

        @media screen and (max-width: 480px) {

            #login {
                margin: 15px;
                /* font-size: 23px; */
            }

            #signin {
                margin: 15px;
                /* font-size: 23px; */
            }

            #ques {
                margin: 8%;
            }
            #catTitle{
                margin-right: 69px;            }

        }

        @media screen and (max-width: 991px) {

            #login {
                margin: 15px;
                /* font-size: 23px; */
            }

            #signin {
                margin: 15px;
                /* font-size: 23px; */
            }
            #ques {
                margin: 8%;
            }
            
        }
    </style>
</head>

<body>
    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>
    <!-- Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1300x400/?code,apple" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1300x400/?programming,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1300x400/?microsoft,coding" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Category container starts here -->
    <div class="container my-4" id="ques">
        <h2 class="text-center my-4" id="catTitle">Lets Discuss - Browse Categories</h2>
        <div class="row my-4">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            // <!-- use a for loop to iterate to all the categories -->

            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['category_id'];
                $cat_name = $row['category_name'];
                $cat_desc = $row['category_description'];
                echo '<div class="col-md-4 my-3">
                            <div class="card" style="width: 18rem;">
                                <img src="https://source.unsplash.com/400x300/?code,' . $cat_name . ',coding,binary" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="threadlist.php?catid=' . $cat_id . '">' . $cat_name . '</a></h5>
                                    <p>' . substr($cat_desc, 0, 90) . '...</p>
                                    <a href="threadlist.php?catid=' . $cat_id . '" class="btn btn-info">View Thread</a>
                                </div>
                            </div>
                        </div>';
            }
            ?>


        </div>
    </div>
    <?php include "partials/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>