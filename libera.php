<?php
	ob_start();
	require_once('header.html');
 	session_start();
	$now = time(); // checking the time now when home page starts
   	if($now > $_SESSION['expire']){
            session_destroy();
            header('Location: loginSel.php?erro=3');
    }
?>

<!-- MAIN -->
<div id="main">
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
<?php
if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
	$saida = "";
	$ip1=trim(strip_tags($_REQUEST['ip1']));
	$ip2=trim(strip_tags($_REQUEST['ip2']));
	if(isset($ip1) && $ip1 != NULL && isset($ip2) && $ip2 != NULL){
		if(is_numeric($ip1) && is_numeric($ip2) && $ip1 >= 0 && $ip1 <= 255 && $ip2 >= 0 && $ip2 <= 255){
			$ip = "10." . $ip1 . "." . $ip2 . ".0";
			if(isset($_REQUEST["servico"]) && $_REQUEST["servico"] != NULL ){
				$servico = $_REQUEST["servico"];
				for ($i = 0;$i < count($servico);$i++){
					$saida = shell_exec('/bin/liberafirewall.sh '.$servico[$i].' '.$ip.' '.$username);
				}
				echo "<span class=\"sub\">".$saida."</span>";
			}
			else{
                                header('Location: firewall.php?erro=2');
				//echo "<script> window.location = 'firewall.php?erro=2'; </script>" ;
			}
		}
		else{
                        //echo "<script> window.location = 'firewall.php?erro=1'; </script>" ;
			header('Location: firewall.php?erro=1');
		}
	}
	else{
                header('Location: firewall.php?erro=3');
               //echo "<script> window.location = 'firewall.php?erro=3'; </script>" ;
	}
}
else{
        header('Location: loginSel.php');
	//echo "<script> window.location = 'loginSel.php'; </script>" ;
}
?>

		<br />
		<div align="center">
        	<input type="button" value="Voltar" onclick="goBack()" />
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
ob_flush();
?>