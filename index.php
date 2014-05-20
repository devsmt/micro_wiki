<?php


require_once('classTextile.php');
function parse_textile($content ) {
	$textile = new Textile();
	return $textile->TextileThis($content);
}



function request_get($k,$def){
	return isset($_REQUEST[$k]) ? $_REQUEST[$k] : $def;
}

$action=request_get('action','show');
$page=request_get('page',"HomePage");
$page_path = dirname(__FILE__)."/pages/$page";

if($action =='delete'  ){
	unlink($page_path);
} elseif($action =='save'  ){
	$text=request_get('text',null);

	if( !empty($text)) {
		file_put_contents($page_path,$text);
	} else {
		die('you are sending empty text');
	}
}


// leggi i contenuti
$file_content = '';
// se invia un nome di pagina nuovo, il file non esiste ancora
if( file_exists($page_path) ) {

	$file_content = file_get_contents($page_path);
}

if(!is_dir('pages')){
    mkdir('pages');
}
$all_pages = glob("pages/*");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>EV Wiki</title>

<style>
/* Baseline - a designer framework, Copyright (C) 2009 Stephane Curzi, ProjetUrbain.com, Creative Commons Attribution-Share Alike 3.0 License */
/* reset */
html,body,div,span,a,img,h1,h2,h3,h4,h5,h6,hgroup,p,dl,dialog,dt,dd,ol,ul,li,abbr,acronym,address,b,big,blockquote,cite,code,del,dfn,em,i,ins,kbd,pre,q,samp,tt,var,small,strong,sub,sup,object,iframe,form,fieldset,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,footer,header,nav,section,figure,menu,time,mark,audio,video{font-family:inherit;font-size:100%;font-weight:inherit;font-style:inherit;vertical-align:baseline;white-space:normal;text-align:left;margin:0;padding:0;border:0;outline:0;background:transparent}textarea{font-family:inherit;font-size:100%;font-weight:normal;font-style:normal;white-space:normal;text-align:left;margin:0;padding:0}article,aside,footer,header,nav,section,dialog,figure,hgroup,menu{display:block}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal}del,ins{text-decoration:none}ol,ul{list-style:none}nav ul{list-style-type:none}table{border-collapse:separate;border-spacing:0;background-color:transparent;width:auto;height:auto}:focus{outline:0}blockquote:before,blockquote:after,q:before,q:after{content:""}blockquote,q{quotes:"" ""}input{margin:0}applet,basefont,dir,font,isindex,menu,s,strike,u{font-family:inherit;font-size:100%;font-weight:normal;font-style:normal;white-space:normal;vertical-align:baseline;text-decoration:inherit;text-align:left;color:inherit;margin:0;padding:0;border:0;outline:0}dir,menu{list-style:none}nobr{white-space:normal}blink{text-decoration:none}marquee{overflow:visible}
/* base */
body{font-family:helvetica,arial,sans-serif;line-height:1.5;background:white;color:black}h1,h2,h3,h4,h5,h6{line-height:1.2}h4,h5,h6{font-weight:bold}b,strong,caption,th,thead,dt,legend{font-weight:bold}cite,dfn,em,i{font-style:italic}code,kbd,samp,pre,tt,var{font-family:mono-space,monospace}h1,h2,h3,h4,h5,h6{word-spacing:-0.125em}p{word-spacing:0.125em;hyphenate:auto;hyphenate-lines:3}p+p{text-indent:1.5em}p+p.no-indent{text-indent:0}pre{white-space:pre}del{text-decoration:line-through}mark{background:rgba(255, 255, 0, 0.4);padding:0 .25em}ins{color:#f00}small,sup,sub{font-size:80%}big{font-size:125%;line-height:80%}abbr,acronym{font-size:85%;text-transform:uppercase;letter-spacing:.1em}abbr[title],acronym[title],dfn[title]{border-bottom:1px dotted black;cursor:help}sup,sub{line-height:0}sup{vertical-align:super}sub{vertical-align:sub}blockquote{padding:1.5em}hr{border:none;background:#ddd;width:100%}ul,ol{margin-left:1.5em}ul{list-style:disc outside}ol{list-style:decimal outside}input,select,button{cursor:pointer}table{font:inherit;width:100%}article,aside,header,hgroup,nav,figure,section,footer{display:block}
.debug{outline:solid gold 1px}
.debug-background{background:rgba(255, 215, 0, 0.2) !important}
/* type */
body{font-size:75%;line-height:1.5}h1,h2,h3,h4,h5,h6{position:relative}h1,h2{line-height:36px;margin-bottom:18px}h1,h2,h3,h4{margin-top:18px}h3,h4,h5,h6{line-height:18px}h1{font-size:36px;top:5px}h2{font-size:28px;top:8px}h3{font-size:22px;top:1px}h4{font-size:18px;top:2px}h5{font-size:15px;top:4px}h6{font-size:13px;top:5px}h1:first-child,h2:first-child,h3:first-child,h4:first-child{margin-top:0}p,pre,address{font-size:13px;line-height:18px;position:relative;top:5px}small{font-size:11px}abbr,code,kbd,samp,small,var{line-height:15px}ul,ol,dl,dialog{font-size:13px;line-height:18px;position:relative;top:5px;margin-top:18px;margin-bottom:18px}li ul,li ol,ul ul,ol ol{top:0;margin-top:0;margin-bottom:0}li h1,li h2,li h3,li h4,li h5,li h6,li p{top:0}form,legend,label{font-size:13px;line-height:18px}legend{position:relative;top:5px}table{font-size:13px}caption{font-size:13px;line-height:18px;position:relative}hr{position:relative;height:4px;margin:18px 0 14px 0}
/* table */
table{border-collapse:collapse;border-top:solid 3px #000;position:relative;margin-top:18px}th,td{line-height:18px;padding:9px 18px 8px 0}thead th,thead td{padding-top:7px}tfoot th,tfoot td{padding-bottom:8px}tbody th,tbody td,tfoot th,tfoot td{border-top:solid 1px #000} th:first-child,td:first-child{padding-left:0}th:last-child,td:last-child{padding-right:0}tr:nth-child(even) td{}tbody tr:nth-child(odd) th,tbody tr:nth-child(odd) td{background:rgba(0, 0, 0, 0.035)}caption{top:5px;margin-bottom:18px}
/* form */
form{overflow:auto}legend{padding-bottom:18px}label{width:100%;position:relative;top:5px;margin-bottom:18px;line-height:18px;display:block}input[type="text"],input[type="password"],input[type="select"],input[type="search"]{width:100%;margin-bottom:-1px;display:block}input[type="radio"]{top:-1px;margin:0 4px 3px 1px}input[type="checkbox"]{top:-2px;margin:0 4px 3px 1px}input[type="file"]{margin:0px 6px 3px 6px}input[type="submit"],input[type="reset"],input[type="button"]{position:relative;top:5px;margin-bottom:18px}select{display:block;margin:0px}textarea{width:99%;line-height:18px;margin-bottom:-2px;display:block;clear:left;overflow:auto}
/* grid */
#page{width:990px;position:relative}
#page:after{content:".";display:block;height:0;clear:both;visibility:hidden; }
	.column{margin-left:18px;display:block;float:left}
	.colgroup{display:block;float:left}
	.first{margin-left:0;clear:left}
	.gutter{margin-left:18px}
	.no-gutter{margin-left:0}
	.align-left{float:left}
	.align-right{float:right;text-align:right}
	.clear{float:left}
	header,section{padding-bottom:18px}
	.leading{margin-bottom:18px}
	.noleading{margin-bottom:0 !important}
	.width1{width:234px}
	.width2{width:486px}
	.width3{width:738px}
	.width4{width:990px;margin-left:0 !important}
	.full{display:block;float:left;width:100%;margin-left:0 !important}
	.unitx1{width:108px}
	.unitx2{width:234px}
	.unitx3{width:360px}
	.unitx4{width:486px}
	.unitx5{width:612px}
	.unitx6{width:738px}
	.unitx7{width:864px}
	.unitx8{width:990px;margin-left:0 !important}
	.columnsx2{-webkit-column-count:2;-webkit-column-gap:18px;-moz-column-count:2;-moz-column-gap:18px;column-count:2;column-gap:18px}
	.columnsx4{-webkit-column-count:4;-webkit-column-gap:18px;-moz-column-count:4;-moz-column-gap:18px;column-count:4;column-gap:18px}
	th.width1,td.width1{width:234px}th.width2,td.width2{width:486px}th.width3,td.width3{width:738px}th.width4,td.width4{width:990px}
	th.unitx1,th.unitx1{width:108px}th.unitx2,td.unitx2{width:234px}th.unitx3,td.unitx3{width:360px}th.unitx4,td.unitx4{width:486px}th.unitx5,td.unitx5{width:612px}th.unitx6,td.unitx6{width:738px}th.unitx7,td.unitx7{width:864px}th.unitx8,td.unitx8{width:990px}
	label.width1,label.width2,label.width3,label.width4{margin-left:18px;float:left}
	label.unitx1,label.unitx2,label.unitx3,label.unitx4,label.unitx5,label.unitx6,label.unitx7,label.unitx8{margin-left:18px;float:left}
	label.first{margin-left:0}label.width4,label.unitx8{width:990px;overflow:hidden}
	label.width1 input[type="text"],label.width1 input[type="password"],label.width1 input[type="select"],label.width1 input[type="search"]{width:228px}label.width2 input[type="text"],label.width2 input[type="password"],label.width2 input[type="select"],label.width2 input[type="search"]{width:480px}label.width3 input[type="text"],label.width3 input[type="password"],label.width3 input[type="select"],label.width3 input[type="search"]{width:732px}
	label.width4 input[type="text"],label.width4 input[type="password"],label.width4 input[type="select"],label.width4 input[type="search"]{width:984px}label.width1 select{width:234px}label.width2 select{width:486px}label.width3 select{width:738px}label.width4 select{width:990px}label.unitx1 input[type="text"],label.unitx1 input[type="password"],label.unitx1 input[type="select"],label.unitx1 input[type="search"]{width:102px}label.unitx2 input[type="text"],label.unitx2 input[type="password"],label.unitx2 input[type="select"],label.unitx2 input[type="search"]{width:228px}label.unitx3 input[type="text"],label.unitx3 input[type="password"],label.unitx3 input[type="select"],label.unitx3 input[type="search"]{width:354px}label.unitx4 input[type="text"],label.unitx4 input[type="password"],label.unitx4 input[type="select"],label.unitx4 input[type="search"]{width:480px}label.unitx5 input[type="text"],label.unitx5 input[type="password"],label.unitx5 input[type="select"],label.unitx5 input[type="search"]{width:606px}label.unitx6 input[type="text"],label.unitx6 input[type="password"],label.unitx6 input[type="select"],label.unitx6 input[type="search"]{width:732px}label.unitx7 input[type="text"],label.unitx7 input[type="password"],label.unitx7 input[type="select"],label.unitx7 input[type="search"]{width:858px}label.unitx8 input[type="text"],label.unitx8 input[type="password"],label.unitx8 input[type="select"],label.unitx8 input[type="search"]{width:984px}
	label.unitx1 select{width:108px}label.unitx2 select{width:234px}label.unitx3 select{width:360px}label.unitx4 select{width:486px}label.unitx5 select{width:612px}label.unitx6 select{width:738px}label.unitx7 select{width:864px}label.unitx8 select{width:990px}


#textile-quickref{
}
#textile-quickref h4 { width: 200px; }
#text {
	padding:10px;
}
code {
	white-space: pre;
	display: block;
	background-color: #eee;
	border: 1px solid #ccc;
}
cite {
	border: 1px solid #ccc;
	border-left-width: 5px;
	padding: 7px;
}
textarea{
	padding: 7px;
	width: 974px;
	border: 1px solid #ccc;
}
</style>

</head>
<body>


<div id="page" class="column width3  gutter">
	<?php

	echo "<h1 class=\"align-left\"> $page</h1>";
	echo "<ul class=\"align-right width1\">";
	echo "  <li><a href=\"?page=$page&action=edit\" >edit</a></li>";
	echo "  <li><a href=\"?page=$page&action=show\" >show</a></li>";
	echo '</ul><hr />';

	if( $action == 'edit' ){
		echo
		'<form method="post" action="?action=save&page='.$page.'">
		<textarea name="text" cols="80" rows="24" style="height:1400px">'.$file_content.'</textarea>
		<input type="submit" />
		</form><br/> ';
	} else {
		echo '<div id="text" class="column width3 no-gutter">'.
		 parse_textile($file_content) .
		 '</div>';
	}




	?>
</div>

<div id="textile-quickref" class="column width1   gutter">

	<div class="leading">
		<h4>available pages:</h4>
		<?php
		echo '<ul >';
		foreach($all_pages as $page_name){
			$page_name = str_replace('pages/','',$page_name);
			echo "<li>";
			echo " <a href=\"?page=$page_name&action=show\">wiew</a>";
			echo " <a href=\"?page=$page_name&action=edit\">edit</a>";
			echo " <a href=\"?page=$page_name&action=delete\">delete</a> ";
			echo $page_name;
			echo "</li>";
		}
		echo '</ul>';
		?>
		<a href="javascript:go_to_new()">crea nuova</a>
	</div>
	<?php
	if( $action == 'edit' ){
	?>
	<h4>Phrase modifiers:</h4>
	<p>
	<em>_emphasis_</em><br>
	<strong>*strong*</strong><br>
	<i>__italic__</i><br>
	<b>**bold**</b><br>
	<cite>??citation??</cite><br>
	-<del>deleted text</del>-<br>
	+<ins>inserted text</ins>+<br>
	^<sup>superscript</sup>^<br>
	~<sub>subscript</sub>~<br>
	<span>%span%</span><br>
	<code>@code@</code><br>
	</p>

	<h4>Block modifiers:</h4>
	<p>
	<b>h<i>n</i>.</b> heading<br>
	<b>bq.</b> Blockquote<br>
	<b>fn<i>n</i>.</b> Footnote<br>
	<b>p.</b> Paragraph<br>
	<b>bc.</b> Block code<br>
	<b>pre.</b> Pre-formatted<br>
	<b>#</b> Numeric list<br>
	<b>*</b> Bulleted list<br>
	</p>

	<h4>Links:</h4>
	<p>
	"linktext":http://…<br>
	</p>

	<h4>Punctuation:</h4>
	<p>
	<b>"quotes"</b> → “quotes”<br>
	<b>'quotes'</b> → ‘quotes’<br>
	<b>it's</b> → it’s<br>
	<b>em -- dash</b> → em — dash<br>
	<b>en - dash</b> → en – dash<br>
	<b>2 x 4</b> → 2 × 4<br>
	<b>foo(tm)</b> → foo™<br>
	<b>foo(r)</b> → foo®<br>
	<b>foo(c)</b> → foo©<br>
	</p>

	<h4>Attributes:</h4>
	<p>
	(class)<br>
	(#id)<br>
	{style}<br>
	[language]<br>
	</p>

	<h4>Alignment:</h4>
	<p>
	&gt; right<br>
	&lt; left<br>
	= center<br>
	&lt;&gt; justify<br>
	</p>

	<h4>Tables:</h4>
	<p>
	|_. a|_. table|_. header|<br>
	|a|table|row|<br>
	|a|table|row|<br>
	</p>

	<h4>Images:</h4>
	<p>
	!imageurl!<br>
	!imageurl!:http://…<br>
	</p>

	<h4>Acronyms:</h4>
	<p>
	ABC(Always Be Closing)<br>
	</p>

	<h4>Footnotes:</h4>
	<p>
	See foo[<i>1</i>].<br>
	<br>
	fn1. Foo.<br>
	</p>

	<h4>Raw HTML:</h4>
	<p>
	==no &lt;b&gt;textile&lt;/b&gt;==<br>
	<br>
	notextile. no &lt;b&gt;textile<br>
	here&lt;/b&gt;<br>
	</p>

	<h4>Extended blocks:</h4>
	<p>
	bq.. quote<br>
	&nbsp;<br>
	continued quote<br>
	&nbsp;<br>
	p. paragraph<br>
	</p>
	<?php
	}
	?>
</div>

<script language="JavaScript" type="text/JavaScript">
function go_to_new(){
	var page_name = prompt('whats your new page name?', '');
	page_name = page_name.toLowerCase().replace(/ /g,"_");
	if( page_name ) {
		window.location = '?page='+page_name+'&action=edit';
	}
}

</script>

</body></html>
