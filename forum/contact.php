<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lets Discuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>
    <div class="contianer my-4 mx-4">
        <h2>Contact Us</h2>
        <form action="/forum/partials/_handleContact.php" method="post">
            <label for="select">What can we help you with?</label>
            <select class="form-select my-3" id="select" name="select" aria-label="Default select example">
                <option selected>-</option>
                <option value="I need help with my account">I need help with my account</option>
                <option value="I have a safety concern">I have a safety concern</option>
                <option value="General feedback">General feedback</option>
                <option value="Report a bug">Report a bug</option>
                <option value="Other">Other</option>
            </select>

            <div class="mb-3">
                <label for="contactUserInfo" class="form-label">Tell us about your self</label>
                <textarea class="form-control" id="contactUserInfo" name="contactUserInfo" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="contactUserConcern" class="form-label">Elaborate your concern</label>
                <textarea class="form-control" id="contactUserConcern" name="contactUserConcern" rows="3"></textarea>
            </div>
            <?php
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                $sno = $_SESSION['sno'];
                echo '  <button class="btn btn-info">Submit</button>';
            } else {
                echo '  <p class="lead fw-bold fst-italic">You are not logged in. Please login to contact us.</p>';
            }
            ?>
        </form>
    </div>
    <?php include "partials/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>