<?php

require_once(realpath(dirname(__FILE__) . '/../app/init.php'));

if(isset($_GET['q'])) {
	
	$q = $_GET['q'];
	
	$query = $es->search([
		'body' => [
			'query' => [
				'bool' => [
					'should' => [['match' => ['title' => $q]],['match' => ['body' => $q]],['match' => ['keywords' => $q]]]
				]
			]
		]
	]);

	
	if($query['hits']['total'] >=1) {
		$results = $query['hits']['hits'];
	}
}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search | ES</title>
		
<link type="text/css" rel="stylesheet" href="stylesheet.css">
<link rel="shortcut icon" href="/images/favicon.ico" />
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
	
	<div align="center">
	
		<form action="index.php" method="get" autocomplete="off">
			<label>
				<br><br><h1><b>Search for something</b></h1>
				<input type="text" name="q">
			</label>
			
			<input type="submit" value="Search">
		</form>
	</div>	
		<?php
		if(isset($results)) {
			foreach($results as $r) {
			?>
				<div class="result"><br><ol>
					<b>Title:</b><a href="#<?php echo $r['_id']; ?>"><?php echo $r['_source']['title']; ?></a>
					<br><b>Body:</b><p><?php echo substr($r['_source']['body'],0,450); ?> 
					<br><b>Associated Keywords:</b><div class="result-keywords"><?php echo implode(',', $r['_source']['keywords']); ?></div>
				</div>
			<?php
			}
		}
		?>
		
	</body>
</html> 
<!--This is a comment. Add this code on line 18 to get raw search-->
	<!--echo '<pre>', print_r($query), '</pre>';
	
	die();
	echo $r['_id']
	-->
