<!DOCTYPE HTML>
<html>
<head>
	<title>Aplicatie</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
    
<div class="p-5 text-center bg-image" style="background-image: url('back.png');min-height: 100vh;">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
$.ajax({
type: 'POST',
url: 'index.php',
data: {},
success: function(data){
    
let timerInterval
Swal.fire({
  title: 'Aplicatia a fost instalata!',
  html: 'Se redirectioneaza catre pagina de autentificare',
  timer: 2000,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    timerInterval = setInterval(() => {
      const content = Swal.getContent()
      if (content) {
        const b = content.querySelector('b')
        if (b) {
          b.textContent = Swal.getTimerLeft()
        }
      }
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
    window.location.href="index.php";
  }
})

}
,
error: function(data){
Swal.fire({
    'title': 'Eroare',
    'text': 'Eroare!',
    'type': 'error',
    })
}
});
            
</script>

</body>
</html>