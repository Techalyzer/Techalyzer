<?

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

require_once('config.php');

if(isset($_POST))
{
			$nume        = $_POST['nume'];
			$parola      = sha1($_POST['parola']);
			$sql         = "SELECT * FROM utilizatori WHERE nume=?";
			$stmtinsert  = $db->prepare($sql);
			$stmtinsert -> execute([$nume]);
			$row         = $stmtinsert ->fetch();
			
 if($row['parola']==$parola)
 {
echo 1;
$_SESSION['logged_user'] = $row['nume'];
 }
 else
 {
echo 0;
 }
 
}

?>