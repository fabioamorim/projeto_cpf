<?php
    /*
     *System: Gerador e validador de CPF v. 1.0
     *Data:20/08/2016
     *Autor: Fábio Batista do Amorim
     */
      
      include_once ('_class/calculo.class.php');
      
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
            <link rel="stylesheet" type="text/css" href="_css/style.css"/>
            <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
            <script type="text/javascript" src="_jquery/jquery-1.2.6.pack.js"></script>
            <script type="text/javascript" src="_jquery/jquery.maskedinput-1.1.4.pack.js"></script>
            <script type="text/javascript">$(document).ready(function(){	$("#vCpf").mask("999.999.999-99");});</script>            
        </head>
        <body>
          <div>
              <h1>Gerador e validador de CPF</h1>
              <p>Este sistema tem a funcionalidade de gerar CPFs válidos, porém não necessariamente já existentes.<br />
                 Apenas validando os dígitos verificadores. Também validar CPFs digitados utilizando a mesma logica.</p>
              <form id="form_cpf" method=POST action="?check=true">
                <fieldset class="field_cpf">
                   CPF:<br><input type=text name="nCpf" id="vCpf" maxlength=14
                            <?php                            
                                 //Este if verifica se check é verdadeiro e se o botão gerar foi precionado e gera um CPF válido aleatório para o text
                                 if(isset($_REQUEST["check"]) && isset($_POST['gerar'])){echo "value='".$novoCalculo->gerar()."'";}
                                 if(isset($_REQUEST["check"]) && isset($_POST['verificar'])){echo "value='".$_POST['nCpf']."'";}
                            ?>
                           >

                        <br><br>

                  <button class='botao' name = "verificar">VERIFICAR</button>
                  <button class='botao' name = "gerar">GERAR</button>
                  <button class='botao' name = "limpar">LIMPAR</button>
<?php
                if($valida){
                    if(isset($_POST['verificar'])){       
                        if($novoCalculo->cpf_invalido($_REQUEST['nCpf'])){
                            if($novoCalculo->calculo_cpf($_REQUEST['nCpf'])){
                                  echo "<p class='valido'>CPF VÁLIDO!</p>";
                            }else{
                                  echo "<p class='invalido'>CPF INVÁLIDO!</p>";
                            }
                        }else{
                           echo "<p class='invalido'>CPF INVÁLIDO!</p>";
                        }
                    }
                }    
?>
                </fieldset>                  
              </form>
          </div>    
        </body>
    </html>
