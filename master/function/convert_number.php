<?php
function lusin($str) {
	if ($str > 0) {
		$str = $str / 12;
		$result = floor($str);
	} else {
		$result = 0;
	}
	return $result;
}

function pcs($str) {
	if ($str > 0) {
		$result = $str % 12;
	} else {
		$result = 0;
	}
	return $result;
}
?>