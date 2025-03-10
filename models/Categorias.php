<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "categorias".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['nombre', 'descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Exporta todas las categorías a un archivo CSV.
     *
     * @return void
     */
    public static function exportarCategorias()
    {
        $categorias = self::find()->all();
        $filename = "categorias_exportadas.csv";

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen("php://output", "w");
        fputcsv($output, ["ID", "Nombre", "Descripcion"]);
        foreach ($categorias as $categoria) {
            fputcsv($output, [$categoria->id, $categoria->nombre, $categoria->descripcion]);
        }
        fclose($output);
        exit;
    }

    /**
     * Importa categorías desde un archivo CSV.
     *
     * @param UploadedFile $archivo El archivo CSV subido.
     * @return array Un array con el número de categorías importadas y errores.
     */
    public static function importarCategorias($archivo)
    {
        $importados = 0;
        $errores = 0;

        try {
            // Asegurarse que el directorio existe
            $uploadPath = Yii::getAlias('@app/uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $rutaCompleta = $uploadPath . '/' . $archivo->baseName . '.' . $archivo->extension;
            if ($archivo->saveAs($rutaCompleta)) {
                $handle = fopen($rutaCompleta, "r");
                fgetcsv($handle); // Saltar la primera fila (encabezados)

                while (($datos = fgetcsv($handle, 1000, ",")) !== false) {
                    if (count($datos) >= 3) {  // Verificar que tenga suficientes columnas
                        $categoria = self::findOne($datos[0]) ?? new self();
                        $categoria->nombre = $datos[1];
                        $categoria->descripcion = $datos[2];

                        if ($categoria->save()) {
                            $importados++;
                        } else {
                            $errores++;
                            Yii::error('Error al guardar categoría: ' . json_encode($categoria->errors));
                        }
                    }
                }

                fclose($handle);
                unlink($rutaCompleta);
            } else {
                throw new \Exception('No se pudo guardar el archivo.');
            }
        } catch (\Exception $e) {
            Yii::error('Error en importación: ' . $e->getMessage());
            throw $e; // Relanzar la excepción para manejarla en el controlador
        }

        return ['importados' => $importados, 'errores' => $errores];
    }
}