
<?php

require 'xml_getter.php';

echo "upload Script";
echo "<br>";



if (isset($_POST["upload"])) {

  if ($_FILES['zip_file']['name'] != '') {

     $ex = new DMARC;
    $xml_obj= $ex->getXmlObject();
     $raw_xml= $ex->getXmlFile();     
   } else {
    echo "No Selected file to upload";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dmarc Report</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div id="container" >
        <div id="header" >
            <h3>Dmarc Report Analyzer</h3>
        </div>

        <div id= "upper_buttons">
            <div id="raw_xml_button">
             <form method="get" action="<?php echo $raw_xml ; ?>" target="_blank">
                <button type="submit" class="button1">Raw XML</button>
             </form>
            </div>

            <div id="update_zip_button">
             <form method="get" action="index.php" target="_blank">
                <button type="submit" class="button2">Upload Zip File</button>
             </form>
            </div>
        </div>

        <div id = "report_info_div">
            <div class="report_info"> <b>Email Provider:</b> <?php echo $xml_obj->report_metadata->org_name?> </div>
            <div class="report_info"> <b>Domain:</b> <?php echo $xml_obj->policy_published->domain;?> </div>
            <div class="report_info"> <b>Report Date:</b> 2020-01-07T00:00:00.000Z </div>
            <div class="report_info" > <b>Report ID:</b> 5811639088619696638 </div>
        </div>

        <div id = "report_tabel">
            <table width="100%">
                <tr>
                    <th colspan="6" width="25%">kk</th>
                    <th colspan="6" width="25%"><b>DMARC Compliance</b></th>
                    <th colspan="6" width="25%"><b>SPF</b></th>
                    <th colspan="6" width="25%"><b>DKIM</b></th>
                </tr>
                <tr>
                    <th colspan="3" >3</th>
                    <th colspan="3" >6</th>
                    <th colspan="6" >33.33%</th>
                    <th colspan="3" >Authentication</th>
                    <th colspan="2" >Alignment</th>
                    <th colspan="1" >Policy</th>
                    <th colspan="3" >Authentication</th>
                    <th colspan="2" >Alignment</th>
                    <th colspan="1" >Policy</th>
                </tr>
                <tr>
                    <th colspan="3" >IP Address</th>
                    <th colspan="3" >Email Volume</th>
                    <th colspan="2" >Pass</th>
                    <th colspan="1" >Fail</th>
                    <th colspan="3" >Rate</th>
                    <th colspan="2" >Pass</th>
                    <th colspan="1" >Fail</th>
                    <th colspan="1" >Pass</th>
                    <th colspan="1" >Fail</th>
                    <th colspan="1" >Pass</th>
                    <th colspan="2" >Pass</th>
                    <th colspan="1" >Fail</th>
                    <th colspan="1" >Pass</th>
                    <th colspan="1" >Fail</th>
                    <th colspan="1" >Pass</th>

                </tr>
                
            </table>
        </div>
    </div>
</body>
</html>







<!-- <html lang="en">
<body>
<a href="<?php //echo $raw_xml ; ?>" target="_blank">Raw-XML</a>
</body>
</html> -->
<?php
echo "<br>";
echo "<br>";
//  echo "Email Provider: ".$xml_obj->report_metadata->org_name;
//  echo "<br>";echo "<br>";
//  echo "Domain: ".$xml_obj->policy_published->domain;
//  echo "<br>";echo "<br>";
//  echo "Report ID: " . $xml_obj->report_metadata->report_id;
//  echo "<br>";echo "<br>";
//  echo "IP Address 3: " . $xml_obj->record[2]->row->source_ip;
?>


