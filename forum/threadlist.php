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
    </style>
</head>

<body>
    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $cat_name = $row['category_name'];
        $cat_desc = $row['category_description'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // insert thread into db
        $th_title = $_POST['title'];
        $th_title = str_replace("<","&lt",$th_title);
        $th_title = str_replace(">","&gt",$th_title);
        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<","&lt",$th_desc);
        $th_desc = str_replace(">","&gt",$th_desc);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> Success!</strong> Your thread has been added! Please wait for the community to respond.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
    ?>


    <div class="container my-4">
        <div class="jumbotron bg-light p-3 border">
            <h1 class="display-4">Welcome to <?php echo $cat_name; ?> Forums</h1>
            <p class="lead"><?php echo $cat_desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.<br>
                No Spam / Advertising / Self-promote in the forums is not allowed.Remain respectful of other members at all times.Do not PM users asking for help.Do not cross post questions.Do not post “offensive” posts, links or images.Do not post copyright-infringing material<br></p>
            <a class="btn btn-info btn-lg" href="#" role="button">Learn more</a>

        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        echo '<div class="container">
        <h2 class="py-2">Ask a Question</h2>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your question as short and crisp as possible.</div>
                </div>
                <div class="mb-3">
                <label for="desc" class="form-label">Elaaborate Your Concerns</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
                </form>
                </div>';
    } else {
        echo '
        <div class="container">
        <h2 class="py-2">Ask a Question</h2>
            <p class="lead fw-bold fst-italic">You are not logged in. Please login to start a Discussion.</p>
        </div>
        ';
    }
    ?>
    <div class="container my-4" id="ques">
        <h2 class="py-2">Browse Questions</h2>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $date = new DateTimeImmutable($thread_time);
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_name FROM `users` WHERE sno = $thread_user_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            echo '<div class="d-flex my-3">
                    <div class="flex-shrink-0">
                        <img src="images/userDefaultImg.webp" width="40" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '" style="text-decoration: none; " class="text-primary">' . $title . '</a></h5>
                        ' . $desc . '</div>'.'<p class=""><b>Asked by: '.$row2['user_name'].'  </b><small>' . $date->format(' M j, o \a\t g:i a') . '</small></p>'.'
                </div>
                <hr>';
        }
        if ($noResult) {
            echo '
                <div class="jumbotron bg-light p-3 border">
                    <p1 class="display-4">No Threads Found!!</p1>
                    <p class="lead my-3"><b>Be the first person to ask a question</b></p>
                </div>';
        }
        ?>



    </div>
    <?php include "partials/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>