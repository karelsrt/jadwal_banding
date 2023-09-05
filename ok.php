<!DOCTYPE html>
<html>
<head>
    <title>Data Pengadilan</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
            $json_data = '{
                "data": {
                    "judul": "\n                    JADWAL SIDANG PENGADILAN TINGGI SULAWESI TENGAH                ",
                    "hari": "\n                    Hari Selasa, 05 Sep. 2023                ",
                    "detail": "\n\n                                     \n                        \n                            107/PID.SUS/2023/PT PAL\n                            \n                                \n                                    PERKARA :\n                                    PIDANA BIASA\n                                    KLASIFIKASI : Informasi dan Transaksi Elektronik\n                                    \n                                    PENGADILAN ASAL : PENGADILAN NEGERI TOLI-TOLINO: 10/Pid.Sus/2023/PN Tli\n                                    PEMOHON : Penuntut Umum:MOHAMAD ANGGA REFANI, S.H.\n                                    AGENDA :3>\n                                    SIDANG PERTAMA Musyawarah Majelis.\n                                    RUANGAN :\n                                    Ruang Sidang I\n                                \n                            \n                        \n                    \n                            "
                },
                "status": 200,
                "success": "true"
            }';

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
