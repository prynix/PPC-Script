<?php
include("extended-config.inc.php");  
include($GLOBALS['admin_folder']."/config.inc.php");

includeClass("User");
includeClass("Form");
includeClass("Template");

$ini_error_status=ini_get('error_reporting');
$user=new User("ppc_publishers");
if(!$user->validateUser())
{
header("Location:publisher-show-message.php?id=1006");
exit(0);
}

$id=getSafePositiveInteger('id');
if(!myPubSite($id,$user->getUserID(),$mysql))
{
header("Location:publisher-show-message.php?id=5010");
exit(0);
}
//echo $id;
mysql_query("delete from ppc_publishing_urls where id='$id'");

if($ini_error_status!=0)
{
	echo mysql_error();
}
header("Location:publisher-show-success.php?id=10510&page=".urlencode("ppc-new-publishing-url.php"));
exit(0);


?>
