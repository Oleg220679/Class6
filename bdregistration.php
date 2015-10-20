  
<?php
session_start();
if (isset($_POST['login'] , $_POST['parol'])) 
{ $_SESSION['auth'] = '1';
} elseif (isset($_GET['logout'])) {
	unset($_SESSION['auth']); session_destroy();
}
?>

<html>
<body>
<?php
if (isset($_SESSION['auth'])) {
	print '<a href="bdregistration.php?logout"><br>Exit</a>';
	$u=mysql;//пишу тут, щоб сервер пустив в базу даних
    $p=mysql;//пишу тут, щоб сервер пустив в базу даних
    $log=$_POST['login'];
    $passw=md5($_POST['parol']);
try
{
	$conn = new PDO('mysql:host=localhost; dbname=mydatabase', $u, $p);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$data = $conn->prepare('SELECT COUNT(*) FROM users WHERE name like :name');
    $data->bindParam(':name', $log);
    $data->execute();
    $result = $data->fetchColumn();
    
 if ($result<=0) {
    $record = $conn->prepare('INSERT into users  VALUES (NULL,:name,:password)');
    $record->bindParam(':name', $log);
    $record->bindParam(':password', $passw);
    $record->execute();	
	} 
    else print'<br>user ' . $log . ' already exists';
    
} catch(PDOException $e) {

     print '<br>ERROR: ' . $e->getMessage();

}
 }
 else {?>
    <form action="bdregistration.php" method="post">
    	<span>"user name"</span><br>
        <input type="text" name="login" required><br>
        <span>"password"</span><br>
        <input type="password" name="parol" required><br>
        <input type="submit" value="submit">
   </form>
 <?php 
       }?>


<br></body></html>

 