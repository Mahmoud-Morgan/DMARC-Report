<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload zip file</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select zipfile to upload:
    <input type="file" name="zip_file" >
    <input type="submit" value="Upload zipfile" name="upload">
</form>
</body>
</html>