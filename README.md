# DMARC-Report
generating DMARC report form xml file format to be readable 

##### Deploy link
 link : https://dmarc-report.herokuapp.com/


### Assumptions 
- Report generated form xml fils 
- can upload zip or xml file 
- zip file name must have the intenal xml file name

### About
- index have upload form to upload and send file to report_view
- report_view validate the uploaded file 
- then calling xml_getter to get xml_object and saveing xml file
- sent xml object to report object to get report array
- view report form

