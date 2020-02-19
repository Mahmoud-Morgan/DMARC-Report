<?php



class ReportObject
{
    private $xml_obj;
    private $report_info= array();
    private $report_records= array();
    private $email_volume;

    function __construct(XmlGetter $xml_getter)
    {
     $this->xml_obj= $xml_getter->getXmlObject();
     $this->reportInfo();

    }

    private function reportInfo()
    {
        $this->report_info= array(
            "email_provider"=>$this->xml_obj->report_metadata->org_name ,
            "domin" =>$this->$xml_obj->policy_published->domain ,
            "report_id"=>$this->xml_obj->report_metadata->report_id
        );        
    }
    
    private function reportRecords()
    {
        foreach($this->xml_obj->record as $record){
         $this->email_volume=$record->row->count;
         
          $spf_policy_pass= $this->checker($record->row->policy_evaluated->spf);
          $dkim_policy_pass= $this->checker($record->row->policy_evaluated->dkim);
          $spf_auth_pass=$this->checker($record->auth_results->spf->result);
          $spf_auth_fail=($spf_auth_pass == 0 ? $this->email_volume: 0);
          $dkim_auth_pass=$this->checker($record->auth_results->dkim->result);
          $dkim_auth_fail=($dkim_auth_pass == 0 ? $this->email_volume: 0);
         
         
         $record_collector=array(
             "ip_address"=>$record->row->source_ip,
             "email_volume"=>$email_volume,
            
         );
         
         
         array_push($this->report_records,$record_collector);
        }
    }
    
    private function checker($x)
    {
        switch($x){
            case "pass":
                return $this->email_volume;
            break;
            case "fail":
                return 0;
            break;
            case "none":
                return 0;
            break;
            default: echo "error!!: this value not (pass/fail/none)";
        }

    }
}




