<?php

namespace app\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "peminjaman".
 *
 * @property int $id
 * @property int $id_buku
 * @property int $id_anggota
 * @property string $tanggal_pinjam
 * @property string $tanggal_kembali
 */
class Peminjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peminjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_anggota', 'tanggal_pinjam', 'tanggal_kembali', 'status_buku'], 'required'],
            [['id_buku', 'id_anggota'], 'integer'],
            [['tanggal_pinjam', 'tanggal_kembali', 'tanggal_pengembalian_buku'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_buku' => 'Buku',
            'id_anggota' => 'Anggota',
            'tanggal_pinjam' => 'Tanggal Pinjam',
            'status_buku' => 'Status Buku',
            'tanggal_pengembalian_buku' => 'Tanggal Pengembalian Buku',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
    public function getAnggota()
    {
        return $this->hasOne(Anggota::class, ['id' => 'id_anggota']);
    }
    public function getBuku()
    {
        return $this->hasOne(Buku::class, ['id' => 'id_buku']);
    }
    public function getManyBuku()
    {
        return $this->hasMany(Peminjaman::class, ['id_buku' => 'id']);
    }
    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $peminjaman) {
            $data[] = [StringHelper::truncate($peminjaman->id_anggota, 20), (int) $peminjaman->getManyBuku()->count()];
        }
        return $data;
    }
}
