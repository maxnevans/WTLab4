<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab 4</title>
    <link rel="stylesheet" href="preloader.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="function.php" method="POST" enctype="multipart/form-data" name="search-form" id="sf" class="main-form">
        <label>Key phrase: <input type="text" class="search-query" name="search"></label>
        <label>File: <input type="file" name="file" class="file-uploader"></label>
        <input type="submit" value="Search" name="search-go">
    </form>

    <div class="answer" id="answer"></div>

    <script src="script.js" defer></script>
</body>
</html>