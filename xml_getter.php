<?php

require 'db_connection.php';

echo "xml_getter Script";
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


