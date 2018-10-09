<?php

namespace app\models;
use yii\helpers\StringHelper;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property int $id
 * @property string $nama
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 255],
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
        ];
    }
    // menggunakan fungsi array helper untuk mengasumsikan sebuah field id menjadi nama. fungsi ini akan di panggil di halaman form buku.
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }

    public function getManyBuku()
    {
        return $this->hasMany(Buku::class, ['id_kategori' => 'id']);
    }

    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $kategori) {
            $data[] = [StringHelper::truncate($kategori->nama, 20), (int) $kategori->getManyBuku()->count()];
        }
        return $data;
    }


    // fungsi getJumlahBuku yaitu untuk mencari jumlah buku berdasarkan kategori yang dia miliki.
    public function getJumlahBuku()
    {
        return Buku::find()
        ->andwhere(['id_kategori' => $this->id])
        ->count();
    }

    // fungsi findAllBuku yaitu untuk mencari semua buku berdasarkan kategori yang dimiliki. contoh kategori novel, terdapat berapa buku yang kategorinya novel. nah, fungsi ini di panggil 
    public function findAllBuku()
    {
        return Buku::find()
        ->andwhere(['id_kategori' => $this->id])
        ->orderBy(['nama' => SORT_ASC])
        ->all();
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
