<?php



class ReportObject
{
    private $xml_obj;
    private $report_info= array();
    private $report_records= array();
    private $report_counts=array();
    private $email_volume;
    private $rate_collector=array();
    private $no_emails_volume;
    private $report_object=array();

    function __construct(XmlGetter $xml_getter)
    {
     $this->xml_obj= $xml_getter->getXmlObject();
     $this->reportInfo();
     $this->reportRecords();
     $this->reportCounts();
     $this->assemblyReportObject();

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
          $dmarc_pass=$dkim_policy_pass;
          $dmarc_fail=($dmarc_pass== 0 ? $this->email_volume: 0);
          $dmarc_rate=($dmarc_pass== 0 ? 0.00 : 100.00);
          $spf_alig__pass=$spf_policy_pass;
          $spf_alig__fail=($spf_alig__pass== 0 ? $this->email_volume: 0);
          $dkim_alig_pass=$dkim_policy_pass;
          $dkim_alig_fail=$dmarc_fail;

         
         $record_collector=array(
             "ip_address"=>$record->row->source_ip,
             "email_volume"=>$email_volume,
             "dmarc"=>array("pass"=>$dmarc_pass,"fail"=>$dmarc_fail,"rate"=>$dmarc_rate.'%'),
             "spf"=>array("auth"=>array("pass"=>$spf_auth_pass,"fail"=>$spf_auth_fail),
                          "alig"=>array("pass"=>$spf_alig_pass,"fail"=>$spf_alig_fail),
                          "policy"=>array("pass"=>$spf_policy_pass)
                        ),
             "dkim"=>array("auth"=>array("pass"=>$dkim_auth_pass,"fail"=>$dkim_auth_fail),
                          "alig"=>array("pass"=>$dkim_alig_pass,"fail"=>$dkim_alig_fail),
                           "policy"=>array("pass"=>$dkim_policy_pass)
                        )
              );



         $this->no_emails_volume +=$this->email_volume;
         array_push($this->rate_collector,$dmarc_rate);
         array_push($this->report_records,$record_collector);
        }
    }
    
    private function reportCounts()
    {
        $no_ip_adresses= (count($xml_obj) -2);
        $average_rate= (array_sum($this->rate_collector)/count($this->rate_collector));

        $this->report_counts=array("no_ip_adresses"=>$no_ip_adresses,
         "no_emails_volume"=>$this->no_emails_volume,
         "average_rate"=>$average_rate);    
    }

    private function assemblyReportObject()
    {
        array_push($this->report_object,$this->report_info,$this->report_records,$this->report_counts);
    }
    
    public function getReportObject()
    {
        return $this->report_object;
    }



}




