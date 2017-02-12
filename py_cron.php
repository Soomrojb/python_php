<?php

	/*
	
		Script responsible for syncing 3rd-party websites using Python crawlers.
		
		@developer:		Janib Soomro
		@contact:		soomrojb@gmail.com | skype: soomrojb
		@date:			10th Feb. 2017
		
	*/

	//	Greeting message
	echo	'Initiating CRON!<br/>';
	
	$PyExec		=	'python';
	$CrawlSrc	=	'scrapers/index.py';
	
	//	Target website pool
	$CmdQueue	=	array(
						"olx.pk" => array(	" --site olx.pk --category computers.accessories --url https://www.olx.com.pk/karachi/computers-accessories/",
											" --site olx.pk --category games.entertainment --url https://www.olx.com.pk/karachi/games-entertainment/"),
						"test.1" => array(	" --site test.1 --category cat.unidentified --url url.unidentified")
					);
	
	//	Build command(s) for Python
	foreach($CmdQueue as $Key => $Value) {
		foreach($Value as $FinalVal) {
			$NewCmd		=	$PyExec . " " . $CrawlSrc . " " . $FinalVal;
			echo	$NewCmd . '<br/>';
			$JSonData	=	shell_exec($NewCmd);
			if ($JSonData) {
				echo	'<br/>';
				echo	$JSonData;
				echo	'<br/>';
			}
		}
	}
	
?>