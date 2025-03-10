<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

class ProductoSearch extends Producto
{
    public function rules()
    {
        return [
            [['id', 'stock'], 'integer'],
            [['nombre', 'descripcion', 'created_at'], 'safe'],
            [['precio'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Producto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
              ->andFilterWhere(['like', 'nombre', $this->nombre])
              ->andFilterWhere(['like', 'descripcion', $this->descripcion])
              ->andFilterWhere(['precio' => $this->precio])
              ->andFilterWhere(['stock' => $this->stock])
              ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}