<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
ob_end_clean(); // Penting untuk menghapus output buffer

include 'koneksi.php';

session_start();
$last_seen_id = $_SESSION['last_activity_id'] ?? 0;

while (true) {
    // Periksa apakah ada aktivitas baru dengan ID lebih besar dari yang terakhir dilihat
    $ambil_baru = $koneksi->query("SELECT COUNT(*) AS new_count FROM SBO_CMNP_KK.ACTIVITY WHERE ID_ACTIVITY > $last_seen_id");
    $data_baru = $ambil_baru->fetch(PDO::FETCH_ASSOC);
    $new_count = $data_baru['new_count'];

    // Jika ada data baru
    if ($new_count > 0) {
        $ambil_terakhir = $koneksi->query("SELECT MAX(ID_ACTIVITY) AS last_id FROM SBO_CMNP_KK.ACTIVITY");
        $data_terakhir = $ambil_terakhir->fetch(PDO::FETCH_ASSOC);
        $current_last_id = $data_terakhir['last_id'] ?? $last_seen_id;
        $_SESSION['last_activity_id'] = $current_last_id;

        $event_data = json_encode(['new_count' => $new_count]);
        echo "event: new_activity\n";
        echo "data: " . $event_data . "\n\n";
        ob_flush();
        flush();
    }

    // Tunggu beberapa detik sebelum memeriksa lagi (misalnya 5 detik)
    sleep(5);
}
?>