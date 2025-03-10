<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categorias;

/**
 * CategoriasSearch representa el modelo detrás del formulario de búsqueda de `app\models\Categorias`.
 */
class CategoriasSearch extends Categorias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'descripcion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // Bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Crea una instancia de proveedor de datos con la consulta de búsqueda aplicada.
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Categorias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Cargar los parámetros de búsqueda y validar
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // Aplicar filtros
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
              ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}