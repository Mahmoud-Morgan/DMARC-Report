<?php

echo "upload Script" ;
echo "<br>";
if(isset($_POST["upload"])) //submit button name 
 {  
    
    $output = '';  
    if($_FILES['zip_file']['name'] != '')  
    {
        $file_name = $_FILES['zip_file']['name'];  
        
        $array = explode(".", $file_name); 
        //to separate extension "." from the other dots
        $sliced_array = array_slice($array, 0, -1); 
        $name = implode(".",$sliced_array); 
        $ext = $array[sizeof($array)-1];  //index of last element
        if($ext == 'zip')  
        { 
         $path = 'upload/';  
         $location = $path . $file_name; 
         $tmp_name = $_FILES['zip_file']['tmp_name'];
         if(move_uploaded_file($tmp_name, $location))
          {
            $zip = new ZipArchive;  
            if($zip->open($location))  
            {  
            $zip->extractTo($path);  
            $zip->close();  
            }  

            $xml_file_name = $name.".xml";
            copy($path.$xml_file_name,'xml_files/'.$xml_file_name);
            unlink($path.$xml_file_name);
            unlink($location);
        
          } 
        }
        
    }
    else
    {
        echo "No Selected file to upload";
    }
 }
