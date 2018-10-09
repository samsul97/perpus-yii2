<?php

namespace app\models;
use yii\helpers\StringHelper;

use Yii;

/**
 * This is the model class for table "penulis".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 */
class Penulis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penulis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['alamat'], 'string'],
            [['nama', 'telepon', 'email'], 'string', 'max' => 255],
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
        ->andwhere(['id_penulis' => $this->id])
        ->orderBy(['nama' => SORT_ASC])
        ->all();
    }

    public function getManyBuku()
    {
        return $this->hasMany(Buku::class, ['id_penulis' => 'id']);
    }

    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $penulis) {
            $data[] = [StringHelper::truncate($penulis->nama, 20), (int) $penulis->getManyBuku()->count()];
        }
        return $data;
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
