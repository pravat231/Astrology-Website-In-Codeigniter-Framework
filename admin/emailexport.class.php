<?php
class emailExport {
    var $filename = 'export';

    function getList($arrayList) {
        $this->arrayList = $arrayList;
    }
    function exportCsv() {
        $ql = chr(13).chr(10);
        $arrayParams = array('Name' => '','E-mail Address' => '','Phone' => '');
        $arrayParamsKeys = array_keys($arrayParams);
        $fp = fopen($this->filename.'.csv', 'w');
        fwrite($fp, implode(',', $arrayParamsKeys).$ql);
        foreach($this->arrayList as $array) {
            $arrayParams['Name'] = (isset($array['Name']))?($array['Name']):('');
            $arrayParams['E-mail Address'] = (isset($array['E-mail Address']))?($array['E-mail Address']):('');
			$arrayParams['Phone'] = (isset($array['Phone']))?($array['Phone']):('');
            fwrite($fp, implode(',', $arrayParams).$ql);
        }
        fclose($fp);
    }
}
?>