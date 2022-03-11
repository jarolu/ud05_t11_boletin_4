<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 19</title>
</head>
<body>

    <?php 
        $altura = $_POST['altura'];
        $icono = $_POST['icono'];

        $errores = validarFormulario($altura, $icono);
        if(count($errores)>0){
            pintarFormulario();
            for ($i=0; $i < count($errores); $i++) { 
                echo "<p>* $errores[$i] </p>";
            }
        }else{
            
        }


        function validarFormulario($a,$i){

            $errores = array();

            if($a == ''){
                array_push($errores, "Tes que indicar a altura");
            }
            
            if( filter_var($a, FILTER_VALIDATE_INT)   && $a < 0){
                array_push($errores, "A altura ten que ser un número positivo");
            }

            if($i == ''){
                array_push($errores, "Tes que escoller unha imaxe");
            }

            return $errores;

        }

        function pintarFormulario(){

            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="altura">Altura da pirámide:</label>
                <input type="number" name="altura">
                <select name="icono">
                    <option value="asterisco.png">Asterisco</option>
                    <option value="facebook.png">Facebook</option>
                    <option value="insta.png">Instagram</option>
                    <option value="twitter.png">Twitter</option>
                    <option value="whatsapp.png">Whatsapp</option>
                </select>
                <input type="submit" value="Enviar">    
            </form>
            <?php

        }
    ?>
    
</body>
</html>