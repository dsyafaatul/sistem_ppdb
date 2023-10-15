<?php
//created by dsyafaatul
include('../koneksi.php');
$sekarang = date('d/m/Y');
ob_start();
?>
<style>
 table{
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
 }
 table th{
  padding: 5px;
  font-size: 7pt;
 }
 table td{
  padding: 5px;
  font-size: 7pt;
 }
</style>
<page> 
    <page_header> 
    </page_header> 
    <page_footer> 
         <!-- <table>
            <tr>
                <td style="text-align: right; width: 100%;">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table> -->
    </page_footer> 
     <table border="0" style="position: relative;">
       	<img src="../img/LOGO.png" alt="" style="position: absolute;left: 0px;top: 5px;width: 70px;height: 70px;">
        <tr>
            <td align="center" style="width: 100%;padding: 5px;font-size: 20pt;font-weight: bold;">
        		SMK PUI Majalengka
            </td>
        </tr>
        <tr>
        	<td align="center" style="padding: 5px;font-size: 11pt;">
            Jalan Suma No.478 Majalengka 45419 Telp. /Fax (0233) 281027
        	</td>
        </tr>
        <tr>
        	<td align="center" style="padding: 5px;font-size: 11pt;border-bottom: 1px solid black;">
            www.smkpui-majalengka.sch.id email: smkpuimjlk@yahoo.com
        	</td>
        </tr>
        <tr>
        	<td align="center" style="padding-top: 15px;font-size: 14pt;font-weight: bold;">LAPORAN PPDB</td>
        </tr>
        <tr>
        	<td align="center" style="font-size: 11pt;">TANGGAL 
        		<?php
        			echo strtoupper($sekarang);
        		?>
        	</td>
        </tr>
    </table>
    <table border="1" style="width: 100%;margin-top: 10px;" align="center">
<thead>
  <tr>
    <th style="width: 2px;text-align: center;">No</th>
    <th style="width: 100px;">Nama</th>
    <th style="width: 30px;">Jenis Kelamin</th>
    <th>Alamat</th>
    <th style="width: 50px;">TTL</th>
    <th style="width: 80px;">Asal Sekolah</th>
    <th style="width: 30px;">Pilih Jurusan</th>
    <th>No Telepon</th>
    <th style="width: 30px;">Tahun Pelajaran</th>
  </tr>
</thead>
<tbody>
  <?php
  $no = 1;
  $data_siswa_query = $koneksi->query("SELECT * FROM siswa,jurusan WHERE siswa.pilih_jurusan=jurusan.id_jurusan ORDER BY id_siswa");
  $nama_jurusan = "";
    while($data_siswa = $data_siswa_query->fetch_object()){
    $jenis_kelamin = ($data_siswa->jenis_kelamin=="L"?"Laki-Laki":"Perempuan");
    $pisah = explode(" ",$data_siswa->jurusan);
          foreach($pisah as $value){
            $substr = substr($value,0,1);
            $nama_jurusan .= $substr;
          }
      ?>
      <tr>
        <td style="width: 2px;text-align: center;"><?= $no ?></td>
        <td valign="top"><?= $data_siswa->nama ?></td>
        <td valign="top"><?= $jenis_kelamin ?></td>
        <td valign="top" style="width: 100px;"><?= $data_siswa->alamat ?></td>
        <td valign="top"><?= $data_siswa->ttl ?></td>
        <td valign="top"><?= $data_siswa->asal_sekolah ?></td>
        <td valign="top"><?= $nama_jurusan ?></td>
        <td valign="top"><?= $data_siswa->no_telp ?></td>
        <td valign="top"><?= $data_siswa->tahun_ajaran ?></td>
      </tr>
      <?php
      $no++;
      $nama_jurusan = "";
    }
    ?>
</tbody>
</table>
<br>
<br>
<br>
<table border="0" style="margin-top: 10px;" align="right">
  <tr>
    <td align="right" style="padding-right: 80px;font-size: 8pt;">Majalengka, <?= date("d-m-Y") ?></td>
  </tr>
  <tr>
    <td><br><br><br><br></td>
  </tr>
  <tr>
    <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; border-bottom: 1px solid black; text-align: center; width: 150px;font-size: 8pt;"><hr style="border: 1px solid black;"></td>
  </tr>
  <tr>
    <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; text-align: left; width: 150px;" value="NIP. "></td>
  </tr>
</table>
</page> 
<?php
$content = ob_get_clean();
$filename="LAPORAN ".strtoupper("PPDB ").date("d-m-Y").".pdf";
require_once('../plugins/html2pdf/html2pdf.class.php');
try{
	$html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 8);
	$html2pdf->setDefaultFont('Arial');
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output($filename);
}catch(HTML2PDF_exception $e){
	echo $e;
	exit;
}
?>