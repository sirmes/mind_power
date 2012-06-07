<?
include("dbinfo.inc.php");

mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM companies";
$result=mysql_query($query);

$num=mysql_numrows($result); 

mysql_close();

echo "<b><center>Database Output</center></b><br><br>";

?>
<table border="0" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">email</font></th>
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
</tr>

<?
$i=0;
while ($i < $num) {
$email=mysql_result($result,$i,"name");
$name=mysql_result($result,$i,"active"); 
?>

<tr> 
<td><font face="Arial, Helvetica, sans-serif"><? echo "$email $name"; ?></font></td>
</tr>
<?
++$i;
} 
echo "</table>";


?>
