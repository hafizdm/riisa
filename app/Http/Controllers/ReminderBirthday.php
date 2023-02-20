<?php
    require_once '/home/rape6953/RIISA/vendor/autoload.php';
        $host = "localhost";
        $uname = "rape6953_root";
        $pass = "RapidSukses!";
        $db = "rape6953_pyk_sirii";
        
        $koneksi = mysqli_connect($host, $uname, $pass);
        mysqli_select_db($koneksi,$db);
        
        $hasil = array();
        if($koneksi){
            $query = "SELECT emp.nik as NIK, emp.nama as Nama, emp.date_birth as birthday, emp.email, divisi.nama as nama_divisi, jabatan.jenis_jabatan as jabatan
                    from karyawan as emp JOIN master_divisi as divisi ON emp.divisi_id = divisi.id 
                    JOIN master_jabatan as jabatan ON emp.jabatan_id = jabatan.id 
                    WHERE MONTH(CURDATE()) = MONTH(emp.date_birth) AND 
                    DAY(CURDATE()) = DAY(emp.date_birth)
                    GROUP BY emp.NIK";

            $tampil = mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
            
            while($row = mysqli_fetch_assoc($tampil)){
               $hasil[] = $row;
            }
            
            if(mysqli_num_rows($tampil) == 0){
                echo "no reminder birthday";
            }
            else{
                $transport = (new Swift_SmtpTransport('mail.rapidinfrastruktur.com', 465,'ssl'))
                ->setUsername('request.information@rapidinfrastruktur.com')
                ->setPassword('RapidSukses!');
            
            $mailer = new Swift_Mailer($transport);

            $message = new Swift_Message();
            $message->setSubject('Reminder: Hari Ulang Tahun Karyawan');
            $message->setFrom(['request.information@rapidinfrastruktur.com' => 'RIISA Administration Team']); 
            $message->addTo('hrd@rapidinfrastruktur.com','HCM');
            
            $bodyText = "";
            $i = 1;
            foreach($hasil as $dt){
                $bodyText .= "<tr>
                            <td style='border: 1px solid black;'>".$i."</td>
                            <td style='border: 1px solid black;'>".$dt['NIK']."</td>
                            <td style='border: 1px solid black;'>".$dt['Nama']."</td>
                            <td style='border: 1px solid black;'>".$dt['birthday']."</td>
                            <td style='border: 1px solid black;'>".$dt['email']."</td>
                            <td style='border: 1px solid black;'>".$dt['nama_divisi']."</td>
                            <td style='border: 1px solid black;'>".$dt['jabatan']."</td>
                            </tr>";
                        
                        $i++;
            }
            $message->setBody(
                '<h4>
                <span>Dear Bapak/Ibu Human Capital Management (HCM),</span>
                <br>
                <span>PT. Rapid Infrastruktur Indonesia</span>
                </h4>
                <p>Berikut ini daftar karyawan yang berulang tahun hari ini:</p>
                <table style="border:1px solid black;border-collapse: collapse;width:100%;">
                        <thead>
                        <tr>
                            <th style="border: 1px solid black;">NO</th>
                            <th style="border: 1px solid black;">NIK</th>
                            <th style="border: 1px solid black;">Nama</th>
                            <th style="border: 1px solid black;">Birthday</th>
                            <th style="border: 1px solid black;">Email</th>
                            <th style="border: 1px solid black;">Divisi</th>
                            <th style="border: 1px solid black;">Jabatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        '.$bodyText.'
                </tbody>
                </table>
                <br><br>
                <span>Best Regards, </span>
                <br><br>
                <span>RII-SA Administration Team</span>'
                ,'text/html'
            );
            
            $result = $mailer->send($message);
            }
        }
        else{
            echo "gagal";
        }
   
?>