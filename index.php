<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Upload zip file</title>
</head>
<body>
<form action="report_view.php" method="post" enctype="multipart/form-data">
    Select zipfile to upload:
    <input type="file" class="" name="zip_file" >
    <input type="submit"  class="" value="Upload zip or xml file" name="upload">
</form>
</body>
</html>