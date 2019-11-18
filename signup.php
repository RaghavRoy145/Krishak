<!DOCTYPE html>
<html>

<head>
    <title>
        Krishak
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css" />
    <link rel="stylesheet" href="./css/signup.css" />
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <a href="./index.html">Home</a>
            <a href="./weather.html">Weather</a>
            <a href="./marketplace.html">Market Place</a>
            <a href="./forums.html">Forums</a>
        </div>
        <div class="nav-right">
            <a class="active" href="signup.php">Sign Up</a>
            <a href="login.html">Login</a>
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
    <script>
        function signUpSuccess(username) {
            let alertBox = document.getElementsByClassName('alertbox')[0];
            alertBox.style.display = "block";
            alertBox.style.background = "#87f3a2";
            let alertText = document.getElementsByClassName('alerttext')[0];
            alertText.innerText = "Successfully Signed up with " + username;
        }

        function signUpFail() {
            let alertBox = document.getElementsByClassName('alertbox')[0];
            alertBox.style.display = "block";
            alertBox.style.background = "#fc5151";
            let alertText = document.getElementsByClassName('alerttext')[0];
            alertText.innerText = "Sign Up Failed. Please try again after a while.";
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
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPass"];
        $email = $_POST["email"];
        // echo "<script>alert('Success!  " . $name . $username . $email . $password . $confirmPassword . "');</script>";
        $sql = "INSERT INTO Users (Name,Username, Password, Email) VALUES (?,?,?,?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ssss", $name, $username, $password, $email);
        $stmt->execute();
        if ($sql) {
            echo "<script>signUpSuccess('" . $username . "');</script>";
            mysqli_close($link);
        } else {
            echo "<script>signUpFail();</script>";
            mysqli_close($link);
        }
    }
    ?>
</body>

</html>