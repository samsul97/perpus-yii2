<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Anggota;
use app\models\Petugas;
use app\models\Buku;
use app\models\Peminjaman;
use app\models\Penerbit;
use app\models\Kategori;
use app\models\Penulis;
use miloschuman\highcharts\Highcharts;
use app\models\User;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Statistik Perpustakaan';
?>
<?= Yii::$app->getSecurity()->generatePasswordHash("Fauzan") ?>
<br>
<?php 
$session= Yii::$app->session;
$session->set('language', 'en-US');
echo $session['language'];
?>
<br>
<?php
$cookies = Yii::$app->request->cookies;
$language = $cookies->getValue('language', 'en');
echo $cookies['language'];
?>
<?php $cache['language'] = 'en';
echo $cache['language'];?>

<?php if (Yii::$app->user->identity->id_user_role == 1): ?>
  <div class="site-index">
    <small>Welcome to dashboard perpustakaan. Silahkan kelola perpustakaan dengan baik.</small>
    <br>
    <br>
    <div class="row" style="margin: 3px;">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <p>Jumlah Anggota</p>

            <h3><?= Yii::$app->formatter->asInteger(Anggota::getCount()); ?></h3>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="<?=Url::to(['anggota/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <p>Jumlah Petugas</p>

            <h3><?= Yii::$app->formatter->asInteger(Petugas::getCount()); ?></h3>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?=Url::to(['petugas/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-gray">
          <div class="inner">
            <p>Jumlah User</p>

            <h3><?= Yii::$app->formatter->asInteger(Kategori::getCount()); ?></h3>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?=Url::to(['user/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-white">
          <div class="inner">
            <p>Jumlah Penulis</p>

            <h3><?= Yii::$app->formatter->asInteger(Penulis::getCount()); ?></h3>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="<?=Url::to(['penulis/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Buku::getCount()); ?></h3>
            <p>Data Buku</p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Anggota::getCount()); ?><sup style="font-size: 20px">%</sup></h3>
            <p>Data Anggota</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Peminjaman::getCount()); ?></h3>
            <p>Data Peminjaman</p>
          </div>
          <div class="icon">
            <i class="fa fa-exchange"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Penerbit::getCount()); ?></h3>
            <p>Data Penerbit</p>
          </div>
          <div class="icon">
            <i class="fa fa-bookmark"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>



    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <h3 class="box-title">Buku Berdasarkan Kategori</h3>
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'KATEGORI BUKU'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Kategori',
                  'data' => Kategori::getGrafikList(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="box-header with-border">
          <h3 class="box-title">Buku Berdasarkan Penulis</h3>
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'PENULIS BUKU'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Penulis',
                  'data' => Penulis::getGrafikList(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
  </div>
<?php endif ?>


<?php $this->title = 'Perpustakaan'; ?>
<?php if (Yii::$app->user->identity->id_user_role == 2): ?>
  <div class="row">

    <?php foreach ($provider->getModels() as $buku) {?> 
      <!-- Kolom box mulai -->
      <div class="col-md-4">

        <!-- Box mulai -->
        <div class="box box-widget">

          <div class="box-header with-border">
            <div class="user-block">


              <span class="username"><?= Html::a($buku->nama, ['buku/view', 'id' => $buku->id]); ?></span>
              <span class="description"> Di Terbitkan : Tahun <?= $buku->tahun_terbit; ?></span>
            </div>
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read"><i class="fa fa-circle-o"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">
            <img class="img-responsive pad" style="height: 300px;" src="<?= Yii::$app->request->baseUrl.'/upload/sampul/'.$buku['sampul']; ?>" alt="Photo">
            <p>Sinopsis : <?= substr($buku->sinopsis,0,40);?> ...</p>
            <?= Html::a("<i class='fa fa-eye'> Detail Buku</i>",["buku/view","id"=>$buku->id],['class' => 'btn btn-default']) ?>
            <?= Html::a('<i class="fa fa-file"> Pinjam Buku</i>', ['peminjaman/create', 'id_buku' => $buku->id], [
              'class' => 'btn btn-primary',
              'data' => [
                'confirm' => 'Apa anda yakin ingin meminjam buku ini?',
                'method' => 'post',
              ],
            ]) ?>
            <!-- <span class="pull-right text-muted">127 Peminjam - 3 Komentar</span> -->
          </div>

        </div>
        <!-- Box selesai -->

      </div>
      <!-- Kolom box selesai -->  
      <?php
    }
    ?>

  </div>

  <div class="row">
    <center>
      <?= LinkPager::widget([
        'pagination' => $provider->pagination,
      ]); ?>
    </center>
  </div>
<?php endif ?>

<!-- Dashboard Petugas -->
<?php if (Yii::$app->user->identity->id_user_role == 3): ?>
  <?php $this->title = 'Perpustakaan'; ?>

  <div class="site-index">
    <small>Welcome to dashboard perpustakaan. Silahkan kelola perpustakaan dengan baik.</small>
    <br>
    <br>
    <div class="row" style="margin: 3px;">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Buku::getCount()); ?></h3>
            <p>Data Buku</p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Anggota::getCount()); ?><sup style="font-size: 20px">%</sup></h3>
            <p>Data Anggota</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Peminjaman::getCount()); ?></h3>
            <p>Data Peminjaman</p>
          </div>
          <div class="icon">
            <i class="fa fa-exchange"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Penerbit::getCount()); ?></h3>
            <p>Data Penerbit</p>
          </div>
          <div class="icon">
            <i class="fa fa-bookmark"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>

    <div class="row" style="margin: 3px;">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Penulis::getCount()); ?></h3>
            <p>Data Penulis</p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Kategori::getCount()); ?><sup style="font-size: 20px"></sup></h3>
            <p>Data Kategori</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Petugas::getCount()); ?></h3>
            <p>Data Petugas</p>
          </div>
          <div class="icon">
            <i class="fa fa-exchange"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= Yii::$app->formatter->asInteger(Penerbit::getCount()); ?></h3>
            <p>Data Penerbit</p>
          </div>
          <div class="icon">
            <i class="fa fa-bookmark"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>


    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <h3 class="box-title">Buku Berdasarkan Kategori</h3>
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'KATEGORI BUKU'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Kategori',
                  'data' => Kategori::getGrafikList(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="box-header with-border">
          <h3 class="box-title">Buku Berdasarkan Penulis</h3>
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'PENULIS BUKU'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Penulis',
                  'data' => Penulis::getGrafikList(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="box-header with-border">
        <h3 class="box-title">Buku Berdasarkan Penerbit</h3>
      </div>
      <div class="box-body">
        <?=Highcharts::widget([
          'options' => [
            'credits' => false,
            'title' => ['text' => 'PENERBIT BUKU'],
            'exporting' => ['enabled' => true],
            'plotOptions' => [
              'pie' => [
                'cursor' => 'pointer',
              ],
            ],
            'series' => [
              [
                'type' => 'pie',
                'name' => 'Penerbit',
                'data' => Penerbit::getGrafikList(),
              ],
            ],
          ],
        ]);?>
      </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Grafik Peminjaman Buku</h3>
        </div>
        <div class="box-body">
          <?= \miloschuman\highcharts\Highcharts::widget([
            'options' => [
              'credits' => true,
              'title' => ['text' => 'ANGKA DATA PEMINJAMAN BUKU PERBULAN'],
              'exporting' => ['enabled' => true],
              'xAxis' => [
                'categories' => \app\components\Helper::getListBulanGrafik(),
              ],
              'series' => [
                [
                  'type' => 'column',
                  'colorByPoint' => true,
                  'name' => 'Peminjaman',
                  'data' => \app\models\Peminjaman::getCountGrafik(),
                  'showInLegend' => false
                ],
              ],
            ]
          ]) ?>
        </div>
      </div>
    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with border">
      <div class="box box-title">
        <h3 class="box-title">
          Daftar Peminjam Terbaru
        </h3>
      </div>

      <div class="box box-body">
        <table class="table table-bordered table-stripped">
          <thead>
            <tr>
              <th width="55px" class="text-center" rowspan="2">No</th>
              <th class="text-center" rowspan="2">Nama Buku</th>
              <th class="text-center" rowspan="2">Nama Peminjam</th>
              <th class="text-center" colspan="5">Tanggal Pengembalian</th>
            </tr>
            <tr>
              <th width="150px" class="text-center">Tanggal Pinjam</th>
              <th width="150px" class="text-center">Batas Kembali</th>
              <th width="150px" class="text-center">Pengembalian</th>
              <th width="150px" class="text-center">Selisih</th>
              <th width="150px" class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1?>
            <?php foreach (Peminjaman::find()->andWhere(['status_buku' => 1])->orderBy(['tanggal_pinjam' =>  SORT_DESC])->limit(10)->all() as $peminjam): ?>
            <tr>
              <td class="text-center"><?= $i++ ?></td>
              <td class="text-center"><?= $peminjam->buku->nama ?></td>
              <td class="text-center"><?= $peminjam->anggota->nama ?></td>
              <td class="text-center"><?= $peminjam->tanggal_pinjam ?></td>
              <td class="text-center"><?= $peminjam->tanggal_kembali ?></td>
              <td class="text-center"><?= $peminjam->tanggal_pengembalian_buku ?></td>
              <td class="text-center"><?= $peminjam->getTanggal() ?> Hari</td>
              <td class="text-center"><?= $peminjam->getStatusPeminjaman() ?></td>
              <td class="text-center"><?= Html::a('<i class="fa fa-check-square-o"></i>', ['peminjaman/kembalikan-buku', 'id' => $peminjam->id], ['data' => ['confirm' => 'Apa anda yakin ingin menyutujui Buku ini?'],]); ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif ?>