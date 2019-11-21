<!DOCTYPE html>
<html>

<head>
    <title>
        Krishak
    </title>
    <script src="./scripts/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css" />
    <link rel="stylesheet" href="./css/forums.css" />
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <a href="./index.html">Home</a>
            <a href="./weather.html">Weather</a>
            <a href="./marketplace.php">Market Place</a>
            <a class="active" href="./forums.php">Forums</a>
            <a href="./tips.html">Tips</a>
        </div>
        <div class="nav-right">
            <a href="signup.php">Sign Up</a>
            <a href="login.php">Login</a>
        </div>
    </div>
    <button class="newItem" data-toggle="modal" data-target="#exampleModal">New Post</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sell your item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="forums.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Title</label>
                            <input type="text" required class="form-control" name="postTitle" aria-describedby="emailHelp" placeholder="Enter Item Title">
                            <small id="emailHelp" class="form-text text-muted">Please enter post title.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Description</label>
                            <textarea type="text" required class="form-control" name="postDesc" aria-describedby="emailHelp" placeholder="Enter Post Description"></textarea>
                        </div>
                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let cookies = document.cookie;
        console.log(cookies);
        for (i = 0; i < 2; i++) {
            var temp = ((cookies.split(';')[0]).split('='))[0];
            if (temp == "currentUser") {
                user = ((cookies.split(';')[0]).split('='))[1];
                break;
            }
            else{
                user = undefined;
            }
        }
        // alert(user);
        if (user != undefined) {
            var e = document.getElementsByClassName('nav-right')[0];
            var child = e.lastElementChild;
            while (child) {
                e.removeChild(child);
                child = e.lastElementChild;
            }
            let a = document.createElement('a');
            a.innerText = user;
            a.addEventListener('click', logout);
            document.getElementsByClassName('nav-right')[0].appendChild(a);
        } else {
            alert("You have to be logged in to access forums. Redirecting to login");
            window.location.href = "./login.php";
        }

        function logout() {
            if (confirm("Do you want to logout?")) {
                document.cookie = "currentUser=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.reload();
            }
        }
        setTimeout(function() {
            let elementsArray = document.querySelectorAll(".postContainer");
            console.log(elementsArray);
            elementsArray.forEach(function(elem) {
                elem.addEventListener('click', function() {
                    let hash = ($(this)[0].children[2].innerHTML);
                    console.log(hash);
                    var now = new Date();
                    var time = now.getTime();
                    time += 3600 * 1000;
                    now.setTime(time);
                    document.cookie = 'currentPost=' + hash + '; expires=' + now.toUTCString() + '; path=/';
                    window.location.href = "./forumPost.php";
                });
            });
        }, 100);
    </script>
    <?php
    $postAuthor = $_COOKIE['currentUser'];
// echo "<script>alert('" . $postAuthor . "');</script>";
$link = mysqli_connect("localhost", "id11644415_root", "nahnotnow", "id11644415_krishak");
// $link = mysqli_connect("localhost", "root", "", "test");
    if ($link === false) {
        echo "<script>console.log('ERROR: Could not connect.  " . mysqli_connect_error() . "');</script>";
    } else {
        echo "<script>console.log('Success!  " . mysqli_get_host_info($link) . "');</script>";
    }
    $all = "SELECT * FROM ForumPosts";
    if ($result = mysqli_query($link, $all)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='postContainer' id='postContainer'>";
                echo "<p class='postTitle'>" . $row['PostTitle'] . "</p>";
                echo "<p class='postAuthor'>" . $row['PostAuthor'] . "</p>";
                echo "<p style='display:none'>" . $row['hash'] . "</p>";
                echo "<small id='emailHelp' class='form-text text-muted'>Click on the post to open it.</small>";
                echo "</div>";
            }
            // Close result set         
            mysqli_free_result($result);
        } else {
            echo "No records matching your query were found.";
        }
    }
    if (isset($_POST['save'])) {
        $postTitle = $_POST["postTitle"];
        $postDesc = $_POST["postDesc"];

        // echo "<script>alert('" . $postTitle . $postAuthor . $postDesc . "');</script>";
        // echo "<script>alert(".mysqli_num_rows(mysqli_query($link, $check)).");</script>";
        $sql = "INSERT INTO ForumPosts (PostTitle,PostAuthor,PostDesc,hash) VALUES (?,?,?,?)";
        $t = time();
        $hash  = $postAuthor . $postTitle . $t;
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ssss", $postTitle, $postAuthor, $postDesc, $hash);
        $stmt->execute();
        if ($sql) {
            mysqli_close($link);
            echo "<script language='javascript'>setTimeout('window.location=\"./index.html\"',1000);</script>";
        } else {
            mysqli_close($link);
        }
    }
    ?>

</body>

</html>