<?
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Aplicatie - Autentificare</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div class="p-5 text-center bg-image" style="background-image: url('back.png');">	
	<form action="index.php" method="post">
		<div class="container" style="min-height: 100vh;">
		        <div class="pt-1 row justify-content-center">
		            <div class="col-sm-3" style="background-color: #ffffff80;padding: 40px;border-radius: 5px;">
		                <h2 class="text-center">Autentificare</h1>
			            <p class="text-center">Completeaza formularul de mai jos pentru inregistrare sau autentificare</p>
			            <hr class="mb-3">
			            <label for="nume"><b>Nume</b></label>
			            <input class="form-control" id="nume" type="text" name="nume" required>

			            <label for="parola"><b>Parola</b></label>
			            <input class="form-control" id="parola" type="password" name="parola" required>
                         <hr class="mb-3">
		            <input class="btn btn-primary" type="SUBMIT" id="login" name="login" value="Autentificare" style="width:100%;">
		            <hr class="mb-3">
		            <input class="btn btn-primary" type="SUBMIT" id="register" name="creare" value="Inregistrare" style="width:100%;background-color:#e24b78;border-color:#e24b78;">
			        </div>
			    </div>
			</div>
	</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(function(){
        $('#register').click(function(e){
            
            var valid  = this.form.checkValidity();
            
            if(valid){
                
            var nume   = $('#nume').val();
            var parola = $('#parola').val();
                
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'process.php',
                    data: {nume: nume,parola: parola},
                    success: function(data){
                    Swal.fire({
                                            'title': 'Utilizatorul a fost creat',
                                            'text':  data,
                                            'type': 'success'}).then(
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
        $('#login').click(function(e){
            
            var valid  = this.form.checkValidity();
            
            if(valid){
                
            var nume   = $('#nume').val();
            var parola = $('#parola').val();
                
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: {nume: nume,parola:parola},
                    success: function(response) {
  if(response=="1")
  {
    window.location.href="app.php";
  }
  else
  {
        Swal.fire({
            'title': 'Eroare',
            'text':  'Date de autentificare incorecte!',
            'type':  'error'
                 })
  }
  },
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