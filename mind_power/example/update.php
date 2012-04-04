<?
include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM contacts WHERE id='$id'";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();

$i=0;
while ($i < $num) {
$first=mysql_result($result,$i,"first");
$last=mysql_result($result,$i,"last");
$phone=mysql_result($result,$i,"phone");
$mobile=mysql_result($result,$i,"mobile");
$fax=mysql_result($result,$i,"fax");
$email=mysql_result($result,$i,"email");
$web=mysql_result($result,$i,"web");

?>

<form action="updated.php">
<input type="hidden" name="ud_id" value="<? echo "$id"; ?>">
First Name: <input type="text" name="ud_first" value="<? echo "$first"?>"><br>
Last Name: <input type="text" name="ud_last" value="<? echo "$last"?>"><br>
Phone Number: <input type="text" name="ud_phone" value="<? echo "$phone"?>"><br>
Mobile Number: <input type="text" name="ud_mobile" value="<? echo "$mobile"?>"><br>
Fax Number: <input type="text" name="ud_fax" value="<? echo "$fax"?>"><br>
E-mail Address: <input type="text" name="ud_email" value="<? echo "$email"?>"><br>
Web Address: <input type="text" name="ud_web" value="<? echo "$web"?>"><br>
<input type="Submit" value="Update">
</form>

<?
++$i;
} 
?>