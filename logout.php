<?

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();

if(!isset($_SESSION['logged_user']))
{
    header("Location: index.php");
}

else if(isset($_SESSION['user'])!="")
{
    header("Location: app.php");
}

if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['logged_user']);
    header("Location: index.php");
}

?>