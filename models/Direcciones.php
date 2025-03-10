<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\base\Exception;

/**
 * This is the model class for table "direcciones".
 *
 * @property int $id
 * @property int|null $id_usuario
 * @property string $direccion
 * @property string|null $ciudad
 * @property string|null $pais
 * @property string|null $codigo_postal
 *
 * @property Usuarios $usuario
 */
class Direcciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direcciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'ciudad', 'pais', 'codigo_postal'], 'default', 'value' => null],
            [['id_usuario'], 'integer'],
            [['direccion'], 'required'],
            [['direccion'], 'string'],
            [['ciudad', 'pais'], 'string', 'max' => 100],
            [['codigo_postal'], 'string', 'max' => 20],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'direccion' => 'Direccion',
            'ciudad' => 'Ciudad',
            'pais' => 'Pais',
            'codigo_postal' => 'Codigo Postal',
        ];
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'id_usuario']);
    }

    /**
     * Exporta todas las direcciones a un archivo CSV.
     */
    public static function exportarDirecciones()
    {
        $fileName = 'direcciones_' . date('Y-m-d_H-i-s') . '.csv';
        $filePath = Yii::getAlias('@webroot/uploads/') . $fileName;
        FileHelper::createDirectory(Yii::getAlias('@webroot/uploads'));
        
        $file = fopen($filePath, 'w');
        fputcsv($file, ['ID', 'ID Usuario', 'Direccion', 'Ciudad', 'Pais', 'Codigo Postal']);
        
        foreach (self::find()->all() as $direccion) {
            fputcsv($file, [$direccion->id, $direccion->id_usuario, $direccion->direccion, $direccion->ciudad, $direccion->pais, $direccion->codigo_postal]);
        }
        
        fclose($file);
        Yii::$app->response->sendFile($filePath);
    }

    /**
     * Importa direcciones desde un archivo CSV.
     */
    public static function importarDirecciones(UploadedFile $archivo)
    {
        $filePath = Yii::getAlias('@webroot/uploads/') . $archivo->name;
        $archivo->saveAs($filePath);

        $file = fopen($filePath, 'r');
        fgetcsv($file); // Saltar encabezados
        
        $importados = 0;
        $errores = 0;
        
        while (($line = fgetcsv($file)) !== false) {
            $direccion = new self();
            $direccion->id_usuario = $line[1];
            $direccion->direccion = $line[2];
            $direccion->ciudad = $line[3];
            $direccion->pais = $line[4];
            $direccion->codigo_postal = $line[5];
            
            if ($direccion->save()) {
                $importados++;
            } else {
                $errores++;
            }
        }
        
        fclose($file);
        return ['importados' => $importados, 'errores' => $errores];
    }
}
