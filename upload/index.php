<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <style>
        .button3 {
            background-color: #52de97;
            border-radius: 4px;
            padding: 10px 24px;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin : 15px;
        }
        .span{
            color: #655c56;
            font-family:arial;
            font-size: 20px;
            margin-left: 15px;
        }
    </style>
    
    <title>Upload zip file</title>
</head>
<body>
    <div id="container">
        <div id="header" >
            <h3>Dmarc Report Analyzer</h3>
        </div>

        <div id="">
            <form action="report_view.php" method="post" enctype="multipart/form-data">
            
            <span class="span">Select zip or xml file to upload:</span>
            <input type="file" class="" name="zip_file" >
            <input type="submit"  class="button3" value="Upload  file" name="upload">
            </form>
        </div>

    </div>

</body>
</html>