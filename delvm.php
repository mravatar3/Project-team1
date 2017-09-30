<?php
    error_reporting(0);

    require('libvirt.php');
	include 'settings.php';
    $Libvirt = new Libvirt('esx://'.$connectServer.'/?no_verify=1');
    $hn = $Libvirt->get_hostname();
    if ($hn == false)
        die('Cannot open connection to hypervisor</body></html>');

    $name = $_GET['vmname'];
    $res = $Libvirt->get_domain_by_name($name);
    $ret = '';
    if(!$Libvirt->domain_is_running($res, $name)){
        if(!$Libvirt->domain_undefine($name)){
            $ret .= $name.'Deleting Failed!<br>';
        }else{
            exec("rm -f /data/vm/".$name.".qcow2");
            $ret .= $name.'Sucessfully deleted！<br>';
        }
    }else{
        $ret .= $name.'This VM is running, please shut down the VM before deleting！<br>';
    }

   header('Location:index.php');

?>