<?php

/*

  to_brainfuck() function v1.0.0
  by Tnifey

  object to_brainfuck(string $string[, bool $print = true]);

*/

function to_brainfuck($string, $print = true)
{
	$letters = str_split($string);
	$brainfuck = '';					

	foreach($letters as $id => $letter)
	{
		$ord = ord($letter);
		$round = round($ord, -1, PHP_ROUND_HALF_DOWN);
		$difference = $ord - $round;
		$multiply = $round / 10;
		$position = $id + 1;
		$go_to_temp = ""; 
		$go_to_position = "";

		for($i = $position; $i > 0; $i--)
		{
			$go_to_temp .= "<";
			$go_to_position .= ">";
		}

		$repeat = str_repeat("+", $multiply);
		if($difference > 0)
			$rest = str_repeat("+", $difference);
		elseif($difference < 0)
			$rest = str_repeat("-", -$difference);
		else
			$rest = null;

		$times = str_repeat("+", 10);
		$brainfuck .= "{$repeat}[{$go_to_position}{$times}{$go_to_temp}-]{$go_to_position}{$rest}";

		if($print)
			$brainfuck .= ".";
		
		if($position !== count($letters))
			$brainfuck .= "{$go_to_temp}";
	}
	$return = (object) array(
		"string"	=> $string,
		"source"	=> $brainfuck
	);
	return $return;
}
