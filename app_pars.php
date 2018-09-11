<?php
class pars_app{
	var $spisok = array();
	function app_pars($name_app){
		$ip_s   = array();
		$ccerr_s = array();
		$page_rgs = file_get_contents($name_app.'/cgi-bin/ipinput.cgi?action=ListServices&slot=0&module=0&input=-1');
		$span_arr = explode("</span>",$page_rgs);
		foreach ($span_arr as &$value){
			if(strpos($value,"ip_")) $ip_s[]=$value;
			if(strpos($value,"ccerr_")) $ccerr_s[]=$value;
		}
		$ip_s = $this->last_sk_ar($ip_s);
		$ccerr_s = $this->last_sk_ar($ccerr_s);
		foreach ($ip_s as $key => $value){
			if (isset($ccerr_s[$key])){
				$this->spisok[]=array('ip'=>$value, 'err' =>$ccerr_s[$key]);
			}
		}
		print_r ($this->spisok);
	}
	function last_sk_ar($arr){	
		foreach ($arr as &$value){
			$value=$this->last_sk_st($value);
		}  
		return $arr;
	}
	function last_sk_st($val){ 	
		return substr(strrchr($val,">"), 1);
	}
}
?>