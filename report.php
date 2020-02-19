
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dmarc Report</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div id="container" >
        <div id="header"  >
            <h3 >Dmarc Report Analyzer</h3>
        </div>

        <div id= "upper_buttons">
            <div id="raw_xml_button">
             <form method="get" action="" target="_blank">
                <button type="submit" class="button1">Raw XML</button>
             </form>
            </div>

            <div id="update_zip_button">
             <form method="get" action="index.php" target="_blank">
                <button type="submit" class="button2">Upload Zip File</button>
             </form>
            </div>
        </div>

        <div id = "report_info"></div>
        <div id = "reprt_tabel"></div>
    </div>
</body>
</html>