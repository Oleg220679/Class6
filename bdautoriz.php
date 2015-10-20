  
<?php
session_start();
if ($_POST['login'] == 'mysql' && md5($_POST['parol']) == '81c3b080dad537de7e10e0987a4bf52e' && $_POST['db'] == 'mydatabase') 
{ $_SESSION['auth'] = '1';
} elseif ($_POST['login'] !== 'mysql' || md5($_POST['parol']) !== '81c3b080dad537de7e10e0987a4bf52e' || $_POST['db'] !== 'mydatabase') {
	print '<br>Wrong database or user name or password<br>';
}
if (isset($_GET['logout'])) {
	unset($_SESSION['auth']); session_destroy();
}
?>

<html>
<body>
<?php
if (isset($_SESSION['auth'])) {
	print 'Table "Users" sucsessfuly created, <a href="bdautoriz.php?logout"><br>Exit</a>';
	$u=mysql;
    $p=mysql;
try
{
	$conn = new PDO('mysql:host=localhost; dbname=mydatabase', $u, $p);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$rows = $conn->exec("CREATE TABLE `Users`(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL DEFAULT '',
	password VARCHAR(255) NOT NULL DEFAULT '' )
	");
	
} catch(PDOException $e) {

     print '<br>ERROR: ' . $e->getMessage();

}
 }
 else {?>
    <form action="bdautoriz.php" method="post">
    	<span>"dbname"</span><br>
        <input type="text" name="db" required><br>
        <span>"login"</span><br>
        <input type="text" name="login" required><br>
        <span>"password"</span><br>
        <input type="password" name="parol" required><br>
        <input type="submit" value="submit">
   </form>
 <?php 
       }?>


<br></body></html>

 