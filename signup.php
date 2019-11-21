<!DOCTYPE html>
<html>

<head>
    <title>
        Krishak
    </title>
    <script src="./scripts/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css" />
    <link rel="stylesheet" href="./css/signup.css" />
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <a href="./index.html">Home</a>
            <a href="./weather.html">Weather</a>
            <a href="./marketplace.php">Market Place</a>
            <a href="./forums.php">Forums</a>
            <a href="./tips.html">Tips</a>
        </div>
        <div class="nav-right">
            <a class="active" href="signup.php">Sign Up</a>
            <a href="login.php">Login</a>
        </div>
    </div>
    <div class="alertbox">
        <h3 class="alerttext">Successfully signed up!</h3>
    </div>
    <form class="login-container" action="signup.php" method="post">
        <input type="text" placeholder="Enter Full Name" name="name" class="nameLogin textFields" /><br>
        <input type="text" placeholder="Enter username" name="username" class="usernameLogin textFields" /><br>
        <input type="email" placeholder="Enter Email" name="email" class="emailLogin textFields" /><br>
        <input type="password" placeholder="Enter password" name="password" class="passwordLogin textFields" /><br>
        <input type="password" placeholder="Confirm password" name="confirmPass" class="confirmPasswordLogin textFields" /><br>
        <input type="submit" name="save" onsubmit"function(e){e.preventDefault();}" class="submit">
    </form>
    <br><br><br>
    <div style="text-align:center;">
        <a href="./login.php" style="text-decoration:none">
            Already a member? Click here to login!
        </a>
    </div>
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
            alertText.innerText = "Sign Up Failed. " + err;
        }
    </script>
    <?php
    if (isset($_POST['save'])) {
        $link = mysqli_connect("localhost", "id11644415_root", "nahnotnow", "id11644415_krishak");
        if ($link === false) {
            echo "<script>console.log('ERROR: Could not connect.  " . mysqli_connect_error() . "');</script>";
        } else {
            echo "<script>console.log('Success!  " . mysqli_get_host_info($link) . "');</script>";
        }
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPass"];
        $email = $_POST["email"];
        $emailCheck = "SELECT * FROM Users WHERE Email = '$email'";
        $userCheck = "SELECT * FROM Users WHERE Username = '$username'";
        if (mysqli_num_rows(mysqli_query($link, $emailCheck))) {
            echo "<script>signUpFail('Email already exists. Try logging in.')</script>";
        } else if (mysqli_num_rows(mysqli_query($link, $userCheck))) {
            echo "<script>signUpFail('Username already exists. Try choosing another one.')</script>";
        } else if ($password != $confirmPassword) {
            echo "<script>signUpFail('Passwords do not match! Try again')</script>";
        } else {
            // echo "<script>alert('Success!  " . $name . $username . $email . $password . $confirmPassword . "');</script>";
            $sql = "INSERT INTO Users (Name,Username, Password, Email) VALUES (?,?,?,?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("ssss", $name, $username, $password, $email);
            $stmt->execute();
            if ($sql) {
                echo "<script>signUpSuccess('" . $username . "');</script>";
                echo "<script language='javascript'>setTimeout('window.location=\"./index.html\"',1000);</script>";
                mysqli_close($link);
            } else {
                echo "<script>signUpFail();</script>";
                mysqli_close($link);
            }
        }
    }
    ?>
</body>

</html>