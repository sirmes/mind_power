<?
include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);

$query="UPDATE contacts SET first='$ud_first', last='$ud_last', phone='$ud_phone', mobile='$ud_mobile', fax='$ud_fax', email='$ud_email', web='$ud_web' WHERE id='$ud_id'";
@mysql_select_db($database) or die( "Unable to select database");
mysql_query($query);
echo "Record Updated";
mysql_close();
?>