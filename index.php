<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload multiple</title>
</head>
<body>


    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload images</label>
        <input type="file" name="avatar[]" multiple="multiple" id="imageUpload" />
        <button type="submit" name="submit">Upload</button>
    </form>

</body>
</html>
