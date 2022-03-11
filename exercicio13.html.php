<?php
    session_name('postivos-negativos');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Positivos e Negativos</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="numero">Inserta un número:</label>
        <input type="number" name="numero" autofocus><br>
        <input type="submit" value="Enviar">

    </form>


    <?php
        if(!isset($_SESSION['intentos'])){
            $_SESSION['intentos']=0;
            $_SESSION['positivos']=0;
            $_SESSION['negativos']=0;
        }else{
            $_SESSION['intentos']++;
        }

        if($_SESSION['intentos']<=10){

            if(isset($_POST['numero']) && filter_var($_POST['numero'],FILTER_VALIDATE_INT)){
                if($_POST['numero']<0){
                    $_SESSION['negativos']++;
                }else{
                    $_SESSION['positivos']++;
                }
            }

        }else{
            $positivos = $_SESSION['positivos'];
            $negativos = $_SESSION['negativos'];
            echo "<h2>Insertaches $positivos números positivos e $negativos números negativos</h2>";

            $_SESSION = array();

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                            $params["path"], $params["domain"],
                            $params["secure"], $params["httponly"]
                );
            }

            // Finally, destroy the session.
            session_destroy();


        }


    ?>
</body>
</html>