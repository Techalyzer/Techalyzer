<?

require_once('config.php');

if (isset($_POST)){
    
            $owner   = $_POST['owner'];
            $task    = $_POST['task'];
            $data    = date('Y-m-d H:i:s');
            $imp     = $_POST['pri'];
            
            switch ($imp) {
            
            case "normal":
            $importanta = 0;
            break;
            
            case "prioritar":
            $importanta = 1;
            break;
            
            case "urgenta":
            $importanta = 2;
            break;
               
            }
			
			$sql        = "INSERT INTO tasks (owner,task,data,importanta) VALUES(?,?,?,?)";
			$stmtinsert = $db->prepare($sql);
			$result     = $stmtinsert->execute([$owner, $task, $data, $importanta]);
			
			if($result){
			}
			    else
			{
			    echo "Task-ul nu a putut fi adaugat. Contactati administratorul.";
			}
			
		}
else
{
    echo "Task-ul nu a putut fi adaugat. Contactati administratorul.";
}

?>