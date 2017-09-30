<?php
require('header.php');
?>
<style type="text/css">
input{ width: 50%;}
</style>
<div class="wrap">
    <div class="info">
        <h2>Create new VM</h2>
    </div>
    <div class="list">
        <form class="form-horizontal" method="post" action="create_xml.php">
            <div class="control-group">
                <label class="control-label" for="inputName">Name</label>
                <div class="controls">
                    <input type="text" id="inputName" name="vmname">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputMemory">Memory in GB</label>
                <div class="controls">
                    <select name="memory">
                        <option value="1">1GB</option>
                        <option value="2">2GB</option>
                        <option value="4">4GB</option>
                        <option value="6">6GB</option>
                        <option value="8">8GB</option>
                        <option value="10">10GB</option>
                        <option value="12">12GB</option>
                        <option value="14">14GB</option>
                        <option value="16">16GB</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputHvm">Architecture</label>
                <div class="controls">
                    <input type="text" id="inputHvm" name="hvm" value="x86_64" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputVcpu">vCPU's</label>
                <div class="controls">
                    <select name="vcpu">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputIso">Select Image</label>
                <div class="controls">
                    <select name="iso">
                        <option value="Windows7.iso">Windows 7</option>
                        <option value="Windows8.iso">Windows 8.1</option>
                        <option value="Windows10.iso">Windows 10</option>
                        <option value="CentOS7.iso">CentOS 7</option>
                        <option value="Ubuntu.iso">Ubuntu Server</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputBridge">Select NIC</label>
                <div class="controls">
                    <input type="text" id="inputBridge" name="bridge" value="public" readonly>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
