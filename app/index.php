<?php session_start(); require("includes/SistemaConfig.inc.php");?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SOS HD - Sistema de Atendimentos</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">

    </head>

    <body>

      <?php

        require_once("includes/ConnDatabase.php");
        require_once("includes/LogSistema.php");

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

          $tEmail = isset($_POST["txtCpfC"]) ? addslashes(trim($_POST["txtCpfC"])) : FALSE;
          $tSenha = isset($_POST["txtSenha"]) ? trim($_POST["txtSenha"]) : FALSE;
          $tSenha = criptografar($tSenha,"k49fdk4030d");

          $tSql   = $tPdo->prepare ("SELECT * FROM usuarios_colaboradores WHERE CPF_U = '{$tEmail}'");
          $tSql   ->execute();
          $tTotal = $tSql->rowCount();

            if($tTotal) {
              $tDU = $tSql->fetch(PDO::FETCH_ASSOC);

              if(!strcmp($tSenha, $tDU["SENHA_U"])) {

                $_SESSION["IDUSER"]    = $tDU["ID_USER"];
                $_SESSION["LOGINUSER"] = stripslashes($tDU["NOME_SOCIAL_U"]);
                $_SESSION["NIVELUSER"] = stripslashes($tDU["EMAIL_U"]);
                $_SESSION["FOTOUSER"]  = $tDU["FotoPerfil_U"];

                $tMensagem = '<div class="alert alert-success">'. $_SESSION["LOGINUSER"] . LOGINACEITO .  LogSistema(LOGSISTEMA,$t) . '</div>'; 

              } else {
                $tMensagem = '<div class="alert alert-warning">'. SENHAERRO . '</div>';
              }

          } else {
              $tMensagem = '<div class="alert alert-error">'. LOGINERRO . '</div>'; 
          }
        }

      ?>

      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
          
          <div class="navbar-header">
            <h1 style="text-shadow: 2px 2px 5px black;color: #fff;"><strong>SOS HD</strong> - Sistema de Gerenciamento</h1>
          </div>
          
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            
              <li>
                <a href="/">
                  Voltar ao Site
                </a>
              </li>
            </ul>
          </div>

        </div>
      </nav>

      <!-- Top content -->
      <div class="top-content">
        <div class="inner-bg">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1">
                <div class="form-box" style="box-shadow: 0px 3px 15px 5px #00000070;">
                  <div class="form-top">
                    <div class="form-top-left">
                      <h3>Acesse o sistema...</h3>
                      <p>Utilize seus dados para acessar o sistema:</p>
                    </div>

                    <div class="form-top-right">
                      <img src="/images/logo.png">
                    </div>
                  </div>
                
                  <div class="form-bottom">
                    
                    <hr>

                      <div class="form-group">
                        <?php if(isset($tMensagem)){ echo $tMensagem;}?>
                      </div>
                    
                      <form role="form" action="index.php" method="post" class="login-form">
                        <div class="form-group">
                          <label for="form-username">Login:</label>
                          <input type="text" name="txtCpfC" id="txtCpfC" placeholder="Informe seu CPF..." class="form-username form-control">
                        </div>
                      
                        <div class="form-group">
                          <label for="form-password">Senha:</label>
                          <input type="password" name="txtSenha" id="txtSenha" placeholder="*******" class="form-password form-control">
                        </div>
                        
                        <div class="text-center">
                          <button type="submit" class="btn">Acessar o sistema!</button>
                        </div>
                      </form>
                    
                    <hr>
                  
                    <div class="forgot text-center">
                      <a href="#" style="color: #0087ff;">Esqueceu sua Senha?</a>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer footer-transparent">
        <div class="container">
          <div class="copyright">
            © <script>document.write(new Date().getFullYear())</script>, Desenvolvido por TI - SOS HD
          </div>
        </div>
      </footer>

      <!-- Javascript -->
      <script src="assets/js/jquery-1.11.1.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/js/jquery.backstretch.min.js"></script>
      <script src="assets/js/scripts.js"></script>

    </body>

</html>

<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
   v_obj=o
   v_fun=f
   setTimeout("execmascara()",1)
}
function execmascara(){
   v_obj.value=v_fun(v_obj.value)
}
function mcpf(v){
   v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}
function id( el ){
return document.getElementById( el );
}
window.onload = function(){
id('txtCpfC').onkeyup = function(){
mascara( this, mcpf );
}
}
</script>