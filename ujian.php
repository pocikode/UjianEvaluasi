<?php
require 'function.php';

echo "==>> Selamat datang di Program Input Nilai Ujian <<== \n";

$lists = [];
while (true) {
	// Nama Peserta Ujian
	echo "Masukan Nama Peserta : ";
	$nama = ucwords(trim(fgets(STDIN)));

	// Nilai Peserta Ujian
	echo "Masukan Nilai $nama : ";
	$nilai = trim(fgets(STDIN));
	echo "Nilai $nama adalah $nilai\n";

	// Ubah nama dan nilai ke bentuk array, gabungkan ke variabel $lists
	$peserta = ['nama' => $nama, 'nilai' => $nilai];
	array_push($lists, $peserta);

	// Lanjut ?
	echo "Lanjutkan? [Y/n] : ";
	$ask = trim(fgets(STDIN));

	if ($ask=='Y' || $ask=='y') {
		// Jika Ya
		continue;
	} else {
		// Jika Tidak
		echo "Terimakasih sudah memasukkan nilai nilai peserta Ujian\n";
		echo "\n";

		// cetak dash
		for ($i=0; $i < 99; $i++) { 
			echo $i==49 ? "*" : "-";
		}
		echo "\n";

		// Sortir berdasarkan nama
		usort($lists, buildSorter('nama'));

		// Cetak nama => nilai
		foreach ($lists as $list) {
			echo "$list[nama] => $list[nilai] \n";
		}

		echo "===> Nilai Lulus <=== \n";
		// Nilai lulus
		usort($lists, buildSorter('nilai'));
		foreach ($lists as $list) {
			if ($list['nilai'] > 5) {
				$nilaiPersen = $list['nilai']*10;
				echo "Nilai ujian $list[nama] telah mencukupi. Capaian $nilaiPersen%";
				echo "\n";
			}
		}

		echo "===> Nilai Tidak Lulus <=== \n";
		// Nilai tidak lulus
		uasort($lists, buildSorter('nilai'));
		foreach ($lists as $list) {
			if ($list['nilai'] <= 5) {
				$nilaiPersen = $list['nilai']*10;
				echo "Nilai ujian $list[nama] tidak mencukupi. Capaian $nilaiPersen%";
				echo "\n";
			}
		}

		break;
	}
}