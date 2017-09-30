<?php
	function createDiskEsxi($name, $size) {
		include('Net/SSH2.php');
		include('settings.php');
		$ssh = new Net_SSH2($connectServer);
		if (!$ssh->login($usernameEsxi, $passwordEsxi)) {
			exit('Login Failed');
		}
		echo $ssh->exec('mkdir /vmfs/volumes/SAN/'.$name.'; cd /vmfs/volumes/SAN/'.$name.'; vmkfstools -c 2048m '.$name.'.vmdk');
		
	}
?>