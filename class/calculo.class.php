<?php
    /*
     *System: Gerador e validador de CPF v. 1.1
     *Data:20/08/2016
     *Atualização: 04/03/2017
     *Autor: Fábio Batista do Amorim
     */
    class calculo{        
        
        private $dig_primeiro;//Variável em que o primeiro digito do calculo será armazenado
        private $dig_segundo; //Variável em que o segundo digito do calculo será armazenado
        
        
        //Esta função é reponsável por pegar o número do cpf digitado e retornar true ou false para a validação 
        public function calculo_cpf($reques_cpf){
                                  
            $this->primeiro_digito($reques_cpf);
            $this->segundo_digito($reques_cpf);
            
           
            /*echo "Primeiro digito: ".$this->dig_primeiro."<br>";
            echo "Segundo digito: ".$this->dig_segundo."<br><br>";
            echo "verifica ".substr($reques_cpf,12,1)."<br>";
            echo "verifica ".substr($reques_cpf,13,1)."<br>";*/            
           
            if($this->dig_primeiro == substr($reques_cpf,12,1) && $this->dig_segundo == substr($reques_cpf,13,1)){
               return true;
            }else{
               return false;
            }            
        }    
        
        /*Formata o CPF retirando os pontos e traço, deixando apenas números
          Ex: 999.999.999-99 = 99999999999 */
        private function formata_cpf($request_cpf, $flag){

            /*Flag 1 = Primeiro Dígito verificador
            * Flag 2 = Segundo Dígito verificador
            */

            
            if($flag == 1){
                $response_cpf = str_replace(".","",$request_cpf);
                $response_cpf = str_replace("-","",$response_cpf);
                $response_cpf = substr($response_cpf,0,9);
                return $response_cpf;
             
            }else if($flag == 2){
                $response_cpf = str_replace(".","",$request_cpf);
                $response_cpf = str_replace("-","",$response_cpf);
                $response_cpf = substr($response_cpf,0,10);
                $aux = 11;
                return $response_cpf;
            }else{
                $response_cpf = str_replace(".","",$request_cpf);
                $response_cpf = str_replace("-","",$response_cpf);
                return $response_cpf;
            }
            
        }
        
        //Calcula o primeiro digito e armazena em $dig_primeiro
        private function primeiro_digito($request_cpf){
                        
            $aux = 10;// Variável que será decrementada para realização do calculo
            $soma = 0; // Somatória do calculo 
            
            $response_cpf = $this->formata_cpf($request_cpf,1);
            
            for($count = 0; $count <= strlen($response_cpf); $count++){
                        
                $resp = $aux * substr($response_cpf,$count,1);
                $soma +=$resp;
                $aux --;
            }
           
            // Coletar o resto da divisão da somatória por 11 
            $this->dig_primeiro = ($soma%11);
            
            /* Se caso o resto da divisão for menor que dois, o digito  verificador será igual a 0,
               subtrair 11 pelo resto.*/
            if($this->dig_primeiro < 2){
                $this->dig_primeiro = 0;
            }else{
                $this->dig_primeiro = 11-$this->dig_primeiro; 
            }
            
        }
        
        // Calcula o segundo digito e armazena em $dig_segundo
        private function segundo_digito($request_cpf){
           
            $aux = 11;// Variável que será decrementada para realização do calculo
            $soma = 0;// Somatória do calculo
            
            $response_cpf = $this->formata_cpf($request_cpf,2);
            
            for($count = 0; $count <= strlen($response_cpf); $count++){
               
                $resp = $aux * substr($response_cpf,$count,1);
                $soma +=$resp;
                $aux --;

            }
            
             // Coletar o resto da divisão da somatória por 11
            $this->dig_segundo = ($soma%11);
            
            /* Se caso o resto da divisão for menor que dois, o digito  verificador será igual a 0,
               subtrair 11 pelo resto.*/
            if($this->dig_segundo < 2){
                $this->dig_segundo = 0;
            }else{
                $this->dig_segundo = 11 - $this->dig_segundo;
            }
        }       
        
        //Invalída cpfs conhecidos         
        public function cpf_invalido($request_cpf){
            
            $request_cpf = $this->formata_cpf($request_cpf,3);
            
            if( strlen($request_cpf) != 11 ||  
                $request_cpf == "00000000000" || 
                $request_cpf == "11111111111" || 
                $request_cpf == "22222222222" || 
                $request_cpf == "33333333333" || 
                $request_cpf == "44444444444" || 
                $request_cpf == "55555555555" || 
                $request_cpf == "66666666666" || 
                $request_cpf == "77777777777" || 
                $request_cpf == "88888888888" || 
                $request_cpf == "99999999999"){
        
                return false;
                
           }else{
                return true; 
           }
        }
        
        // Gera CPFs vállidos 
        public function gerar(){
            $response_cpf ="";
            
            // laço gera nove números aleatórios entre 0 e 9 e concatena na variável $response
            for($count = 0; $count < 9; $count++){
                 $response_cpf .= rand(1,9);
            }           
            
            $this->primeiro_digito($response_cpf);
            $response_cpf .= $this->dig_primeiro;
            $this->segundo_digito($response_cpf);
            $response_cpf .=$this->dig_segundo;
            
            return $response_cpf;
               
        }
    }