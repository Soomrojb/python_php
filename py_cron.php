<?php

	/*
	
		Script responsible for syncing 3rd-party websites using Python crawlers.
		
		@developer:		Janib Soomro
		@contact:		soomrojb@gmail.com | skype: soomrojb
		@date:			10th Feb. 2017
		
	*/

	//	Greeting message
	$PyExec		=	'python2.7';
	$CrawlSrc	=	'scrapers/index.py';
	
	//	Target website pool
	$CmdQueue	=	array(
						"olx.pk" => array(	" --site olxpk --depth 2 --url https://www.olx.com.pk/karachi/computers-accessories/",
											" --site olxpk --depth 0 --url https://www.olx.com.pk/karachi/games-entertainment/")
					);
	
	//	Build command(s) for Python
	foreach($CmdQueue as $Key => $Value) {
		foreach($Value as $FinalVal) {
			$NewCmd		=	$PyExec . " " . $CrawlSrc . " " . $FinalVal;
			echo	'<br/>' . $NewCmd . '<br/>';
			$JSonData	=	shell_exec($NewCmd);
			if ($JSonData) {
				echo	'<br/>';
				echo	$JSonData;
				echo	'<br/>';
			}
		}
	}
	
?>