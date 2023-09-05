<?php

 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

header('Content-Type: application/json');


date_default_timezone_set('Asia/Jakarta');

// URL halaman web
$url = "https://sipp-banding.mahkamahagung.go.id/slide_sidang_publik/M2FoVEk5Vi95Tjc4Z1AwYnhDRjlpaDc1bG1BQlRHLzNsQ2tJNzBJanFFczNaU3pQdXRpbVNmUmlEYXhxRHJGWXAwUVlaZ0tzRS9mUnlPY2I4Y2hGRnc9PQ==";

// Inisialisasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL untuk mengambil konten halaman web
$response = curl_exec($ch);

// Tutup koneksi cURL
curl_close($ch);

// Membuat objek DOMDocument dan mengurai HTML
$dom = new DOMDocument();
@$dom->loadHTML($response);

// Inisialisasi XPath
$xpath = new DOMXPath($dom);

// Gunakan XPath untuk menemukan elemen dengan XPath tertentu
$judul_element = $xpath->query('//*[@id="slide_sidang_publik"]/div[2]/div[2]/div/div/div/h2');
$hari_element = $xpath->query('//*[@id="slide_sidang_publik"]/div[2]/div[2]/div/div/div/h3');
$no_perkara_pidana_element = $xpath->query('//*[@id="slide_sidang_publik"]/div[2]/div[2]/div/div/div/div');

// Inisialisasi array untuk menyimpan data
$data = [];

// Periksa apakah elemen judul ditemukan
if ($judul_element->length > 0) {
    // Ambil teks dari elemen judul
    $judul_text = $judul_element[0]->textContent;

    // Masukkan teks judul ke dalam array
    $data['judul'] = $judul_text;
} else {
    $data['judul'] = 'Elemen judul tidak ditemukan.';
}

// Periksa apakah elemen hari ditemukan
if ($hari_element->length > 0) {
    // Ambil teks dari elemen hari
    $hari_text = $hari_element[0]->textContent;

    // Masukkan teks hari ke dalam array
    $data['hari'] = $hari_text;
} else {
    $data['hari'] = 'Elemen hari tidak ditemukan.';
}
// Periksa apakah elemen no_perkara ditemukan
if ($no_perkara_pidana_element->length > 0) {
    // Ambil teks dari elemen hari
    $no_perkara_pidana_text = $no_perkara_pidana_element[0]->textContent;

    // Masukkan teks hari ke dalam array
    $data['detail'] = $no_perkara_pidana_text;
} else {
    $data['detail'] = 'Elemen no_perkara tidak ditemukan.';
}


// Konversi data ke format JSON
/*
$jsonData = json_encode(array(
                  "data"=>$data,
                "status"=>200,
                   "success"=>"true",
            ));
			*/
			$jsonData = json_encode([
    "data" => $data,
    "status" => 200,
    "success" => "true",
]);
 
// Tampilkan data JSON
echo $jsonData;
?>
