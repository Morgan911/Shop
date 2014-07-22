<?php

class CategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
function prepareTree($categories)
{  
    $arr = array();
    foreach($categories as $category)
    {
        if (!$category->parentid)
            $category->parentid = 0;
        if(empty($arr[$category->parentid]))
            $arr[$category->parentid] = array();
        $arr[$category->parentid][] = $category;
    }
    return $arr;    
}

function buildTree($arr,$parent_id = 0,&$str = '',$form,$model) 
{       
    //Условия выхода из рекурсии
    if(empty($arr[$parent_id])) 
        return;
if($arr[parent_id]==0){
//    $str.= '<ul style="list-style-type:none">';
//    $str.= '<li>';
//    $str.= $form->radioButton($model, 'parentid',array('value'=>0,'uncheckValue'=>null));
//    $str.= 'Главная категория';
//    $str.= '</li>';
//    $str.= '</ul>';
} 
        $str.= '<ul style="list-style-type:none">';
    //перебираем в цикле массив формируем строку

    for($i = 0; $i < count($arr[$parent_id]);$i++) {
        $str.= '<li>';
        $str.= $form->radioButton($model, 'parentid',array('value'=>$arr[$parent_id][$i]->id,'uncheckValue'=>null));
        $str.= $arr[$parent_id][$i]->name;
        //рекурсия - проверяем нет ли дочерних категорий
        $this->buildTree($arr,$arr[$parent_id][$i]->id,$str,$form,$model);
        $str.= '</li>';
    }
    $str.= '</ul>';
}

function getMenu($categories,$form,$model)
{
    $string = ''; 
    $cat = $this->prepareTree($categories);
    $this->buildTree($cat,0,$string,$form,$model);
    return $string;
}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Category;
                $categories = Category::model()->findAll();
                //$tree = $this->getMenu($categories,$form,$model,'parentid');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
                       
             $uploadedFile=CUploadedFile::getInstance($model,'image');
			$model->attributes=$_POST['Category'];
                        
                        if($model->save()){
                            if(!empty($uploadedFile))
                            {
                                $uploadedFile->saveAs(Yii::getPathOfAlias('webroot')."/TestImgFolder/".$uploadedFile->getName());
                                $filename = $uploadedFile->getName();
                                $connection=Yii::app()->db;
                                $sql = "UPDATE sh_category SET image='$filename' WHERE id=$model->id";
                                $command=$connection->createCommand($sql);
                                $rowCount=$command->execute();
                                $this->redirect(array('view','id'=>$model->id));
                            }
                        }
				
		}

		$this->render('create',array(
			'model'=>$model,
                        'categories'=>$categories,
                    'uploadedFile'=>$uploadedFile
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
//	public function actionIndex()
//	{
//		$dataProvider=new CActiveDataProvider('Category');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
