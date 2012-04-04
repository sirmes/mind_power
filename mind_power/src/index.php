<?
include("dbinfo.inc.php");
mysql_connect("127.0.0.1",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM questions";
$result=mysql_query($query);

$num=mysql_numrows($result); 

mysql_close();

echo "<b><center>Database Output</center></b><br><br>";

?>

<form action="insert.php" method="post">
Title: <input type="text" name="title"><br>
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>

<?//TODO:Add radios or checkbox, need to figure out how ?>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">id</font></th>
<th><font face="Arial, Helvetica, sans-serif">id_category</font></th>
<th><font face="Arial, Helvetica, sans-serif">group</font></th>
<th><font face="Arial, Helvetica, sans-serif">question</font></th>
</tr>

<?
$i=0;
while ($i < $num) {
	$id=mysql_result($result,$i,"id");
	$id_category=mysql_result($result,$i,"id_category");
	$group=mysql_result($result,$i,"group");
	$question=mysql_result($result,$i,"question");
?>
<tr> 
<td><font face="Arial, Helvetica, sans-serif"><? echo "$id"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$id_category"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$group"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$question"; ?></font></td>
</tr>
<?
++$i;
} 
?>
</table>
<p>
<input type="Submit" value="Send your anwsers">
</form>