<!DOCTYPE html>
<html>

<head>
    <title>
        Krishak
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <div class="alertbox">
        <h3 class="alerttext">Successfully signed up!</h3>
    </div>
    <div class="navbar">
        <div class="nav-left">
            <a href="./index.html">Home</a>
            <a href="./weather.html">Weather</a>
            <a href="./marketplace.html">Market Place</a>
            <a href="./forums.html">Forums</a>
        </div>
        <div class="nav-right">
            <a href="signup.php">Sign Up</a>
            <a class="active" href="login.php">Login</a>
        </div>
    </div>
    <form class="login-container" method="post" action="login.php">
        <input type="text" name="username" placeholder="Enter username" class="usernameLogin" /><br>
        <input type="password" name="password" placeholder="Enter password" class="passwordLogin" /><br>
        <input type="submit" name="save" onsubmit"function(e){e.preventDefault();}" class="submit">
    </form>
    <script>
        function signUpSuccess(username) {
            let alertBox = document.getElementsByClassName('alertbox')[0];
            alertBox.style.display = "block";
            alertBox.style.background = "#87f3a2";
            let alertText = document.getElementsByClassName('alerttext')[0];
            alertText.innerText = "Successfully Signed up with " + username;
        }

        function signUpFail(err) {
            let alertBox = document.getElementsByClassName('alertbox')[0];
            alertBox.style.display = "block";
            alertBox.style.background = "#fc5151";
            let alertText = document.getElementsByClassName('alerttext')[0];
            alertText.innerText = "Login Failed. " + err;
        }

        function setUser(user) {
            window.localStorage.setItem('currentUSer', user);
        }
    </script>
    <?php
    if (isset($_POST['save'])) {
        $link = mysqli_connect("localhost", "root", "", "test");
        if ($link === false) {
            echo "<script>console.log('ERROR: Could not connect.  " . mysqli_connect_error() . "');</script>";
        } else {
            echo "<script>console.log('Success!  " . mysqli_get_host_info($link) . "');</script>";
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        $check = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$password' ";
        // echo "<script>alert(".mysqli_num_rows(mysqli_query($link, $check)).");</script>";
        if (mysqli_num_rows(mysqli_query($link, $check))) {
            echo "<script>setUSer('" . $username . "')</script>";
        } else {
            echo "<script>signUpFail('Username or Password is incorrect!')</script>";
        }
    }
    ?>
</body>

</html>