#!/usr/bin/php
<?php

	function getContent($url)
	{
		$content = file_get_contents($url);

		preg_match_all('/<a href="(.+)">/', $content, $matches, PREG_SET_ORDER);
		foreach ($matches as $matchKey => $match)
		{
			if ($match[1] === 'README')
			{
				$readme = file_get_contents($url . 'README');
				if (preg_match('/\b\w*[\d]\w*\b/', $readme) === 1)
				{
					echo $url . 'README: ' . "\n";
					echo $readme;
				}
			}
			else if ($match[1] !== '../' && $match[1] !== './')
			{
				getContent($url . $match[1]);
			}
		}
	}

	$url = 'http://10.18.187.67/.hidden/';

	getContent($url);

	echo "\n";

?>