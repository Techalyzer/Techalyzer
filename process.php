<?

require_once('config.php');

if (isset($_POST)){
			$nume       = $_POST['nume'];
			$parola     = sha1($_POST['parola']);
			$sql        = "INSERT INTO utilizatori (nume, parola) VALUES(?,?)";
			$stmtinsert = $db->prepare($sql);
			$result     = $stmtinsert->execute([$nume, $parola]);
			
			if($result){
			}
			    else
			{
			    echo "Eroare";
			}
			
}
else
{
    echo "Nu au fost transmise numele de utilizator si parola. Va rugam contactati administratorul.";
}

?>