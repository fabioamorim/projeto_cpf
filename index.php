<?php
    /*
     *System: Gerador e validador de CPF v. 1.1
     *Data:20/08/2016
     *Atualização: 04/03/2017
     *Autor: Fábio Batista do Amorim
     */
      
      include_once ('class/calculo.class.php');
      
      $valida = false;
      // verifica se o campo cpf foi preenchido e enviado
      if(isset($_REQUEST['nCpf'])){
    
        $novoCalculo = new calculo();
        $valida = true;

        // Se botão gerar foi precionado
        if(isset($_POST['gerar'])){
          $novoCalculo->gerar();
        }        
        // Se botão limpar foi precionado
        if(isset($_POST['limpar'])){
          header('location: index.php');
        }
       
     }     
    
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Validação de CPF</title>            
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
            <link rel="stylesheet" type="text/css" href="css/style.css"/>
            <script type="text/javascript" src="jquery/jquery-1.2.6.pack.js"></script>
            <script type="text/javascript" src="jquery/jquery.maskedinput-1.1.4.pack.js"></script>
            <script type="text/javascript">$(document).ready(function(){	$("#vCpf").mask("999.999.999-99");});</script>            
        </head>
        <body>
          <div class="container">
              <br><br>
              <h1 class="text-center">Gerador e validador de CPF</h1>
              <p class="text-center">Este sistema tem a funcionalidade de gerar CPFs válidos, porém não necessariamente já existentes.<br />
                 Apenas validando os dígitos verificadores. Também validar CPFs digitados utilizando a mesma logica.</p>
                 <br><hr />
              <form id="form_cpf" method=POST action="?check=true">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="basic-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input class="form-control" type=text name="nCpf" id="vCpf" maxlength=14 aria-describedby="basci-addon" placeholder="Digite um CPF"
                                <?php                            
                                    //Este if verifica se check é verdadeiro e se o botão gerar foi precionado e gera um CPF válido aleatório para o text
                                    if(isset($_REQUEST["check"]) && isset($_POST['gerar'])){echo "value='".$novoCalculo->gerar()."'";}
                                    if(isset($_REQUEST["check"]) && isset($_POST['verificar'])){echo "value='".$_POST['nCpf']."'";}
                                ?>
                    >
                 </div>   
                        <br><br>
                <div class="text-center">
                    <button class='btn btn-primary ' name = "verificar">VERIFICAR</button>
                    <button class='btn btn-primary ' name = "gerar">GERAR</button>
                    <button class='btn btn-primary ' name = "limpar">LIMPAR</button><br><br>
                </div>
<?php
                
                if($valida){
                    if(isset($_POST['verificar'])){       
                        if($novoCalculo->cpf_invalido($_REQUEST['nCpf'])){
                            if($novoCalculo->calculo_cpf($_REQUEST['nCpf'])){
                                  echo "<br><p class='text-success bg-success text-bg-padding text-center'>CPF VÁLIDO!</p>";
                            }else{
                                  echo "<br><p class='text-danger bg-danger text-bg-padding text-center'>CPF INVÁLIDO!</p>";
                            }
                        }else{
                           echo "<br><p class='text-danger bg-danger text-bg-padding text-center'>CPF INVÁLIDO!</p>";
                        }
                    }
                }    
?>
                                 
              </form>
          </div>    
        </body>
    </html>
