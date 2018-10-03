<?php
/*
 * Program Input Nilai
*/
define('NAMA', 'Agus Supriyatna');

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

		$sortNilai = array_column($lists, 'nilai');
		$sortNama  = array_column($lists, 'nama');

		// Sortir berdasarkan nama
		array_multisort($sortNama, SORT_ASC, $lists);

		// Cetak nama => nilai
		foreach ($lists as $list) {
			echo "$list[nama] => $list[nilai] \n";
		}

		echo "===> Nilai Lulus <=== \n";

		// Nilai Lulus
		array_multisort($sortNilai, SORT_DESC, $lists);
		foreach ($lists as $list) {
			if ($list['nilai'] > 5) {
				$nilaiPersen = $list['nilai'] * 10;
				echo "Nilai ujian $list[nama] telah mencukupi. Capaian $nilaiPersen%";
				echo "\n";
			}
		}

		echo "===> Nilai Tidak Lulus <=== \n";
		
		// Nilai tidak lulus
		array_multisort($sortNilai, SORT_ASC, $lists);
		foreach ($lists as $list) {
			if ($list['nilai'] <= 5) {
				$nilaiPersen = $list['nilai']*10;
				echo "Nilai ujian $list[nama] tidak mencukupi. Capaian $nilaiPersen%";
				echo "\n";
			}
		}
		echo "\n";

		$max = "Nilai TERTINGGI adalah ";
		$min = "Nilai TERENDAH adalah ";

		foreach ($lists as $list) {
			// Nilai tertinggi
			if ($list['nilai'] == max($sortNilai)) {
				$max .= $list['nama'] ." dengan nilai ". $list['nilai'] ."\n";
			}
			// NIlai terendah
			if ($list['nilai'] == min($sortNilai)) {
				$min .= $list['nama'] ." dengan nilai ". $list['nilai'] ."\n";
			}
		}

		echo($max);
		echo($min);
		echo("\n");

		echo "Program ini dibuat dengan bahasa pemrograman PHP ".phpversion()." oleh ".NAMA;
		echo "\n";
		echo "\n";
		break;
	}
}