<!DOCTYPE html>
<html>
<body>

    <?php
    //Implementação da função que calcula a média
    function calc_media($n1,$n2) {
        return ($n1 + $n2)/2;
    }
    //Definição do array que contém os dados do aluno
    $aluno = array("Maria",9.2,9.4);

    //Chamada da função que calcula a média
    $media = calc_media($aluno[1], $aluno[2]);

    //Imprimindo os dados na tela
    echo $aluno[0]." tem média igual a ".$media;

    ?>
    
</body>
</html>