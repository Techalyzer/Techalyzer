<?

//------------------------------------------SESSION INIT------------------------------------------

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

include('config.php');

//------------------------------------------GRAB USER & RIGHTS------------------------------------

if(!isset($_SESSION['logged_user']))
{
 header("Location: index.php");
}

$logged_user = $_SESSION['logged_user'];
$sql         = "SELECT * FROM utilizatori WHERE nume=?";
$stmtinsert  = $db->prepare($sql);
$stmtinsert -> execute([$logged_user]);
$row         = $stmtinsert ->fetch();
$drept       = $row['drepturi'];

?>

<!-----------------------------------------HTML START--------------------------------------------->

<!DOCTYPE HTML>
<html>
<head>
	<title>Aplicatie</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<!-----------------------------------------TASK SUBMIT-------------------------------------------->

<?

if ($drept == 1){
    
echo "<div class=\"p-5 text-center bg-image\" style=\"background-image: url('back.png');\">";
echo "<div class=\"container\" style=\"min-height: 100vh;\">";
echo 	"<form action=\"app.php\" method=\"post\">";
echo 		        "<div class=\"p-2 row justify-content-center\">";
echo 		            "<div class=\"col-12\" style=\"background-color: #ffffff80;padding: 20px;border-radius: 5px;\">";
echo 			            "<h3 class=\"text-center\">Adauga task</h3>";
echo 			                "<div class=\"row justify-content-center align-items-end\">";
echo 			                    "<div class=\"col-6\">";
echo 			                        "<label for=\"task\" class=\"mt-3\"><b>Task</b></label>";
echo 			                        "<input class=\"form-control\" id=\"task\" type=\"text\" name=\"task\" required>";
echo 			                    "</div>";
echo 			                    "<div class=\"col-3\">";
echo 			                        "<label for=\"owner\" class=\"mt-3 col-xs-2\"><b>Utilizator</b></label>";
echo 			                        "<select class=\"form-control\" id=\"owner\" type=\"text\" name=\"owner\" required>";

$sql = "SELECT * FROM utilizatori";
foreach ($db->query($sql) as $row){
    echo "<option>".$row['nume']."</option>";
}

echo                                    "</select>";
echo                                 "</div>";
echo                                 "<div class=\"col-1\">";
echo 			                        "<label for=\"pri\" class=\"mt-3 col-xs-2\"><b>Prioritate</b></label>";
echo 			                        "<select class=\"form-control\" id=\"pri\" type=\"text\" name=\"pri\" required>";
echo 			                        "<option>normal</option>";
echo                                    "<option>prioritar</option>";
echo                                    "<option>urgenta</option>";
echo                                    "</select>";
echo                                 "</div>";
echo                                 "<div class=\"col-2\">";
echo 		                            "<input class=\"btn btn-primary\" type=\"SUBMIT\" id=\"add_task\" name=\"add_task\" value=\"Adauga\">";
echo 		                        "</div>";
echo 		                  "</div>";
echo 			        "</div>";
echo 	"</form>";
echo "</div>";

//-----------------------------------------TASK LIST--------------------------------------------

$columns     = array('data','importanta');
$column      = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order  = isset($_GET['order']) && strtolower($_GET['order']) == 'desc'?'DESC':'ASC';
$asc_or_desc = $sort_order == 'ASC'?'desc':'asc';

$sql         = "SELECT * FROM tasks ORDER BY $column $sort_order;";

$up_or_down  = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$stmtinsert  = $db->prepare($sql);
$result      = $stmtinsert->execute();

echo 	"<form action=\"app.php\" method=\"post\">";
echo 		        "<div class=\"p-2 row justify-content-center\">";
echo 		            "<div class=\"col-12\" style=\"background-color: #ffffff80;padding: 20px;border-radius: 5px;\">";
echo 			            "<h3 class=\"text-center\">Task-uri</h3>";
echo 			                "<div class=\"row justify-content-center align-items-center\">";
echo "<div class=\"col-1\"><b>OWNER</b></div><div class=\"col-6\"><b>TASK</b></div><div class=\"col-2\"><b><a href=\"app.php?column=data&order=".$asc_or_desc."\"></i>DATA</a></b></div><div class=\"col-2\"><b><a href=\"app.php?column=importanta&order=".$asc_or_desc."\"></i>PRIORITATE</a></b></div><div class=\"col-1\"></div>";
echo "<hr class=\"mt-2\">";

foreach ($db->query($sql) as $row) {
    if ($row['sters']==0){
        echo "<div class=\"col-1\">".$row['owner']."</div><div class=\"col-6\">".$row['task']."</div><div class=\"col-2\">".$row['data']."</div><div class=\"col-2\">";
            
            switch ($row['importanta']){
   
                case 0:
                    echo "normal";
                break;
   
                case 1:
                    echo "prioritar";
                break;
   
                case 2:
                    echo "URGENTA";
                break;
}

echo "</div>";
   
if ($row['owner']==$logged_user){
    $task_id = $row['id'];
    echo "<div class=\"col-1\">";
    echo "<form method=\"post\" action=\"task_delete.php\">";
    echo "<a class=\"btn btn-danger\" href=\"task_delete.php?id=$task_id\">Sterge</a>";
    echo "</form>";
    echo "</div>";
}
else
{
    echo "<div class=\"col-1\"></div>";
}

echo "<hr class=\"mt-2\">";

}
}

echo "<div class=\"col-1\">";
echo "<form method=\"post\" action=\"logout.php\">";
echo "<a class=\"btn btn-danger\" href=\"logout.php?logout\">Iesire</a>";
echo "</form>";
echo "</div>";

echo 		                  "</div>";
echo 			        "</div>";
echo 			    "</div>";
echo 		"</div>";
echo 	"</form>";
    
}

else

//-----------------------------------------TASK SUBMIT--------------------------------------------

{
echo "<div class=\"p-5 text-center bg-image\" style=\"background-image: url('back.png');\">";
echo 	"<form action=\"app.php\" method=\"post\">";
echo 		"<div class=\"container\" style=\"min-height: 100vh;\">";
echo 		        "<div class=\"p-2 row justify-content-center\">";
echo 		            "<div class=\"col-12\" style=\"background-color: #ffffff80;padding: 20px;border-radius: 5px;\">";
echo 			            "<h3 class=\"text-center\">Adauga task</h3>";
echo 			                "<div class=\"row justify-content-center align-items-end\">";
echo 			                    "<div class=\"col-6\">";
echo 			                        "<label for=\"task\" class=\"mt-3\"><b>Task</b></label>";
echo 			                        "<input class=\"form-control\" id=\"task\" type=\"text\" name=\"task\" required>";
echo 			                    "</div>";
echo                                 "<div class=\"col-1\">";
echo 			                        "<label for=\"pri\" class=\"mt-3 col-xs-2\"><b>Prioritate</b></label>";
echo 			                        "<select class=\"form-control\" id=\"pri\" type=\"text\" name=\"pri\" required>";
echo 			                        "<option>normal</option>";
echo                                    "<option>prioritar</option>";
echo                                    "<option>urgenta</option>";
echo                                    "</select>";
echo                                 "</div>";
echo                                 "<div class=\"col-2\">";
echo 		                            "<input class=\"btn btn-primary\" type=\"SUBMIT\" id=\"add_task_2\" name=\"add_task_2\" value=\"Adauga\">";
echo 		                        "</div>";
echo 		                  "</div>";
echo 			        "</div>";
echo 	"</form>";
echo "</div>";


//-----------------------------------------TASK LIST--------------------------------------------

$columns     = array('data','importanta');
$column      = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order  = isset($_GET['order']) && strtolower($_GET['order']) == 'desc'?'DESC':'ASC';

$asc_or_desc = $sort_order == 'ASC'?'desc':'asc';
$sql         = "SELECT * FROM tasks ORDER BY $column $sort_order;";

$up_or_down  = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$stmtinsert  = $db->prepare($sql);
$result      = $stmtinsert->execute();

echo 	"<form action=\"app.php\" method=\"post\">";
echo 		        "<div class=\"p-2 row justify-content-center\">";
echo 		            "<div class=\"col-12\" style=\"background-color: #ffffff80;padding: 20px;border-radius: 5px;\">";
echo 			            "<h3 class=\"text-center\">Task-uri</h3>";
echo 			                "<div class=\"row justify-content-center align-items-center\">";
echo "<div class=\"col-1\"><b>OWNER</b></div><div class=\"col-6\"><b>TASK</b></div><div class=\"col-2\"><b><a href=\"app.php?column=data&order=".$asc_or_desc."\"></i>DATA</a></b></div><div class=\"col-2\"><b><a href=\"app.php?column=importanta&order=".$asc_or_desc."\"></i>PRIORITATE</a></b></div><div class=\"col-1\"></div>";

foreach ($db->query($sql) as $row) {
    if (($row['sters']==0)&&($row['owner']==$logged_user)){
        echo "<div class=\"col-1\">".$row['owner']."</div><div class=\"col-6\">".$row['task']."</div><div class=\"col-2\">".$row['data']."</div><div class=\"col-2\">";
            
            switch ($row['importanta']){
   
                case 0:
                    echo "normal";
                break;
   
                case 1:
                    echo "prioritar";
                break;
   
                case 2:
                    echo "URGENTA";
                break;
             }
             
echo "</div>";
   
if ($row['owner']==$logged_user){
    $task_id = $row['id'];
    echo "<div class=\"col-1\">";
    echo "<form method=\"post\" action=\"task_delete.php\">";
    echo "<a class=\"btn btn-danger\" href=\"task_delete.php?id=$task_id\">Sterge</a>";
    echo "</form>";
    echo "</div>";
}
else
{
echo "<div class=\"col-1\"></div>";
}

echo "<hr class=\"mt-2\">";

}
}

echo "<div class=\"col-1\">";
echo "<form method=\"post\" action=\"logout.php\">";
echo "<a class=\"btn btn-danger\" href=\"logout.php?logout\">Iesire</a>";
echo "</form>";
echo "</div>";

echo 		                  "</div>";
echo 			        "</div>";
echo 			    "</div>";
echo 		"</div>";
echo 	"</form>";
    
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(function(){
        $('#add_task').click(function(e){
            
            var valid  = this.form.checkValidity();
            
            if(valid){
                
            var task   = $('#task').val();
            var owner = $('#owner').val();
            var pri = $('#pri').val();
                
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'task_add.php',
                    data: {task:task,owner:owner,pri:pri},
                    success: function(data){
                    Swal.fire({
                                            'title': 'Info',
                                            'text':  'Task-ul a fost adaugat',
                                            'type':  'success'}).then(
                                                                    function(){ 
                                                                    location.reload();
                                                                    });
                    }
                    ,
                    error: function(data){
                    Swal.fire({
                                            'title': 'Eroare',
                                            'text':  'Eroare!',
                                            'type':  'error'
                    })
                }
            });
            
                }
            else
            {

            }
            
        })
});
</script>

<script type="text/javascript">
    $(function(){
        $('#add_task_2').click(function(e){
            
            var valid  = this.form.checkValidity();
            
            if(valid){
                
            var task   = $('#task').val();
            var pri = $('#pri').val();
            var owner = "<?php echo $logged_user; ?>";
                
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'task_add.php',
                    data: {task:task,pri:pri,"owner":owner},
                    success: function(data){
                    Swal.fire({
                                            'title': 'Info',
                                            'text':  'Task-ul a fost adaugat',
                                            'type':  'success'}).then(
                                                                    function(){ 
                                                                    location.reload();
                                                                    });
                    }
                    ,
                    error: function(data){
                    Swal.fire({
                                            'title': 'Eroare',
                                            'text':  'Eroare!',
                                            'type':  'error'
                    })
                }
            });
            
                }
            else
            {

            }
            
        })
});

</script>

</body>
</html>