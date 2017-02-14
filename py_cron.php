<?php

	/*
	
		Script responsible for syncing 3rd-party websites using Python crawlers.
		
		@developer:		Janib Soomro
		@contact:		soomrojb@gmail.com | skype: soomrojb
		@date:			10th Feb. 2017
		@updated:		14th Feb. 2017
		
	*/

	//	Greeting message
	$PyExec		=	'python2.7';
	$CrawlSrc	=	'scrapers/index.py';
	
	//	Target website pool
	$CmdQueue	=	array(
					"olx.pk" => array(	" --site olxpk --depth 10 --url https://www.olx.com.pk/karachi/computers-accessories/"
										//" --site olxpk --depth 0 --url https://www.olx.com.pk/karachi/games-entertainment/"
					));
	
	//	Build command(s) for Python
	foreach($CmdQueue as $Key => $Value) {
		foreach($Value as $FinalVal) {
			$NewCmd		=	$PyExec . " " . $CrawlSrc . " " . $FinalVal;
			//echo	'<br/>' . $NewCmd . '<br/>';
			$JSonData	=	shell_exec($NewCmd);
			if ($JSonData) {
				//	print raw response
				//echo	$JSonData;
				
				//	decode JSON and print
				$jContent	=	json_decode($JSonData, true);
				echo	'<meta charset="utf-8">';
				echo	'<meta name="viewport" content="width=device-width, initial-scale=1">';
				echo	'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
				echo	'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
				echo	'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
				echo	"<div class='container'>";
				echo	"<table class='table table-hover'>";
				echo	"<thead>";
				echo	"	<tr>";
				echo	"		<td>Picture</td>";
				echo	"		<td>Title</td>";
				echo	"		<td>Price</td>";
				echo	"		<td>Category</td>";
				echo	"		<td>Location</td>";
				echo	"	</tr>";
				echo	"</thead>";
				echo	"<tbody>";
				foreach ($jContent as $key => $value) {
					$category	=	$value['Category'];
					$price		=	$value['Price'];
					$thumbnail	=	$value['Thumb'];
					$location	=	$value['Location'];
					$title		=	$value['Title'];
					
					echo	"<tr>";
					echo	"	<td><img src='$thumbnail' class='img-thumbnail' width='100' height='100'></td>";
					echo	"	<td>$title</td>";
					echo	"	<td>$price</td>";
					echo	"	<td>$category</td>";
					echo	"	<td>$location</td>";
					echo	"<tr>";
				}
				echo	"</tbody></table>";
				echo	"</div>";
			}
		}
	}
	
?>