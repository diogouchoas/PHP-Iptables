<?php
	ob_start();
	session_start();
	$now = time(); // checking the time now when home page starts
   	if($now > $_SESSION['expire']){
		session_destroy();
                header('Location: loginSel.php?erro=3');
                //echo "<script> window.location = 'loginSel.php?erro=3'; </script>" ;
    	}
	if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
		require_once('header.html');
				?>
			
			<!-- MAIN -->
			<div id="main" >
				<!-- wrapper-main -->
				<div class="wrapper">
					
					<!-- headline -->
					<div class="clear"></div>
					<div id="headline">
						<span class="main"><b>Liberação Firewall</b></span><br>
						<span class="sub"><b>&nbsp;&nbsp;Bem-vindo, <?php echo $_SESSION['displayname']; ?></b> &nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a></span>
					</div>
					<!-- ENDS headline -->
					
					<!-- content -->
					<div id="content" >
				<div id="page-content">
    <form action="libera.php" method="post" name="liberafirewall" id="liberafirewall" >
    
             	<b>Faixa de IP:</b><br/>
                10 <b>.</b> <input type="text" id="ip1" name="ip1" size="2" maxlength="3" /> <b>.</b> <input type="text" id="ip2" name="ip2" size="2" maxlength="3" /> <b>.</b> 0
        		<br /> 
                <?php
					if (isset($_REQUEST['erro'])){
						$erro = strip_tags($_REQUEST['erro']);
						if($erro == 1){
							echo "<font color=\"red\">IP Inv&aacute;lido</font>";
						}
						if($erro == 3){
							echo "<font color=\"red\">Preencha os campos do IP</font>";
						}
						
					}
				?>				      
            	<br />
            	<b>Serviços:</b><br/>
            	<input type="checkbox" id="servico[]" name="servico[]" value="gaia.animaeducacao.com.br" /> GAIA &nbsp; 
                <input type="checkbox" id="servico[]" name="servico[]" value="datasulteste.anima.intranet" /> Datasul Teste
                <br />
                <?php
                	if (isset($_REQUEST['erro'])){
						$erro = strip_tags($_REQUEST['erro']);
						if($erro == 2){
							echo "<font color=\"red\">Escolha ao menos um servi&ccedil;o</font>";
						}
					}
				?>
                <br /><br />
            
        	<input type="submit" value="Enviar" /> 
        
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
	
			<?php
			}
			else{
				header('Location: loginSel.php');
                                
			}
			?>
	</body>
</html>
<?php
    ob_flush();
?>