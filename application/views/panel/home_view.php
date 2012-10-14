<?php
echo "<h1>Hi ".$this->session->userdata('username')." </h1><br />";
$hidden = array('username'=> $this->session->userdata('username'));
echo form_open('panel/logout', '', $hidden);
echo form_submit('logout', 'Logout!');
echo form_close();
?>