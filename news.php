<!DOCTYPE html>
<html>

<head>
    <title>Farming Tips</title>
    <link href="./css/news.css" rel="stylesheet">
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <a href="index.html">Home</a>
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
    <script src="./scripts/jquery.min.js"></script>
    <script src="./scripts/news.js"></script>
    <?php
    $domOBJ = new DOMDocument();
    $domOBJ->load("http://indiatogether.org/rss/category/agriculture"); //XML page URL
    $content = $domOBJ->getElementsByTagName("item");

    foreach ($content as $data) {
        $title = $data->getElementsByTagName("title")->item(0)->nodeValue;
        $desc = $data->getElementsByTagName("description")->item(0)->nodeValue;
        $link = $data->getElementsByTagName("link")->item(0)->nodeValue;
        echo "
            <div class='newsCard'>
                <div class='newsTitle'>
                    ".$title."
                </div>
                <div class='newsContent'>
                    ".$desc."
                </div>
                <a href='".$link."'>
                    <button class='newsLink'>
                        Read Full Article
                    </button>
                </a>
            </div>
            ";
        }
    ?>
</body>

</html>