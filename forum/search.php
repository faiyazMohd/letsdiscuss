<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lets Discuss - A leading Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .container {
            min-height: 70vh;
        }
    </style>
</head>

<body>
    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>


    <!-- Search Result  -->
    <div class="container my-3">
        <h1 class="py-2">Search results for <em> "<?php echo $_GET['search'] ?>"</em></h1>
        <?php
        $noResult = true;
        $searchValue = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$searchValue')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=" . $thread_id;
            // showing the results
            echo '
                <div class="result">
                    <h3><a href="' . $url . '" class="text-primary" style="text-decoration: none; ">' . $title . '</a></h3>
                    <p>' . $desc . '</p>
                </div>
            ';
        }
        if ($noResult) {
            echo '
                        <div class="jumbotron bg-light p-3 border">
                            <p1 class="display-4">No Results Found!!</p1>
                            <p class="lead my-2">
                                Suggestions:
                                    Make sure that all words are spelled correctly.<ul>
                                        <li>Try different keywords.</li>
                                        <li>Try more general keywords.</li>
                                        <li>Try fewer keywords.</li>
                                    </ul>
                            </p>
                        </div>';
        }
        ?>



    </div>
    <?php include "partials/_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>