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
        //verifica se o botao foi precionado
        /*if(isset($_POST['verificar'])){       
           if($novoCalculo->cpf_invalido($_REQUEST['nCpf'])){
                   if($novoCalculo->calculo_cpf($_REQUEST['nCpf'])){
                      echo "<p>CPF válido</p>";
                   }else{
                      echo "<p>CPF inválido</p>";
                   }
            }else{
               echo "<p>CPF inválido</p>";
            }
        }*/
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
            <script type="text/javascript" src="_jquery/jquery-1.2.6.pack.js"></script>
            <script type="text/javascript" src="_jquery/jquery.maskedinput-1.1.4.pack.js"></script>
            <script type="text/javascript">$(document).ready(function(){	$("#vCpf").mask("999.999.999-99");});</script>            
        </head>
        <body>
          <div>
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
                  <input type=submit name = "verificar" value=VERIFICAR >
                  <input type=submit name = "gerar" value=GERAR>
                  <input type=submit name = "limpar" value=LIMPAR >
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
