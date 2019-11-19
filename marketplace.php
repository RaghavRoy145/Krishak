<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/marketplace.css" />
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <a class="active" href="index.html">Home</a>
            <a href="./weather.html">Weather</a>
            <a href="./marketplace.php">Market Place</a>
            <a href="./forums.php">Forums</a>
<a href="./tips.html">Tips</a>
        </div>
        <div class="nav-right">
            <a href="signup.php">Sign Up</a>
            <a href="login.php">Login</a>
        </div>
    </div>
    <button class="newItem" data-toggle="modal" data-target="#exampleModal">New Sale!</button>
    <!-- Modal -->
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
                    <form action="marketplace.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Item Title</label>
                            <input type="text" required class="form-control" name="itemTitle" aria-describedby="emailHelp" placeholder="Enter Item Title">
                            <small id="emailHelp" class="form-text text-muted">Please describe in detail what you're selling.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Item Seller</label>
                            <input type="text" required class="form-control" name="itemSeller" aria-describedby="emailHelp" placeholder="Enter Item Seller">
                            <small id="emailHelp" class="form-text text-muted">Please enter name, not username.</small>
                        </div>
                        <div class="form-group">
                            <label>Price of Item</label>
                            <input type="number" required class="form-control" name="price" placeholder="Enter the price of goods">
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
        }

        function logout() {
            if (confirm("Do you want to logout?")) {
                document.cookie = "currentUser=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.reload();
            }
        }
    </script>
    <?php
    $link = mysqli_connect("localhost", "root", "", "test");
    if ($link === false) {
        echo "<script>console.log('ERROR: Could not connect.  " . mysqli_connect_error() . "');</script>";
    } else {
        echo "<script>console.log('Success!  " . mysqli_get_host_info($link) . "');</script>";
    }
    $all = "SELECT * FROM Marketplace";
    $result = mysqli_query($link, $all);
    echo "<script>console.log('Number of rows!  " . mysqli_num_rows($result) . "');</script>";
    if ($result = mysqli_query($link, $all)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='itemContainer'>";
                echo "<p class='itemTitle'>" . $row['PostTitle'] . "</p>";
                echo "<p class='itemSeller'>" . $row['PostAuthor'] . "</p>";
                echo "<p class='itemPrice'>" . $row['Price'] . "</p>";
                echo "</div>";
            }
            // Close result set         
            mysqli_free_result($result);
        } else {
            echo "No records matching your query were found.";
        }
    }
    if (isset($_POST['save'])) {
        $itemName = $_POST["itemTitle"];
        $price = $_POST["price"];
        $user = $_POST["itemSeller"];
        // echo "<script>alert('" . $itemName . $price . $user . "');</script>";
        // echo "<script>alert(".mysqli_num_rows(mysqli_query($link, $check)).");</script>";
        $sql = "INSERT INTO Marketplace (PostTitle,PostAuthor,Price) VALUES (?,?,?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sss", $itemName, $user, $price);
        $stmt->execute();
        if ($sql) {
            mysqli_close($link);
            echo "<script language='javascript'>setTimeout('window.location=\"./index.html\"',100);</script>";
        } else {
            mysqli_close($link);
        }
    }
    ?>
</body>

</html>