<?php

namespace app\controllers;

use app\Models\Producto;
use app\models\ProductoSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Producto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel ->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchModel'=> $searchModel,
            'dataProvider'=> $dataProvider
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Producto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionExportar()
    {
        $productos = Producto:: find ()->all();
        $filename = "productos_exportados.csv";

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen("php://output","w");
        fputcsv($output,["ID","Nombre","Descripcion","Precio", "Stock"]);
        foreach($productos as $producto){
            fputcsv($output,[$producto->id,$producto->nombre,$producto->descripcion, $producto->precio, $producto->stock]);
        }
        fclose($output);
        exit;
    }
    public function actionImportar()
{
    if (Yii::$app->request->isPost) {
        $archivo = UploadedFile::getInstanceByName('archivo_csv');

        if ($archivo) {
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
                    
                    $importados = 0;
                    $errores = 0;
                    
                    while (($datos = fgetcsv($handle, 1000, ",")) !== false) {
                        if (count($datos) >= 5) {  // Verificar que tenga suficientes columnas
                            $producto = Producto::findOne($datos[0]) ?? new Producto();
                            $producto->nombre = $datos[1];
                            $producto->descripcion = $datos[2];
                            $producto->precio = $datos[3];
                            $producto->stock = $datos[4];
                            $producto->created_at = isset($datos[5]) ? $datos[5] : date('Y-m-d H:i:s');
                            
                            if ($producto->save()) {
                                $importados++;
                            } else {
                                $errores++;
                                Yii::error('Error al guardar producto: ' . json_encode($producto->errors));
                            }
                        }
                    }
                    
                    fclose($handle);
                    unlink($rutaCompleta);
                    
                    if ($errores > 0) {
                        Yii::$app->session->setFlash('warning', "Importación completada con advertencias: $importados productos importados, $errores con errores.");
                    } else {
                        Yii::$app->session->setFlash('success', "$importados productos importados correctamente.");
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'No se pudo guardar el archivo.');
                }
            } catch (\Exception $e) {
                Yii::error('Error en importación: ' . $e->getMessage());
                Yii::$app->session->setFlash('error', 'Error al procesar el archivo: ' . $e->getMessage());
            }
        } else {
            Yii::$app->session->setFlash('error', 'No se ha seleccionado ningún archivo.');
        }
    }

    return $this->redirect(['index']);
}


    

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
