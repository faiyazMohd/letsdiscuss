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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "SELECT user_name FROM `users` WHERE sno = $thread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $this_username = $row2['user_name'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // insert comment into db
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt",$comment);
        $comment = str_replace(">","&gt",$comment);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id',$sno,current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> Success!</strong> Your comment has been added!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron bg-light p-3 border">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <!-- <p>This is a peer to peer forum for sharing knowledge with each other.<br>
                No Spam / Advertising / Self-promote in the forums is not allowed.Remain respectful of other members at all times.Do not PM users asking for help.Do not cross post questions.Do not post “offensive” posts, links or images.Do not post copyright-infringing material<br></p> -->
            <p>Posted by: <em><?php echo $this_username; ?></em></p>

        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        echo '<div class="container">
        <h2 class="py-2">Post a Comment</h2>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Post your Conment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
               <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-info">Post Comment</button>
        </form>
    </div>';
    } else {
        echo '
        <div class="container">
        <h2 class="py-2">Post a Comment</h2>
        <p class="lead fw-bold fst-italic">You are not logged in. Please login to be able to post comments.</p>
        </div>
        ';
    }
    ?>
    <div class="container my-3" id="ques">
        <h2 class="py-2">Discussions</h2>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $date = new DateTimeImmutable($comment_time);
            $comment_by = $row['comment_by'];
            $sql2 = "SELECT user_name FROM `users` WHERE sno = '$comment_by'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            echo '<div class="d-flex my-3">
                    <div class="flex-shrink-0">
                        <img src="images/userDefaultImg.webp" width="40" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                    <p class=""><b>' . $row2['user_name'] . ' </b><small>' . $date->format(' M j, o \a\t g:i a') . '</small></p>
                        ' . $content . '
                    </div>
                </div>';
        }
        if ($noResult) {
            echo '
                        <div class="jumbotron bg-light p-3 border">
                            <p1 class="display-4">No Comments Found!!</p1>
                            <p class="lead my-3"><b>Be the first person to comment.</b></p>
                        </div>';
        }
        ?>

    </div>
    <?php include "partials/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>