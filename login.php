<?php
ob_start();
require_once('config.php');
$username = trim(strip_tags($_POST['username']));
$password = trim(strip_tags($_POST['password']));
$grouppermitted = $config_array['access_group'];
if ($username != NULL && $password != NULL){
	include (dirname(__FILE__) . "/adLDAP/src/adLDAP.php");
    try {
    	$adldap = new adLDAP($config_array);
    }
	catch (adLDAPException $e) {
        echo $e; 
    	exit();   
	}
	if ($adldap->authenticate($username, $password)){
		$groupmember=false;
		$usergroups = $adldap->user()->info($username,array("memberof"));
		$displayname = $adldap->user()->info($username,array("displayname"));
		for ($i = 0;$i < $usergroups[0]['memberof']['count']; $i++){
			if(strpos($usergroups[0]['memberof'][$i],$grouppermitted)){
				$groupmember=true;	
			}
		}
		if($groupmember == false){
                        header('Location: loginSel.php?erro=2');
                        //echo "<script> window.location = 'loginSel.php?erro=2'; </script>" ;
		}
		if($groupmember == true){
			session_start();
			$_SESSION['start'] = time(); // taking now logged in time
			$_SESSION['expire'] = $_SESSION['start'] + ($config_array['session_expire'] * 60) ;
			$_SESSION["username"] = $username;	
			//$_SESSION["usergroups"] = $usergroups;
			$_SESSION["displayname"] = $displayname[0]['displayname'][0];
			$redir = "Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "firewall.php";
			header($redir);
		}
		
	}
	else{
                header('Location: loginSel.php?erro=1');
		//echo "<script> window.location = 'loginSel.php?erro=1'; </script>" ;
	}
}
else{
        header('Location: loginSel.php');
	//echo "<script> window.location = 'loginSel.php'; </script>" ;
}

?>