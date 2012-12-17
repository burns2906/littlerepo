<?php
include('config.php');
function connectdb(){
global $database;

$dbcon=@mysql_connect($database['host'], $database['user'], $database['password']);
  $dbsel=@mysql_select_db($database['name']);
  if(!$dbcon) die('Datenbankzugriff gescheitert! Bitte nochmal probieren.');
}

function mysql_fetch_rowsarr($result, $numass=MYSQL_BOTH) {

  $i=0;
  $keys=@array_keys(mysql_fetch_array($result, $numass));
  @mysql_data_seek($result, 0);
    while ($row =@mysql_fetch_array($result, $numass)) {
      foreach ($keys as $speckey) {
        $got[$i][$speckey]=$row[$speckey];
      }
    $i++;
    }
  return $got;
}

/*function create_adminmenu()
{echo'
<ul id="admin_menu_container">
<li id="admin_menu_button1" onclick="javascript:admin_menu_buttonclick(\'1\');">logout</li>

</ul>';
}*/
function create_pagehead(){
global $pagetitle,$stylesheet;
echo'<html>
<head>
<title>'.$pagetitle.'</title>
<link href="'.$stylesheet.'" rel="stylesheet" type="text/css" />
</head>
<body>';
}
function create_pageheader(){
global $logo;
$content='';
$content.='<div id="header">
<div id="logo"><img src="'.$logo.'"/></div>';
$content.=create_pagemenu();
$content.='</div>';
echo $content;
}



function create_pagemenu(){
connectdb();
$content='';
$content.='<div id="menubg"><div id="menu">';

$menuitemsarr=mysql_fetch_rowsarr(mysql_query('SELECT * FROM menu ORDER BY itemorder ASC'));
for($i=0;$i<sizeof($menuitemsarr);$i++){
  $content.='<span class="menubutton"><a href="'.$menuitemsarr[$i]['itempage'].'.php">'.$menuitemsarr[$i]['itemname'].'</a></span>';
}

$content.='</div></div>';



echo $content;

}


function create_contentfooter(){
$content='<div id="ticker">
<marquee behaviour="scroll" direction="left" scrollamount="3">+++ticker+++  +++ticker+++  +++ticker+++</marquee>
</div>';
echo $content;
}
function create_pagefooter(){
$content='</body></html>´';
echo $content;
}



function create_pageitem($type,$content){
switch($type){
case 'text':
$result='<p>'.$content.'</p>';
break;

case 'headline':
$result='<h3>'.$content.'</h3>';
break;

case 'sports':
$sportsarr=explode('[td]',$content);
$result.='<tr><td>'.$sportsarr[0].'</td><td>'.$sportsarr[1].'</td><td>'.$sportsarr[2].'</td><td>'.$sportsarr[3].'</td></tr>';

}
return $result;

}


function create_page($pagetitle){
connectdb();
$content='';
$pageitemsarr=mysql_fetch_rowsarr(mysql_query('SELECT * FROM pages WHERE pagename="'.$pagetitle.'" ORDER BY itemorder ASC'));
for($i=0;$i<sizeof($pageitemsarr);$i++){
  $content.=create_pageitem($pageitemsarr[$i]['itemtype'],$pageitemsarr[$i]['itemcontent']);
}
echo $content;
}

?>