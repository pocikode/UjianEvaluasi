<?php
// Fungsi untuk menyortir array dimension berdasarkan value dari key tertentu
function buildSorter($key)
{
	return function ($a, $b) use ($key)
	{
		return strnatcmp($a[$key], $b[$key]);
	};
}

// Comparsion function
function cmp($a, $b)
{
	if ($a == $b) {
		return 0;
	}

	return ($a < $b) ? -1 : 1;
}