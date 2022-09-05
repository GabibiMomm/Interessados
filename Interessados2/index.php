<?php
//Carrega a Conexão com Bando de Dados
include_once('lib/conexao.php');

//Função option_estados - Carrega os estados do Banco de Dados e monta os options
function option_estados() {
    $conn = $GLOBALS['conn'];
    //Selecionar os estados do Banco de Dados        
    $sql = "SELECT Uf, Nome FROM estado";
    $consulta = $conn->prepare($sql);
    $estados = $consulta->execute();
    while($r = $consulta->fetch()) {
        echo '<option value="'.$r['Uf'].'">'.$r['Nome'].'</option>';
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Interessados - NewsLetter - DEVs-TI</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    
    <div class="fundo">
        <br>
        <center>
            <h1 class="titulo">INTERESSADOS - NewsLetter</h1>
            <br>
            <div id="dMsg"></div> 
            <div class="corpo">
                <form id="fInteressados" action="salvar_interessados.php" method="post">
                    <label for="iNome" >Nome:</label> <br>
                    <input id="iNome" name="iNome" type="input" value="" style="width: 200px;">
                    <br><br>
                    <label for="iEmail" >E-mail:</label> <br>
                    <input id="iEmail" name="iEmail" type="input" value="" style="width: 200px;">
                    <br><br>
                    <label for="iFone" >Telefone:</label> <br>
                    <input id="iFone" name="iFone" type="input" value="" placeholder="(99) 99999-9999" style="width: 200px;">
                    <br><br>
                    <label for="sEstado" >Estado:</label> <br>
                    <select id="sEstado" name="sEstado" style="width: 200px;"> 
                        <option value="00">Selecionar</option>
                        <?php option_estados(); ?>
                    </select>
                    <br><br>
                    <label for="sCidade" >Cidade:</label> <br>
                    <select id="sCidade" name="sCidade" style="width: 200px;"> 
                        <option value="00">Selecionar</option>
                        
                    <?php
                        $sql = "SELECT * FROM municipio ORDER BY Id";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();

                        foreach($consulta as $linha){
                            echo "<option value=\"{$linha['Id']}\">{$linha['Nome']}</option>";
                        }
                    ?>
                    </select>
                    <br><br>
                    <input type="reset" id="bLimpar" value="Limpar">&nbsp;|&nbsp;
                    <input type="submit" id="bEnviar" value="Enviar" name="enviar">
                </form>
            </div>
        </center>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script language="JavaScript" src="lib/funcoes.js"></script>
</html>
