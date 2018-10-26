<?php

namespace app\models;

use Yii;
use yii\helpers\StringHelper;
/**
 * This is the model class for table "penerbit".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 */
class Penerbit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penerbit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['nama', 'telepon'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 2555],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'email' => 'Email',
        ];
    }
    // menggunakan fungsi array helper untuk mengasumsikan sebuah field id menjadi nama. fungsi ini akan di panggil di halaman form buku.
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
    // fungsi findAllBuku yaitu untuk mencari semua buku berdasarkan kategori yang dimiliki. contoh kategori novel, terdapat berapa buku yang kategorinya novel. nah, fungsi ini di panggil 
    public function findAllBuku()
    {
        return Buku::find()
        ->andwhere(['id_penerbit' => $this->id])
        ->orderBy(['nama' => SORT_ASC])
        ->all();
    }
    public static function getCount()
    {
        return static::find()->count();
    }
    public function getManyBuku()
    {
        return $this->hasMany(Buku::class, ['id_penerbit' => 'id']);
    }
    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $penerbit) {
            $data[] = [StringHelper::truncate($penerbit->nama, 20), (int) $penerbit->getManyBuku()->count()];
        }
        return $data;
    }
    
}
