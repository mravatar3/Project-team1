<?php
    require('libvirt.php');
	include 'settings.php';
    $lv = new Libvirt('esx://'.$connectServer.'?no_verify=1', FALSE);
    $hn = $lv->get_hostname();
    if ($hn == false)
        die('Cannot open connection to hypervisor</body></html>');

    $vm_name = $_POST['vmname'];
    $res = @$lv->get_domain_by_name($name);
    if($res) exit('This VM already exsist， try again<a href="javascript:history.back(-1);">创建</a>！');
    
    $memory = ((int)$_POST['memory']) * 1024 * 1024;
    $vcpu = $_POST['vcpu'];
    $hvm = $_POST['hvm'];
    $bridge = $_POST['bridge'];
    $mac1 = exec('MACADDR="52:56:$(dd if=/dev/urandom count=1 2>/dev/null | md5sum | sed \'s/^\(..\)\(..\)\(..\)\(..\).*$/\1:\2:\3:\4/\')"; echo $MACADDR');
    $mac2 = exec('MACADDR="52:56:$(dd if=/dev/urandom count=1 2>/dev/null | md5sum | sed \'s/^\(..\)\(..\)\(..\)\(..\).*$/\1:\2:\3:\4/\')"; echo $MACADDR');
	
	// Dit gedeelte geeft aan welke ISO gemount wordt
	$iso = $_POST['iso'];
	
    exec("esx-img create -f qcow2 -o preallocation=metadata [SAN] ".$vm_name.".qcow2 100G");
	
    $xml = "<domain type='vmware' xmlns:vmware='http://libvirt.org/schemas/domain/vmware/1.0'>
				<name>".$vm_name."</name>
				<memory unit='KiB'>".$memory."</memory>
				<vcpu placement='static'>".$vcpu."</vcpu>
			<cputune>
				<shares>4000</shares>
			</cputune>
			<os>
				<type arch='x86_64'>hvm</type>
			</os>
			<clock offset='utc'/>
			<on_poweroff>destroy</on_poweroff>
			<on_reboot>restart</on_reboot>
			<on_crash>destroy</on_crash>
			<devices>
				<disk type='file' device='cdrom'>
                    <source file='[SAN] ".$iso."'/>
                    <target dev='hdb' bus='ide'/>
                    <readonly/>
                </disk>
				<disk type='file' device='disk'>
					<source file='[SAN] ".$vm_name."/".$vm_name.".vmdk'/>
					<target dev='sda' bus='scsi'/>
					<address type='drive' controller='0' bus='0' target='0' unit='0'/>
				</disk>
				<controller type='scsi' index='0' model='vmpvscsi'/>
					<interface type='bridge'>
						<mac address='00:0c:29:3b:84:8b'/>
						<source bridge='LOCAL-VM'/>
						<model type='vmxnet3'/>
					</interface>
				<video>
					<model type='vmvga' vram='4096' primary='yes'/>
				</video>
			</devices>
			<vmware:datacenterpath>ha-datacenter</vmware:datacenterpath>
			</domain>
";
            
    $res = $lv->domain_define($xml);

    $res = $lv->get_domain_by_name($vm_name);
    $uuid = libvirt_domain_get_uuid_string($res);
    $domName = $lv->domain_get_name_by_uuid($uuid);
    $lv->domain_start($domName);

    if(!empty($res)) header('Location:index.php');
    else exit($lv->get_last_error());
?>