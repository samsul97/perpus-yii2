<?php

namespace app\controllers;

use Yii;
use app\models\Buku;
use app\models\BukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOfactory;
use Mpdf\Mpdf;
use PhpOffice\PhpWord\Shared\Converter;
use yii\web\ArrayHelper;
use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\Behavior;
use yii\helpers\Url;
use app\models\User;
use yii\filters\AccessControl;

/**
 * BukuController implements the CRUD actions for Buku model.
 */
class BukuController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['view', 'create', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function() {
                            return User::isAdmin() || User::isPetugas();
                        }
                    ],
                    // true berarti bisa mengakses.
                    [
                        'actions' => ['index', 'create'],
                        'allow' => false,
                        'roles' => ['@'],
                        'matchCallback' => function()
                        {
                            return User::isAnggota();
                        },
                    ],
                    // false berarti tidak bisa mengakses
                    // [
                    //     'actions' => ['index', 'create', 'update'],
                    //     'allow' => true,
                    //     'roles' => ['@'],
                    //     'matchCallback' => function()
                    //     {
                    //         return User::isPetugas();
                    //     },
                    // ],
                ],
            ],
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Buku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Buku model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Buku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Buku();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // var_dump($model->load(Yii::$app->request->post()));
            // die;
            $sampul = UploadedFile::getInstance($model, 'sampul');
            $berkas = UploadedFile::getInstance($model, 'berkas');

            $model->sampul = time(). '_' . $sampul->name;
            $model->berkas = time(). '_' . $berkas->name;
            $model->save(false);

            $sampul->saveAs(Yii::$app->basePath. '/web/upload/sampul/' . $model->sampul);
            $berkas->saveAs(Yii::$app->basePath. '/web/upload/berkas/' . $model->berkas);
            Yii::$app->session->setFlash('success', 'Berhasil menambahkan buku');
            return $this->redirect(['index', 'id' => $model->id]);
        }
        

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Buku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sampul_lama = $model->sampul;
        $berkas_lama = $model->berkas;


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $sampul = UploadedFile::getInstance($model, 'sampul');
            $berkas = UploadedFile::getInstance($model, 'berkas');

// jika sampul di ganti isinya, maka di unlink (ganti sampul baru). jika tidak maka tetap sampul yang lama.
            if ($sampul !== null) {
                unlink(Yii::$app->basePath . '/web/upload/sampul/' . $sampul_lama);
                $model->sampul = time() . '_' . $sampul->name;
                $sampul->saveAs(Yii::$app->basePath . '/web/upload/sampul/' . $model->sampul);
            } else {
                $model->sampul = $sampul_lama;
            }
            if ($berkas !== null) {
                unlink(Yii::$app->basePath . '/web/upload/berkas/' . $berkas_lama);
                $model->berkas = time() . '_' . $berkas->name;
                $berkas->saveAs(Yii::$app->basePath . '/web/upload/berkas/' . $model->berkas);
            } else{
                $model->berkas = $berkas_lama;
            }
            // false itu untuk ....
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Data berhasil di perbaharui');
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Buku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Buku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportWord()
    {

        $phpWord = new phpWord();
        $section = $phpWord->addSection(
            [
                'marginTop' => Converter::cmTotwip(1.80),
                'marginBottom' => Converter::cmTotwip(1.80),
                'marginLeft' => Converter::cmTotwip(2.1),
                'marginRight'=> Converter::cmTotwip(1.6),
            ]
        );

        $fontStyle = [
            'underline' => 'dash',
            'bold' => true,
            'italic' => true,
        ];
        $paragraphCenter = [
            'alignment' => 'center',
        ];
        $headerStyle = [
            'bold' => true,
            'fgColor' => 'ffffff',
        ];

        $section->addText(
            'Data Buku Perpustakaan SMAN 2 TANGSEL',
            $headerStyle,
            $fontStyle,
            $paragraphCenter
        );

        $section->addTextBreak(1);

        $judul = $section->addTextRun($paragraphCenter);

        $judul->addText('Keterangan dari', $fontStyle);
        $judul->addText('Tabel', ['italic' => true, $fontStyle]);
        $judul->addText('Buku',  ['bold' => true]); 

        $table =$section->addTable([
            'alignment' => 'left',
            'bgColor' => 6,
            'borderSize' => 6,
        ]);
        $table->addRow(null);
        $table->addCell(500)->addText('No', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Nama Buku', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Tahun Terbit', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Penulis', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Penerbit', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Kategori', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Sinopsis', $headerStyle, $paragraphCenter);

        $semuaBuku = Buku::find()->all();
        $nomor = 1;
        foreach ($semuaBuku as $buku) {
            $table->addRow(null);
            $table->addCell(500)->addText($nomor++, null, $headerStyle, $paragraphCenter);
            $table->addCell(5000)->addText($buku->nama, null);
            $table->addCell(5000)->addText($buku->tahun_terbit, null, $paragraphCenter);
            $table->addCell(3000)->addText(@$buku->penulis->nama, null, $paragraphCenter);
            $table->addCell(3000)->addText(@$buku->penerbit->nama, null, $paragraphCenter);
            $table->addCell(3000)->addText(@$buku->kategori->nama, null, $paragraphCenter);
            $table->addCell(5000)->addText($buku->sinopsis, null);
        }
        // $filename = time() . 'Data-Buku.docx';
        // // echo "$path";
        // // die;
        // $xmlWriter = IOFactory::createWriter($phpWord, 'Word2007');
        // $xmlWriter->save($filename);
        // // return $this->redirect($path);
        // var_dump($path);
        // print getcwd($path);
        // return $this->redirect(['buku/index']);
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="download.docx"');
        // header('Cache-Control: max-age=0');
        // $writer->save('php://output');
         $filename = time().'_Data_buku.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output"); 
    }

    public function actionExportPdf() 
    {
      $this->layout='main1';
      $model = Buku::find()->All();
      $mpdf=new mPDF();
      $mpdf->WriteHTML($this->renderPartial('template',['model'=>$model]));
      $mpdf->Output('DataBuku.pdf', 'D');
      exit;
  }
  public function actionExportExcel() {

    $spreadsheet = new PhpSpreadsheet\Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();

    //Menggunakan Model

    $database = Buku::find()
    ->select('nama, tahun_terbit')
    ->all();

    $worksheet->setCellValue('A1', 'Judul Buku');
    $worksheet->setCellValue('B1', 'Tahun Terbit');

    //JIka menggunakan DAO , gunakan QueryAll()

    /*
     
    $sql = "select kode_jafung,jenis_jafung from ref_jafung"
     
    $database = Yii::$app->db->createCommand($sql)->queryAll();
     
    */

    $database = \yii\helpers\ArrayHelper::toArray($database);
    $worksheet->fromArray($database, null, 'A2');

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="databuku.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');

}

public function actionPdf()
{

   $mpdf  = new mPDF();
   $mpdf->WriteHTML($this->renderPartial('pdfSurat'));
   $mpdf->Output('Formulir-Permohonan-KK.pdf', 'D');
   exit;

   $content = $this->renderPartial('pdfSurat');

   $marginLeft = 20;
   $marginRight = 15;
   $marginTop = 5;
   $marginBottom = 5;
   $marginHeader = 5;
   $marginFooter = 5;

   $cssInline = <<<CSS
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

.konten div {
    box-shadow:
    2px 0 0 0 #888,
    0 2px 0 0 #888,
    2px 2px 0 0 #888,   /* Just to fix the corner */
    2px 0 0 0 #888 inset,
    0 2px 0 0 #888 inset;
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

CSS;

$pdf = new Mpdf([
    'mode' => Mpdf::MODE_UTF8,
            // F4 paper format
    'format' => [210, 330],
            // portrait orientation
    'orientation' => Mpdf::ORIENT_PORTRAIT,
            // stream to browser inline
    'destination' => Mpdf::DEST_BROWSER,
            // your html content input

    'marginLeft' => $marginLeft,
    'marginRight' => $marginRight,
    'marginTop' => $marginTop,
    'marginBottom' => $marginBottom,
    'marginHeader' => $marginHeader,
    'marginFooter' => $marginFooter,

    'content' => $content,

            // format content from your own css file if needed or use the
            // any css to be embedded if required
    'cssInline' => $cssInline,
             // set mPDF properties on the fly
    'options' => ['title' => 'PDF Surat'],
             // call mPDF methods on the fly
    'methods' => []
]);

return $pdf->render();
}


public function actionExportWord2()
{
    $phpWord = new PhpWord();
    $section = $phpWord->addSection(
        [
            'marginTop' => Converter::cmTotwip(1.80),
            'marginBottom' => Converter::cmTotwip(1.80),
            'marginLeft' => Converter::cmTotwip(2.1),
            'marginRight'=> Converter::cmTotwip(1.6),
        ]
    );

    $fontStyle = [
            // 'underline' => 'dash',
            // 'bold' => true,
        'italic' => true,
        // 'size' => 12,
    ];

    // $lorem = 'sdfksdlf'.$var;

    $fontJudul = [
        'underline' => 'single',
        'bold' => true,
            // 'italic' => true,
    ];
    $subJudulBawah = [
        'alignment' => 'left',
    ];
    $paragraphCenter = [
        'alignment' => 'center',
        'size' => '8',
    ];

    $sizeSmall = [
        'size' => '9',
    ];

    $headerStyle = [
        'bold' => true,
        'fgColor' => 'ffffff',
        'marginLeft' => '20',
    ];  

    $section->addText('Lampiran 7 KMA No.477 Tahun 2004',  $sizeSmall,  ['align' => 'right']);
    $section->addText('Pasal 7 Ayat 2 huruf B',  $sizeSmall,  ['align' => 'right']);

    // $section->addTextBreak(1);

    $section->addText(
        "KANTOR DESA KELURAHAN  : ",
        $headerStyle,
        $fontStyle,
        $paragraphCenter
    );
    $section->addText(
        "KECAMATAN \t \t \t : ",
        $headerStyle,
        $fontStyle,
        $paragraphCenter
    );
    $section->addText(
        "KABUPATEN/KOTA \t \t : ",
        $headerStyle,
        $fontStyle,
        $paragraphCenter
    );
    // $section->addTextBreak(1);
    $judul = $section->addTextRun($paragraphCenter);
    $subjudul = $section->addTextRun($paragraphCenter);
    $subjudul1 = $section->addTextRun($subJudulBawah);

    $judul->addText('SURAT KETERANGAN DARI ORANG TUA', $fontJudul);
    $subjudul->addText('Nomor : 474.2/', $subJudulBawah);
    $subjudul->addText(" \t \t \t 429.512.01/2014", ['alignment' => 'right']);
    $subjudul1->addText('Yang bertanda tangan di bawah ini menerangkan dengan sesungguhnya bahwa :');

    $semuaBuku = Buku::find()->all();
    $nomor = 1;
    foreach ($semuaBuku as $buku) {
    // $section->addTextBreak(1);
    // $section->addText('I.', 1);
        $section->addText("I.   1. Nama lengkap \t \t \t : ".$buku->nama, null, $headerStyle);
    // $section->addText( $headerStyle);
        $section->addText("     2. Tempat dan Tanggal Lahir \t : ".$buku->nama, $headerStyle);
        $section->addText("     3. Warga Negara \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     4. Agama \t \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     5. Pekerjaan \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     6. Tempat Tinggal \t \t \t : ".$buku->nama, $headerStyle);
        
    // $section->addTextBreak(1);
    // $section->addText('II.', 1);
        $section->addText("II.  1. Nama lengkap \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     2. Tempat dan Tanggal Lahir \t : ".$buku->nama, $headerStyle);
        $section->addText("     3. Warga Negara \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     4. Agama \t \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     5. Pekerjaan \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     6. Tempat Tinggal \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("Adalah benar ayah kandung dan ibu kandung dari seorang \t \t \t", $headerStyle);
        
    // $section->addTextBreak(1);
    // $section->addText('III.', 1);
        $section->addText("III. 1. Nama lengkap \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     2. Tempat dan Tanggal Lahir \t : ".$buku->nama, $headerStyle);
        $section->addText("     3. Warga Negara \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     4. Jenis Kelamin \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     5. Agama \t \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     6. Pekerjaan \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("     7. Tempat Tinggal \t \t \t : ".$buku->nama, $headerStyle);
        $section->addText("Demikian surat keterangan ini dibuat dengan mengingat sumpah jabatan dan dipergunakan seperlunya \t \t \t", $headerStyle);
    }

    $section->addText("Sumber Beras, 01 September 2014", $headerStyle, ['align' => 'right']);
    $section->addText(" \t \t \t \t \t \t \t \t \t \t  Kepala Desa/Kelurahan");
    $section->addTextBreak(3);
    $section->addText(" \t \t \t \t \t \t \t \t \t \t \t Samsul Hadi", $headerStyle, $fontStyle, $paragraphCenter);
    // $semuaBuku = Buku::find()->all();
    // $nomor = 1;
    // foreach ($semuaBuku as $buku) {
    //         // $table->addRow(null);
    //     $section->addText($nomor++, null, $headerStyle, $paragraphCenter);
    //     $section->addText($buku->nama, null);
    //     $section->addText($buku->tahun_terbit, null, $paragraphCenter);
    //     $section->addText(@$buku->penulis->nama, null, $paragraphCenter);
    //     $section->addText(@$buku->penerbit->nama, null, $paragraphCenter);
    //     $section->addText(@$buku->kategori->nama, null, $paragraphCenter);
    //     $section->addText($buku->sinopsis, null);
    // }
    // $filename = time() . 'Surat-ortu.docx';
    // $path = 'export/ ' . $filename;
    // $xmlWriter = IOFactory::createWriter($phpWord, 'Word2007');
    // $xmlWriter->save($path);
    // return $this->redirect($path);
        // var_dump($xmlWriter);
        // die;
        // print getcwd($path);
    $filename = time().'_Data_buku.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");
}

}
