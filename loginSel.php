<?php
	session_start();
	if(!isset($_SESSION['username'])){
		require_once('header.html');
	
?>
			
			<!-- MAIN -->
			<div id="main">
				<!-- wrapper-main -->
				<div class="wrapper">
					
					<!-- headline -->
					<div class="clear"></div>
					<div id="headline">
						<span class="main"><b>Bem-vindo</b></span>
											
					</div>
										<div id="content">
				<div id="page-content">
							
    <form action="login.php" method="post" id="login">
    
             	<b>Usuario:&nbsp;</b><br/>
                <input type="text" id="username" name="username" size="25" autocomplete="off" /><br/>
           
                <b>Senha:&nbsp;</b><br/>
                <input type="password" id="password" name="password" size="25" autocomplete="off" /> <br/>
                <?php
					if (isset($_REQUEST['erro'])){
						$erro = strip_tags($_REQUEST['erro']);
						if($erro == 1){
							echo "<font color=\"red\">Dados Inválidos</font>";
						}
						if($erro == 2){
							echo "<font color=\"red\">Usuário sem privilégios de acesso</font>";
						}
						if($erro == 3){
							echo "<font color=\"red\">Sess&atilde;o expirada! Efetue login novamente</font>";
						}
					}
				?>				
				<br/><br/>
                <input type="submit" value="Entrar" /> 
                  
    </form>

		
		
					</div>
					</div>
					<!-- ENDS content -->
				</div>
				<!-- ENDS wrapper-main -->
			</div>
			<!-- ENDS MAIN -->
					<!-- Bottom -->
			<div id="bottom">
				<!-- wrapper-bottom -->
				<div class="wrapper">
					<div id="bottom-text"></div>
					
				</div>
				<!-- ENDS wrapper-bottom -->
			</div>
			<!-- ENDS Bottom -->
	
			
	</body>
</html>

<?php
	}
else{
	echo "<script> window.location = 'firewall.php'; </script>" ;
}
  