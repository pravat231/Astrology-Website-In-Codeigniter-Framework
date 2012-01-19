<?php
include_once('config/connection.php');
include('emailexport.class.php');
$emailExport = new emailExport();
$emails = array();
$sql_res=mysql_query("SELECT email,name,phone FROM astro_user WHERE user_authenticate='end_user' ORDER BY user_id DESC");
if(mysql_num_rows($sql_res)>0){
	while($row_res=mysql_fetch_assoc($sql_res)){
		$emails[] = array('Name' => $row_res['name'],'E-mail Address' => $row_res['email'],'Phone' => $row_res['phone']);
	}
}
$emailExport->getList($emails);
$emailExport->exportCsv();
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="export.csv"');
readfile('export.csv');
?>