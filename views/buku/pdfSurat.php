<?php
?>

<style type="text/css">
     table {
                    overflow: wrap;
                    font-size: 8pt;
                }

                tr, td {
                    padding: 0px;
                }

                div {
                    overflow: wrap;
                }

         

                .clear {
                    clear: both;
                }

                .kode {
                    border: 1px solid black;
                    float: right;
                    font-size: 15px;
                    font-weight: bold;
                    padding: 0px 10px;
                    height: 35px;
                    line-height: 35px;
                    text-align: center;
                    width: 17%;
                }

                .header {
                    font-size: 8pt;
                    overflow: hidden;
                }

                .header .left {
                    width: 60%;
                    float: left;
                }

                .header .right {
                    width: 40%;
                    float: left;
                }

                .header table {
                    border-spacing: 0px;
                    border-collapse: collapse;
                }

                .header table .caption {
                    width: 45%;
                }

                .header table .point {
                    width: 2%;
                }

                .header table .kotak {
                    width: 5%;
                }

                .kode span {
                    display: inline-block;
                    vertical-align: middle;
                    line-height: normal;
                }

                .debug, .debug tr, .debug td {
                    border: 1px solid black;
                }

                .kotak, .form {
                    border-spacing: 0px;
                    border-collapse: collapse;
                }

                .kotak {
                    border: 1px solid black;
                    height: 15px;
                    width: 2.87%;
                    text-align: center;
                }
                .kotakbaru{
                    border: 1px solid black;
                    height: 1px;
                    width: 1px;
                }

                .colspan {
                    padding-left: 2px;
                    text-align: left;
                }

                .kanan {
                    width: 1%;
                }

                .t-center {
                    text-align: center;
                }

                h4 {
                    font-weight: bold;
                    font-family: Arial;
                    font-size: 12pt;
                }

                .form .caption {
                    width: 26.8%;
                }

                .form .point, .section .point {
                    width: 1%;
                }

                .section {
                    border: 2px solid black;
                    padding: 0px;
                    margin: -1px !important;
                }

                .section h5 {
                    margin: 0px;
                    font-weight: bold;
                    text-align: left;
                    font-size: 11px;
                }

                .section table {
                    border-spacing: 0px;
                    border-collapse: collapse;
                }

                .section .nomor {
                    width: 3%;
                }

                .section .caption {
                    width: 24%;
                }

                .section .isi {
                    float: left;
                    overflow: hidden;
                    display: inline-block;
                }

                .border {
                    border: 1px solid black;
                }

                .ttd-left {
                    width: 30%;
                    text-align: center;
                }

                .ttd-middle {
                    width: 40%;
                    text-align: center;
                }

                .ttd-right {
                    width: 30%;
                    text-align: center;
                }
</style>

<div class="kode">
    <span>Kode . F-1.15</span>
</div>

<div class="clear">&nbsp;</div>

<div class="t-center">
    <h5>FORMULIR PERMOHONAN KARTU KELUARGA (KK) BARU WARGA NEGARA INDONESIA</h5>
</div>

<!--===============================
=            KONTEN            =
================================-->


<div class="konten">
    <div class="section">
         <div class="left">
        <table width="100%" autosize="1">
            <tr>
                <td width="8%">Perhatian :</td>
            </tr>
            <tr>
                <td>1. Harap diisi dengan huruf cetak dan menggunakan tinta hitam</td>
            </tr>
            <tr>
                <td>2. Setelah formulir ini diisi dan ditandatangani, harap diserahkan kembali ke Kantor Desa/Kelurahan</td>
            </tr>
            </table>
    </div>
</div>
 <div class="section">
    <div class="left" style="padding: 3px">
   <table width="100%" autosize="1" >
     <tr>
       <td>PEMERINTAH PROPINSI</td>  
        <td>:
            <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" style="margin: 4px">
                        &nbsp;
                    </td>
                <?php } ?>
            <td></td>
            <td class="border colspan" colspan="20">
                &nbsp;</td>
            <td class="kanan"></td>
        </td>
    </tr>
    <tr>
       <td>PEMERINTAH KABUPATEN/KOTA</td>  
           <td>
           :
            <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" style="margin: 4px">
                        &nbsp;
                <?php } ?>
                <td></td>
            <td class="border colspan" colspan="20">
                &nbsp;</td>
            <td class="kanan"></td>
    </tr>

  <tr>
       <td>KECAMATA</td>  
           <td>
           :
            <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" style="margin: 4px">
                        &nbsp;
                <?php } ?>
                <td></td>
            <td class="border colspan" colspan="20">
                &nbsp;</td>
            <td class="kanan"></td>
    </tr>
   <tr>
       <td>KELURAHAN/DESA</td>  
           <td>
           :
            <?php
                for ($i = 0; $i < 4; $i++) { ?>
                    <td class="kotak" style="margin: 4px">
                        &nbsp;
                <?php } ?>
                <td></td>
            <td class="border colspan" colspan="18">
                &nbsp;
            </td>
            <td class="kanan">
            </td>
            </td>
            </td>
        </tr>
   </table>
</div>
</div>
<div class="section">
   <table width="100%" autosize="1">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>1.</td>
       <td>Nama Lengkap Pemohon</td>  
           <td>
           :
            <?php
                for ($i = 0; $i < 28; $i++) { ?>
                    <td class="kotak">
                        &nbsp;
                <?php } ?>
                <td></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>NIK Pemohon</td>  
           <td>
           :
            <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak">
                        &nbsp;
                <?php } ?>
                <td></td>
    </tr>
     <tr>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td>3.</td>
            <td>No. KK Semula</td>
            <td>:</td>
                <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak"></td>
                <?php } ?>
                    
                <td class="kanan"></td>
                <td colspan="11">*) Diisi oleh petugas</td>
    </tr>
     <tr>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td>4.</td>
        <td>Alamat Pemohon</td>
        <td>:</td>
        <td class="border colspan" colspan="16">&nbsp;</td>
        <td colspan="2" class="t-center">RT</td>
        <td>:</td>
                <?php
                for ($i = 0; $i < 3; $i++) { ?>
                    <td class="kotak">&nbsp;</td>
                <?php } ?>
        <td colspan="2" class="t-center">RW</td>
        <td>:</td>
                <?php
                for ($i = 0; $i < 3; $i++) { ?>
                    <td class="kotak">&nbsp;</td>
                <?php } ?>
            <td class="kanan"></td>
            </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td colspan="3"></td>
        <td>a.</td>
        <td colspan="5">Desa/Keluarga</td>
        <td class="border colspan" colspan="7">&nbsp;</td>
        <td></td>
         <td>b.</td>
         <td colspan="5">Kecamatan</td>
        <td class="border colspan" colspan="7">&nbsp;</td>
      </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
      <tr>
        <td colspan="3"></td>
        <td>c.</td>
        <td colspan="5">Kabupaten/Kota</td>
        <td class="border colspan" colspan="7">&nbsp;</td>
        <td></td>
        <td>d.</td>
        <td colspan="5">Propinsi</td>
        <td class="border colspan" colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
     <tr>
        <td colspan="3"></td>
        <td colspan="5">Kode Pos</td>
                    <?php
                for ($i = 0; $i < 5; $i++) { ?>
                    <td class="kotak"></td>
                <?php } ?>
                     <td class="kanan"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="5">Telepon</td>
                     <?php
                for ($i = 0; $i < 7; $i++) { ?>
                    <td class="kotak"></td>
                <?php } ?>
                    
                    <td class="kanan"></td>
      </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
  <tr>
        <td>5.</td>
        <td>Alasan Permohonan</td>
         <td>
            <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak">
                        &nbsp;
                <?php } ?>
                <td></td>
        <td>1.</td>
        <td colspan="13">Karena Membentuk Rumah Tangga Baru</td>
        <td colspan="2">3.</td>
        <td colspan="7">Lainnya</td>
         
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>Jumlah Anggota Keluarga</td>
        <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak">
                        &nbsp;
                <?php } ?>
                <td></td>
                <td colspan="3">Orang</td>
        </td>
    </tr>
</table>
</div>
</div>

<div class="section">
   <table width="100%" autosize="1">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>7.</td>
       <td colspan="33"><h4>DAFTAR ANGGOTA KELUARGA PEMOHON (hanya diisi anggota keluarga saja)</h4></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <!-- ========HEADER======== -->
    <tr>
      <td>
            <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="2"><h3>No.</h3>
                        &nbsp;
                <?php } ?>
                <td></td>
         <td>
            <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="16"><h3>NIK</h3>
                        &nbsp;
                <?php } ?>
                <td></td>
        </td>
        <td>
            <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="14"><h3>Nama Lengkap</h3>
                        &nbsp;
                <?php } ?>
                <td></td>
        </td>
        <td colspan="1">
            <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="7"><h3>SHDK**)</h3>
                        &nbsp;
                <?php } ?>
                <td></td>
         <td>
    </tr>
    <!-- =============END HEADER============= -->
    <tr>
        <td>&nbsp;</td>
    </tr>
    <!-- ~~~~~~~~~~~~~KOTAK 1~~~~~~~~~~~~~ -->
    <tr>
         <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
                <td></td>
        </td> 
        <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
        </td>
        <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
        </td>

         <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
    </tr>
       <!-- ~~~~~~~~~~~~~ END KOTAK 1~~~~~~~~~~~~~ -->
    <tr>
        <td>&nbsp;</td>
    </tr>
       <!-- ~~~~~~~~~~~~~KOTAK 2~~~~~~~~~~~~~ -->
    <tr>
        <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
        </td>
         <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
                
        </td>
          <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
                
        </td>
         <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
    </tr>
       <!-- ~~~~~~~~~~~~~END KOTAK 2~~~~~~~~~~~~~ -->
       <tr>
         <td>&nbsp;</td>
       </tr>
       <!-- ~~~~~~~~~~~~~KOTAK 3~~~~~~~~~~~~~ -->
       <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
        <!-- ~~~~~~~~~~~~~END KOTAK 3~~~~~~~~~~~~~ -->
       <tr>
         <td>&nbsp;</td>
       </tr>
        <!-- ~~~~~~~~~~~~~KOTAK 4~~~~~~~~~~~~~~~~ -->
         <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
          <!-- ~~~~~~~~~~~~~END KOTAK 4~~~~~~~~~~~~~~~~ -->
    <tr>
        <td>&nbsp;</td>
    </tr>
     <!-- ~~~~~~~~~~~~~KOTAK 5~~~~~~~~~~~~~~~~ -->
      <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
         <!-- ~~~~~~~~~~~~~END KOTAK 5~~~~~~~~~~~~~~~~ -->
         <tr>
             <td>&nbsp;</td>
         </tr>
         <!-- ~~~~~~~~~~~~~KOTAK 6~~~~~~~~~~~~~~~~ -->
         <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
          <!-- ~~~~~~~~~~~~~END KOTAK 6~~~~~~~~~~~~~~~~ -->
          <tr>
              <td>&nbsp;</td>
          </tr>
          <!-- ~~~~~~~~~~~~~KOTAK 7~~~~~~~~~~~~~~~~ -->
          <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
             <!-- ~~~~~~~~~~~~~END KOTAK 7~~~~~~~~~~~~~~~~ -->
        <tr>
            <td>&nbsp;</td>
        </tr>
          <!-- ~~~~~~~~~~~~~KOTAK 8~~~~~~~~~~~~~~~~ -->
           <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
          <!-- ~~~~~~~~~~~~~END KOTAK 8~~~~~~~~~~~~~~~~ -->
          <tr>
              <td>&nbsp;</td>
          </tr>
          <!-- ~~~~~~~~~~~~~KOTAK 9~~~~~~~~~~~~~~~~ -->
          <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
        <!-- ~~~~~~~~~~~~~END KOTAK 9~~~~~~~~~~~~~~~~ -->
        <tr>
            <td>&nbsp;</td>
        </tr>
         <!-- ~~~~~~~~~~~~~KOTAK 10~~~~~~~~~~~~~~~~ -->
         <tr>
            <td>
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
            </td>
             <td>
             <?php
                for ($i = 0; $i < 16; $i++) { ?>
                    <td class="kotak" colspan="1">
                        &nbsp;
                <?php } ?>
               
            </td>
             <td>
             <?php
                for ($i = 0; $i < 1; $i++) { ?>
                    <td class="kotak" colspan="13">
                        &nbsp;
                <?php } ?>
            </td>
            <td colspan="1">
             <?php
                for ($i = 0; $i < 2; $i++) { ?>
                    <td class="kotak" colspan="5">
                        &nbsp;
                <?php } ?>
        </td>
       </tr>
        <!-- ~~~~~~~~~~~~~END KOTAK 10~~~~~~~~~~~~~~~~ -->
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td> 
            <td class="ttd-right" colspan="10">.....................................</td>
        </tr>
    </table>
        
</div>
</div>
