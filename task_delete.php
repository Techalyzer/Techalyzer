<?

require_once('config.php');
    
$id         = $_REQUEST['id'];
$sql        = "UPDATE tasks SET sters=\"1\" WHERE ID=?";
$stmtinsert = $db->prepare($sql);
$result     = $stmtinsert->execute([$id]);

	if($result){
		header ("Location: app.php");
	}
		else
	{
		echo "Task-ul nu a putut fi sters. Contactati administratorul.";
	}
			
?>