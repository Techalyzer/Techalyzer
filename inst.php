<?php

include('config.php');

$sql = "CREATE TABLE tasks (
  id int(100) NOT NULL,
  owner varchar(50) NOT NULL,
  task varchar(200) CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  data date NOT NULL,
  importanta int(1) NOT NULL,
  sters int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE utilizatori (
  id int(11) NOT NULL,
  nume varchar(30) NOT NULL,
  parola varchar(100) NOT NULL,
  drepturi int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE tasks
  ADD PRIMARY KEY (id);

ALTER TABLE utilizatori
  ADD PRIMARY KEY (id);

ALTER TABLE tasks
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE utilizatori
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT";

$stmtinsert = $db->prepare($sql);
$stmtinsert->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Instalare Aplicatie</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    window.location.href = "alert.php";
</script>

</html>