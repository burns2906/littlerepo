<?php
include('functions.php');
create_pagehead();
create_pageheader();
echo'<div id="pagecontent">';
echo'<table id="sportstable">';
create_page('sports');
echo'</table>';
echo'</div>';
create_contentfooter();
create_pagefooter();
?>