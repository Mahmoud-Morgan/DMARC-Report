
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
            <div class="report_info"> <b>Email Provider:</b> google.com </div>
            <div class="report_info"> <b>Domain:</b> isnsc.com </div>
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



<?php

require 'db_connection.php';

echo "upload Script";
echo "<br>";
//submit button name

class DMARC
{

    private $extract_path ='upload/';
    private $save_path ='xml_files/';
    private $name ;
    private $zip_file_name;
    private $xml_file_name;
  

     //Methods

     function  __construct()
    {
       $this->extractZipFile();
       $this->saveXmlFile(); 
    }

    private function extractZipFile()
    {
        $this->zip_file_name = $_FILES['zip_file']['name'];

        $array = explode(".", $this->zip_file_name);
        //to separate extension "." from the other dots
        $sliced_array = array_slice($array, 0, -1);
        $this->name = implode(".", $sliced_array);
        //$ext = $array[sizeof($array)-1];  //index of last element
        $ext = end($array);

        if ($ext == 'zip') {
            $location = $this->extract_path . $this->zip_file_name;
            $tmp_name = $_FILES['zip_file']['tmp_name'];
            if (move_uploaded_file($tmp_name, $location)) {
                $zip = new ZipArchive;
                if ($zip->open($location)) {
                    $zip->extractTo($this->extract_path);
                    $zip->close();
                }
            }
        }
     //end extracting function
    }

    private function saveXmlFile()
    {
        $this->xml_file_name = $this->name . ".xml";//zip name must = xml name
        // copy file from upload dir to xml_files dir and clear upload dir
        copy($this->extract_path . $this->xml_file_name, $this->save_path. $this->xml_file_name);
        unlink($this->extract_path. $this->xml_file_name);
        unlink($this->extract_path.$this->zip_file_name);

        //adding xml file name to DB
        $conn = OpenCon();
        $sql = "INSERT INTO xml_files (xml_file_name)
         VALUES ('$this->xml_file_name')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully"; echo "<br>" ;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    public function getXmlFile()
    {
     $xml_file=$this->save_path. $this->xml_file_name;
     return $xml_file;
    }

    public function getXmlObject()
    {
      $xml_object=simplexml_load_file($this->getXmlFile());
     return $xml_object;
    }

//class end
}


if (isset($_POST["upload"])) {

  if ($_FILES['zip_file']['name'] != '') {

     //$ex = new DMARC;
    // $xml_obj= $ex->getXmlObject();
     //$raw_xml= $ex->getXmlFile();     
   } else {
    echo "No Selected file to upload";
    }
}
?>



<!-- <html lang="en">
<body>
<a href="<?php echo $raw_xml ; ?>" target="_blank">Raw-XML</a>
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


