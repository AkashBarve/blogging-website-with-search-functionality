<?php

require_once(realpath(dirname(__FILE__) . '/../app/init.php'));


if(!empty($_POST)) {
	
	if(isset($_POST['title'], $_POST['body'], $_POST['keywords'])) {
	
		$title = $_POST['title'];
		$body = $_POST['body'];
		$keywords = explode(',', $_POST['keywords']);

		$indexed = $es->index([
			'index' => 'articles',
			'type' => 'article',
			
			'body' => [
				'title' => $title,
				'body' => $body,
				'keywords' => $keywords
			]
		]);
		
		if($indexed) {
			print_r($indexed);
		}
	}
}

?>


<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add | ES</title>
		
		
		
<link type="text/css" rel="stylesheet" href="stylesheet.css">
<link rel="shortcut icon" href="/wt/favicon.ico" />
<style>
#back
{
position:fixed;
z-index:-999;
height:100%;
width:100%;
}

div
{
background-color:rgba(208,208,208,0.4);
box-shadow:inset 0px 0px 10px black;
border-radius:5px; 
}

#emb{
font-size:22px;
font-family:cursive;
display:inline-block;
text-align:center;
color:white;
height:35px;
padding:4px 0 0 0;
width:13%;
border-top-right-radius:10;
border-top-left-radius:10;
background:linear-gradient(#E67E22,#D35400);
}
#emb:hover{
background:linear-gradient(#D35400,#E67E22);
}
#und{
position:relative;
top:5px;
height:5px;
width:0px;
background:linear-gradient(90deg,#3498DB 60%,#2980B9);
transition:width 0.5s;
}
#emb:hover #und{
width:100%;
}
hr
{
display:block;
}
#gls{
background-color:#000000;
opacity:0.5;
height:100%;
width:100%;
}
#menub{
}




</style>
	</head>
	<body>
	
				<img src="/wt/images/hd-background-6-Computer-Backgrounds-1024x576.jpg" id="back" />
<div id="menub">
<img src="/wt/images/mod1.jpg" width="100%" height="300px">
<br>
<a href="/../wt/main.html"><div id="emb">Home
<div id="und"></div></div></a>
<a href="/../wt/literature.html"><div id="emb">Literature
<div id="und"></div></div></a>
<a href="/../wt/rus.html"><div id="emb">Arts
<div id="und"></div></div></a>
<a href="/../wt/ff.html"><div id="emb">Start Blogging
<div id="und"></div></div></a>
<a href="/../wt/gallery.html"><div id="emb">Gallery
<div id="und"></div></div></a>
<a href="/wt/css/add.php"><div id="emb">Add node
<div id="und"></div></div></a>
<a href="/wt/css/index.php"><div id="emb">Search(ES)
<div id="und"></div></div></a><br>
</div>

	<b> Add data to the index</b>
		<form action="add.php" method="post" autocomplete="off">
			<label>
				Title
				<input type="text" name="title">
			</label>
			<p>
			<label>
				Body
				<textarea name="body" rows="30" cols="40"> </textarea>
			</label>
			<p>
			<label>
				Keywords
				<input type="text" name="keywords" placeholder="comma, separated">
			</label>
			
			<input type="submit" value="Add">
		</form>
	</body>
</html>