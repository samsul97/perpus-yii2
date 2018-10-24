<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Buku;

/**
 * BukuSearch represents the model behind the search form of `app\models\Buku`.
 */
class BukuSearch extends Buku
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'id_penulis', 'id_penerbit', 'id_kategori'], 'integer'],
            [['nama', 'tahun_terbit', 'globalSearch', 'sinopsis', 'sampul', 'berkas'], 'safe'],
            [['harga'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Buku::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tahun_terbit' => $this->tahun_terbit,
            'id_penulis' => $this->id_penulis,
            'id_penerbit' => $this->id_penerbit,
            'id_kategori' => $this->id_kategori,
            'harga' => $this->harga,
        ]);

        $query->orFilterWhere(['like', 'nama', $this->globalSearch])
            ->orFilterWhere(['like', 'sinopsis', $this->globalSearch])
            ->orFilterWhere(['like', 'sampul', $this->globalSearch])
            ->orFilterWhere(['like', 'berkas', $this->globalSearch])
            ->orFilterWhere(['like', 'harga', $this->globalSearch]);

        return $dataProvider;
    }
}
