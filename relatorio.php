<?php
session_start();
include('conexao.php');
include('verifica_login.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html  xml:lang="pt" lang="pt">

    <head>
        <title>Relatório de acessos - VOIP</title>
        <style type="text/css">
            body{
                background-image:url(imagens/fundo.png);
                background-attachment: fixed;
                background-size: 100%;
                background-repeat: no-repeat;                
            }
            <!--
            body {
                padding:0px;
                margin:0px;
            } 
            label {

                display: inline-block;
                width: 90px;
                font-weight: bold;

            }
            -->
        </style>
    </head>

    <body>


        <h1 align="center">RELATÓRIO DE ACESSOS - USUÁRIO VOIP</h1>
        <div align="center">Olá, <b><?php echo $_SESSION['nome'] ?></b> <a href="logout.php">-  SAIR</a></div>

        <form action="" enctype="multipart/form-data" name="busca" method="post">
            <div align="center" style="margin-top: 30px;" class="container">
                </br>
                <label>Mês:</label>                            
                <select id="mes" name="mes" align="center" style="width:160px;">     
                    <option value="01" >Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select> </br>
                <label>Ano:</label><input type="text" name="ano" id="ano" style="width:160px;"/></br> 

                <label>        
                    Cpf: </label><input type="text" name="cpf" id="cpf" style="width:160px;"/>           
                </br> <input type="submit" name="enviar" value="Pesquisar"/>

            </div>
        </form>

        <table align="center" class="alternate" id="myTable" border="1"
               <tr class="header">
                <td bgcolor="#C0C0C0" align="center"><b>DATA/HORA</b></td>
                <td bgcolor="#C0C0C0" align="center"><b>RAMAL</b></td>
                <td bgcolor="#C0C0C0" align="center"><b>CPF</b></td>
                <td bgcolor="#C0C0C0" align="center"><b>EVENTO</b></td>        
            </tr>
            <?php
            $cpf = $_POST['cpf'];
            $ano = $_POST['ano'];
            $mes = $_POST['mes'];
            $data_inicial = $_POST['ano'] . "-" . $_POST['mes'] . "-" . '01';
            $data_final = $_POST['ano'] . "-" . $_POST['mes'] . "-" . '31';
            $sql = "select * from tb_queuelog where time >= '$data_inicial' and time <= '$data_final' and (event = 'addagent' or event = 'removeagent') and data1 = '$cpf'";
            $sqlNome = "select nome from tb_usuario where cpf = $cpf";
            if ($cpf != null) {
                $resultnome = mysqli_query($conexao, $sqlNome);
                $result = mysqli_query($conexao, $sql);
                $fabricante = mysqli_fetch_array($resultnome);
                $nome = $fabricante['nome'];
                ?>
                <h3 align="center">
                    <?php echo "Relatório do mês $mes/$ano do usuário $nome"; ?>
                </h3>
                <?php
                while ($resultados = mysqli_fetch_array($result)) {
                    $data = $resultados['time'];
                    $ramal = $resultados['agent'];
                    $evento = $resultados['event'];
                    $cpf = $resultados['data1'];
                    ?>
                    <tr <?php echo ($evento == "ADDAGENT" ? 'bgcolor="#ADD8E6"' : 'bgcolor="#E9967A"') ?>>
                        <td align="center"><?php echo substr($data, 0, 19) ?></td>
                        <td align="center"><?php echo $ramal ?></td>
                        <td align="center"><?php echo $cpf ?></td>
                        <td align="center" ><?php echo ($evento == "ADDAGENT" ? "ENTROU" : "SAIU") ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <?php ?>
    </body>
</html>