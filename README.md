# DMARC-Report
generating DMARC report from xml file format to be readable, using PHP native.

##### Deploy link
 link : https://dmarc-report.herokuapp.com/


### Assumptions 
- Report generated from xml fils 
- can upload zip or xml file 
- zip file name must have the internal xml file name

### About
- index have upload form to upload and send file to report_view
- report_view validate the uploaded file 
- then calling xml_getter to get xml_object and saveing xml file
- sent xml object to report object to get report array
- view reoprt array in report form

