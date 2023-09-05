<!DOCTYPE html>
<html>

<head>
    <title>Data Pengadilan</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <table id="pengadilanTable" class="display">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Hari</th>
                <th>Perkara</th>
                <th>Pengadilan Asal</th>
                <th>Pemohon</th>
                <th>Agenda</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mengambil data JSON dari URL
            $url = 'http://localhost/jadwal_banding/jadwal.php';
            $json_data = file_get_contents($url);
            $data = json_decode($json_data, true);

            // Extract relevant data
            $judul = trim($data['data']['judul']);
            $hari = trim($data['data']['hari']);
            $detail = $data['data']['detail'];

            // Extract more details from the 'detail' field
            preg_match('/PERKARA :(.+?)\n/s', $detail, $matches);
            $perkara = trim($matches[1]);

            preg_match('/PENGADILAN ASAL :(.+?)\n/s', $detail, $matches);
            $pengadilan_asal = trim($matches[1]);

            preg_match('/PEMOHON :(.+?)\n/s', $detail, $matches);
            $pemohon = trim($matches[1]);

            preg_match('/AGENDA :(.+?)\n/s', $detail, $matches);
            $agenda = trim($matches[1]);

            preg_match('/RUANGAN :(.+?)\n/s', $detail, $matches);
            $ruangan = trim($matches[1]);

            echo "<tr>";
            echo "<td>$judul</td>";
            echo "<td>$hari</td>";
            echo "<td>$perkara</td>";
            echo "<td>$pengadilan_asal</td>";
            echo "<td>$pemohon</td>";
            echo "<td>$agenda</td>";
            echo "<td>$ruangan</td>";
            echo "</tr>";
            ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        $('#pengadilanTable').DataTable();
    });
    </script>
</body>

</html>