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
    <!-- <link rel="stylesheet" href="./css/forums.css" /> -->
    <style>
        .postTitle {
            margin-top: 100px;
            padding-left: 30px;
            padding-right: 30px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .postAuthor {
            margin-top: 10px;
            padding-left: 30px;
            padding-right: 30px;
            font-size: 0.8rem;
        }

        .postDesc {
            margin-top: 10px;
            padding-left: 30px;
            padding-right: 30px;
            font-style: italic;
        }
    </style>
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

    <!-- <div class="postContainer">
        <p class="postTitle">This is a sample title</p>
        <p class="postAuthor">Username</p>
    </div>
    <div class="postContainer">
        <p class="postTitle">This is a sample title</p>
        <p class="postAuthor">Username</p>
    </div> -->

    <script>
        let cookies = document.cookie;
        // console.log(cookies);
        user = ((cookies.split(';')[0]).split('='))[1];
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
    </script>
    <?php
    $currentPost = $_COOKIE['currentPost'];
    echo "<script>console.log('Cookie  " . $currentPost . "');</script>";
    // echo "<script>alert('" . $postAuthor . "');</script>";
    $link = mysqli_connect("localhost", "root", "", "test");
    if ($link === false) {
        echo "<script>console.log('ERROR: Could not connect.  " . mysqli_connect_error() . "');</script>";
    } else {
        echo "<script>console.log('Success!  " . mysqli_get_host_info($link) . "');</script>";
    }
    $getPost = "SELECT * FROM ForumPosts WHERE hash = '" . strval($currentPost) . "'";
    if ($result = mysqli_query($link, $getPost)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<p class='postTitle'>" . $row['PostTitle'] . "</p>";
                echo "<p class='postAuthor'> Post published by " . $row['PostAuthor'] . "</p>";
                echo "<p class='postDesc'>" . $row['PostDesc'] . "</p>";
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