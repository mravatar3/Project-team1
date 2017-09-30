<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$uri="esx:///192.168.0.180";
$conn = libvirt_connect($uri);
print_r(libvirt_connect_get_hostname($conn));
$doms1 = libvirt_list_domains($conn);
print_r($doms1);
$doms = libvirt_list_active_domains($conn);
print_r($doms);
?>