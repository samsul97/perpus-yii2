<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buku".
 *
 * @property int $id
 * @property string $nama
 * @property string $tahun_terbit
 * @property int $id_penulis
 * @property int $id_penerbit
 * @property int $id_kategori
 * @property string $sinopsis
 * @property string $sampul
 * @property string $berkas
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['tahun_terbit'], 'safe'],
            [['id_penulis', 'id_penerbit', 'id_kategori'], 'integer'],
            [['sinopsis'], 'string'],
            [['nama', 'sampul', 'berkas', 'harga'], 'string', 'max' => 255],
            // [['harga'], 'safe'],
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
            'tahun_terbit' => 'Tahun Terbit',
            'id_penulis' => 'Penulis',
            'id_penerbit' => 'Penerbit',
            'id_kategori' => 'Kategori',
            'sinopsis' => 'Sinopsis',
            'sampul' => 'Sampul',
            'berkas' => 'Berkas',
            'harga' => 'Harga',
        ];
    }
    public function getPenerbit()
    {
        return $this->hasOne(Penerbit::class, ['id' => 'id_penerbit']);
    }
    public function getKategori()
    {
        return $this->hasOne(Kategori::class, ['id' => 'id_kategori']);
    }
    public function getPenulis()
    {
        return $this->hasOne(Penulis::class, ['id' => 'id_penulis']);
    }
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
