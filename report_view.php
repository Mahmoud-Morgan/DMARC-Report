
<?php

require 'xml_getter.php';
require 'report_obj.php';


if (isset($_POST["upload"])) {

  if ($_FILES['zip_file']['name'] != '') {

     $ex = new XmlGetter;    
     $report_class_object= new ReportObject($ex);
     $report_array= $report_class_object->getReportObject();
     $raw_xml= $ex->getXmlFile();    
   } else {
    echo "No Selected file to upload";
    $URL="index.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
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
            <div class="report_info"> <b>Email Provider:</b> <?php print_r($report_array[0]['email_provider']);?> </div>
            <div class="report_info"> <b>Domain:</b> <?php print_r($report_array[0]['domain']);?> </div>
            <div class="report_info"> <b>Report Date:</b> <?php print_r($report_array[0]['report_date']);?> </div>
            <div class="report_info" > <b>Report ID:</b> <?php print_r($report_array[0]['report_id']);?></div>
        </div>

        <div id = "report_tabel">
            <table width="100%">
                <tr>
                    <th colspan="6" width="25%"> </th>
                    <th colspan="6" width="25%"><b>DMARC Compliance</b></th>
                    <th colspan="6" width="25%"><b>SPF</b></th>
                    <th colspan="6" width="25%"><b>DKIM</b></th>
                </tr>
                <tr>
                    <!-- No. of IP Address = NO. of records = (count($xml_obj)-2) -->
                    <th colspan="3" ><?php print_r($report_array[2]['no_ip_adresses']); ?></th> 
                    <th colspan="3" ><?php print_r($report_array[2]['no_emails_volume']); ?></th>
                    <th colspan="6" ><?php print_r(round($report_array[2]['average_rate'],2).'%'); ?></th>
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
                <?php foreach($report_array[1] as $record) {?>
                <tr>
                    <td colspan="3" id="IP_Address"><?php print_r($record['ip_address']); ?></td><!-- IP Address -->
                    <td colspan="3" ><?php print_r($record['email_volume']); ?></td><!-- Email Volume -->
                    <td colspan="2" ><?php print_r($record['dmarc']['pass']); ?></td>
                    <td colspan="1" ><?php print_r($record['dmarc']['fail']); ?></td>
                    <td colspan="3" ><?php print_r($record['dmarc']['rate']); ?></td>
                    <td colspan="2" ><?php print_r($record['spf']['auth']['pass']); ?></td>
                    <td colspan="1" ><?php print_r($record['spf']['auth']['fail']); ?></td>
                    <td colspan="1" ><?php print_r($record['spf']['alig']['pass']); ?></td>
                    <td colspan="1" ><?php print_r($record['spf']['alig']['fail']); ?></td>
                    <td colspan="1" ><?php print_r($record['spf']['policy']['pass']);?></td>
                    <td colspan="2" ><?php print_r($record['dkim']['auth']['pass']); ?></td>
                    <td colspan="1" ><?php print_r($record['dkim']['auth']['fail']); ?></td>
                    <td colspan="1" ><?php print_r($record['dkim']['alig']['pass']); ?></td>
                    <td colspan="1" ><?php print_r($record['dkim']['alig']['fail']); ?></td>
                    <td colspan="1" ><?php print_r($record['dkim']['policy']['pass']);?></td>
                </tr>
                <?php }?>
                
            </table>
        </div>
    </div>
</body>
</html>






