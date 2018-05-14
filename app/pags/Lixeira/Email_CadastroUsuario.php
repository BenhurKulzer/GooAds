<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require('PHPMailer_5.2.1/class.phpmailer.php');

	$mail = new PHPMailer(); //instancia a classe
		
	$mail->IsSMTP();
	$mail->SMTPAuth   	= true;
	$mail->SMTPSecure 	= "ssl";
	$mail->Host       	= "smtp.gmail.com";
	$mail->Port      	= 465;

	$mail->FromName 	= "SOS HD - Sistema de Ordens de Servico";
	$mail->Username  = '';
  $mail->Password   = '';
	$mail->CharSet 		= 'UTF-8';

	$message = "
<html>
  <head>
    
    <style type='text/css'>
      @media only screen and (min-width: 620px){.wrapper{min-width:600px !important}.wrapper h1{}.wrapper h1{font-size:64px !important;line-height:63px !important}.wrapper h2{}.wrapper h2{font-size:30px !important;line-height:38px !important}.wrapper h3{}.wrapper h3{font-size:22px !important;line-height:31px !important}.column{}.wrapper .size-8{font-size:8px !important;line-height:14px !important}.wrapper .size-9{font-size:9px !important;line-height:16px !important}.wrapper .size-10{font-size:10px !important;line-height:18px !important}.wrapper .size-11{font-size:11px !important;line-height:19px !important}.wrapper .size-12{font-size:12px !important;line-height:19px !important}.wrapper .size-13{font-size:13px !important;line-height:21px !important}.wrapper .size-14{font-size:14px !important;line-height:21px !important}.wrapper .size-15{font-size:15px !important;line-height:23px 
      !important}.wrapper .size-16{font-size:16px !important;line-height:24px !important}.wrapper .size-17{font-size:17px !important;line-height:26px !important}.wrapper .size-18{font-size:18px !important;line-height:26px !important}.wrapper .size-20{font-size:20px !important;line-height:28px !important}.wrapper .size-22{font-size:22px !important;line-height:31px !important}.wrapper .size-24{font-size:24px !important;line-height:32px !important}.wrapper .size-26{font-size:26px !important;line-height:34px !important}.wrapper .size-28{font-size:28px !important;line-height:36px !important}.wrapper .size-30{font-size:30px !important;line-height:38px !important}.wrapper .size-32{font-size:32px !important;line-height:40px !important}.wrapper .size-34{font-size:34px !important;line-height:43px !important}.wrapper .size-36{font-size:36px !important;line-height:43px !important}.wrapper 
      .size-40{font-size:40px !important;line-height:47px !important}.wrapper .size-44{font-size:44px !important;line-height:50px !important}.wrapper .size-48{font-size:48px !important;line-height:54px !important}.wrapper .size-56{font-size:56px !important;line-height:60px !important}.wrapper .size-64{font-size:64px !important;line-height:63px !important}}
    </style>

  </head>

  <body class='no-padding' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;'>

    <table class='wrapper' style='border-collapse: collapse;table-layout: fixed;min-width: 320px;width: 100%;background-color: #fff;' cellpadding='0' cellspacing='0' role='presentation'>
      <tbody>
        <tr>
          <td>
            <div role='banner'>

              <div class='header' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);' id='emb-email-header-container'>
                  <div class='logo emb-logo-margin-box' style='font-size: 26px;line-height: 32px;Margin-top: 6px;Margin-bottom: 20px;color: #c3ced9;font-family: Roboto,Tahoma,sans-serif;Margin-left: 20px;Margin-right: 20px;' align='center'>
                    <div class='logo-center' align='center' id='emb-email-header'><img style='display: block;height: auto;width: 100%;border: 0;max-width: 166px;' src='images/soslogo.png' alt='' width='166' /></div>
                  </div>
                </div>
              </div>

              <div role='section'>
                <div style='background-color: #4b5462;background-position: 0px 0px;background-image: url(https://i1.createsend1.com/ei/j/9A/1EC/647/010406/csfinal/1.jpg);background-repeat: repeat;'>
                  <div class='layout one-col' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                    <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;'>

                    <div class='column' style='max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);text-align: left;color: #8e959c;font-size: 14px;line-height: 21px;font-family: sans-serif;'>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;line-height: 110px;font-size: 1px;'>&nbsp;</div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;mso-text-raise: 4px;'>
                          <h1 class='size-64' style='Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #000;font-size: 44px;line-height: 50px;font-family: avenir,sans-serif;text-align: center;' lang='x-size-64'><span class='font-avenir'><strong><span style='color:#ffffff'>Olá ".$tSocial.",</span></strong></span></h1>
                          <h1 class='size-64' style='Margin-top: 20px;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #000;font-size: 44px;line-height: 50px;font-family: avenir,sans-serif;text-align: center;' lang='x-size-64'><span class='font-avenir'><strong><span style='color:#ffffff'>Seja Bem vindo ao Sistema</span></strong></span></h1>
                          <h1 class='size-64' style='Margin-top: 20px;Margin-bottom: 20px;font-style: normal;font-weight: normal;color: #000;font-size: 44px;line-height: 50px;font-family: avenir,sans-serif;text-align: center;' lang='x-size-64'><span class='font-avenir'><strong><span style='color:#ffffff'>SOS HD</span></strong></span></h1>
                        </div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;mso-text-raise: 4px;'>
                          <p class='size-17' style='Margin-top: 0;Margin-bottom: 20px;font-size: 17px;line-height: 26px;text-align: center;' lang='x-size-17'><em><span style='color:#fff'>Abaixo est&#227;o os seus dados de acesso.</span></em></p>
                        </div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;line-height: 85px;font-size: 1px;'>&nbsp;</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>


              <div style='background-color: #281557;'>
                <div class='layout one-col' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                  <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;'>
                  
                    <div class='column' style='max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);text-align: left;color: #8e959c;font-size: 14px;line-height: 21px;font-family: sans-serif;'>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;line-height: 50px;font-size: 1px;'>&nbsp;</div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;mso-text-raise: 4px;'>
                          <h1 class='size-48' style='Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #000;font-size: 36px;line-height: 43px;font-family: avenir,sans-serif;text-align: left;' lang='x-size-48'><span class='font-avenir'><font color='#ffffff'><strong>Acesso:<br><a href='https://sistema.soshd.com.br'>sistema.soshd.com.br</a></strong></font></span></h1>

                          <h1 class='size-48' style='Margin-top: 20px;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #000;font-size: 36px;line-height: 43px;font-family: avenir,sans-serif;text-align: left;' lang='x-size-48'><span class='font-avenir'><font color='#ffffff'><strong>Login:<br>".$tCpf."</strong></font></span></h1>

                          <h1 class='size-48' style='Margin-top: 20px;Margin-bottom: 20px;font-style: normal;font-weight: normal;color: #000;font-size: 36px;line-height: 43px;font-family: avenir,sans-serif;text-align: left;' lang='x-size-48'><span class='font-avenir'><font color='#ffffff'><strong>Senha:<br>".$_POST['passSenhaC']."</strong></font></span></h1>
                        </div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;line-height: 15px;font-size: 1px;'>&nbsp;</div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div class='btn btn--shadow btn--large' style='Margin-bottom: 20px;text-align: center;'>
                          <a style='width: 100%; border-radius: 4px;display: inline-block;font-size: 14px;font-weight: bold;line-height: 24px;padding: 12px 24px 13px 24px;text-align: center;text-decoration: none !important;transition: opacity 0.1s ease-in;color: #fff !important;box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.2);background-color: #e31212;font-family: sans-serif;' href='https://sistema.soshd.com.br'>Acessar Sistema</a>
                        </div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;mso-text-raise: 4px;'>
                          <p class='size-17' style='Margin-top: 0;Margin-bottom: 20px;font-size: 17px;line-height: 26px;text-align: center;' lang='x-size-17'><em><span style='color:#fff'>Ao acessar o sistema você poderá alterar sua senha ;).</span></em></p>
                        </div>
                      </div>

                      <div style='Margin-left: 20px;Margin-right: 20px;'>
                        <div style='mso-line-height-rule: exactly;line-height: 35px;font-size: 1px;'>&nbsp;</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div style='mso-line-height-rule: exactly;line-height: 20px;font-size: 20px;'>&nbsp;</div>

              <div style='mso-line-height-rule: exactly;' role='contentinfo'>
                <div class='layout email-footer' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                  <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;'>

                    <div class='column wide' style='text-align: left;font-size: 12px;line-height: 19px;color: #adb3b9;font-family: sans-serif;Float: left;max-width: 400px;min-width: 320px; width: 320px;width: calc(8000% - 47600px);'>
                      <div style='Margin-left: 20px;Margin-right: 20px;Margin-top: 10px;Margin-bottom: 10px;'>

                        <div style='font-size: 12px;line-height: 19px;'></div>
                        <div style='font-size: 12px;line-height: 19px;Margin-top: 18px;'></div>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div style='mso-line-height-rule: exactly;line-height: 40px;font-size: 40px;'>&nbsp;</div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>";

	/*$message   = "<p>Olá <b>".$tNome."</b>,</p>

	<p>Abaixo estão os seus dados de acesso ao sistema SOS HD</p>
	<br>
	<p>Acesso: <a href='https://sistema.soshd.com.br'>sistema.soshd.com.br</a></p>
	<p>Login: Seu Número de CPF (".$tCpf.")</p>
	<p>Senha: ".$_POST['passSenhaC']."</p>

	<p>Quaisquer dúvidas podem ser esclarecidas com a Gerencia ou Departamento de TI.</p>

	<p>Te desejamos um ótimo trabalho,</p>
	<br>
	<p>Equipe SOS HD | 2018</p>
	<a href='https://soshdrecuperacaodedados.com.br/'>https://soshdrecuperacaodedados.com.br/ </a>
	<br>
	<p>Obs.: Não responda a este email. Gerado automáticamente pelo Sistema SOS HD.</p>";*/
	
	$mail->IsHTML(true);
	$mail->Subject 		= 'Bem Vindo ao Sistema de OS - SOS HD';//assunto do email
	$mail->AltBody 		= "SOS HD | 2018";
	$mail->CharSet 		= 'UTF-8';

	$mail->Body 		= stripslashes($message);
	$mail->AddAddress($tEmail);//email do destinatario
	$mail->AddReplyTo('ti@grupobras.com', 'Depto TI - Grupobras');
	
	$mail->Send();

	$mail->IsHTML(true); // send as HTML

?>