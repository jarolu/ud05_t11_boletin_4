<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 10</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];
    ?>
    " method="POST">
        <label for="numero">Introduce un número:</label>
        <input type="number" name="numero">
        <br>

        <input type="submit" value="Enviar">
    
    </form>

    <?php

        if(!isset($_SESSION['numeros'])){            
            $_SESSION['numeros']= array();
        }
        if(isset($_POST['numero']) && filter_var($_POST['numero'],FILTER_VALIDATE_INT)&& $_POST['numero']>=0){

            /*Traballo aquí*/

            $n = $_POST['numero'];
            array_push($_SESSION['numeros'],$n);
        }else if(isset($_POST['numero']) && filter_var($_POST['numero'],FILTER_VALIDATE_INT)&& $_POST['numero']<0){
            /*Calcula a media*/
            $suma = 0;

            for ($i=0; $i < count($_SESSION['numeros']); $i++) { 
                $suma = $suma + $_SESSION['numeros'][$i];
            }

            $media = $suma / count($_SESSION['numeros']);
            echo "<p>A media é $media .</p>";


            /*Por último destruimos a sesión*/
            $_SESSION = array();

            // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
            // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
                );
            }

            // Finalmente, destruir la sesión.
            session_destroy();

        }else{
            echo "<p>Introduce un número.</p>";
        }
    
    ?>
</body>
</html>