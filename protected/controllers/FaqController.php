<?php
class FaqController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('create','update','searchKey'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FaqCreateForm;
		$faq= new Faq;

		$criteria=new CDbCriteria;
		$criteria->select='max(faq_id) AS maxColumn';
		$row = $faq->model()->find($criteria);
		$id=$row['maxColumn']+1;
		
		$faq->faq_id = $id;
		$faq->lang=$this->getCurrentLang();
		$faq->rate=0;
		$model->faq_id=$id;
		$model->faq_lang=$this->getCurrentLang();

		$all_categories=FaqCategory::model()->findAll(array(
			'condition'=>'lang=:lang',
			'params'=>array(':lang'=>$model->faq_lang)
			));
		foreach ($all_categories as $key => $category) {
			$categories[$category->faq_category_id]=$category->faq_category_title;
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FaqCreateForm']))
		{
			$model->attributes=$_POST['FaqCreateForm'];
			$faq->faq_question=$model->faq_question;
			$faq->faq_answer=$model->faq_answer;
			if($faq->save())
			{
				if ($_POST['FaqCreateForm']['faq_keywords']) {
					$keywords=explode(',', $_POST['FaqCreateForm']['faq_keywords']);
					
					foreach ($keywords as $key => $keyword) {
						$isKey=Keywords::model()->findAll(array(
							'condition'=>'keyword=:keyword',
							'params'=>array(':keyword'=>$keyword)
									)
								);
						if(empty($isKey))
						{
							$newKeyword= new Keywords;

							$criteria=new CDbCriteria;
							$criteria->select='max(keyword_id) AS maxColumn';
							$row = $newKeyword->model()->find($criteria);

							$newKeyword->keyword_id=$row['maxColumn']+1;
							$newKeyword->keyword=$keyword;
							$newKeyword->lang=$this->getCurrentLang();
							if ($newKeyword->save()) {
								$keywordFaq= new KeywordsFaq;
								$keywordFaq->keyword_id=$newKeyword->keyword_id;
								$keywordFaq->faq_id=$faq->faq_id;
								$keywordFaq->save();
							}
						}
						else
						{
							$keywordFaq= new KeywordsFaq;
							$keywordFaq->keyword_id=$isKey['0']->keyword_id;
							$keywordFaq->faq_id=$faq->faq_id;
							$keywordFaq->save();
						}
					}
				}
				if(!empty($model->faq_categories))
				{
					foreach ($model->faq_categories as $key => $category) {
						$faq_category_faq=new FaqCategoryFaq;
						$faq_category_faq->faq_category_id=$category;
						$faq_category_faq->faq_id=$faq->faq_id;
						$faq_category_faq->save();
					}
				}
			}

			$this->redirect(array('view','id'=>$faq->faq_id));

		}

		$this->render('create',array(
			'model'=>$model,
			'categories'=>$categories
		));
	}

	public function actionSearchKey($term)
	{
		$lang=$this->getCurrentLang();

		$keywords= Keywords::model()->findAll(array(
			'condition'=>'lang=:lang',
			'params'=>array(':lang'=>$lang)
			));

 		foreach ($keywords as $key => $keyword) {
 			if (strpos($keyword->keyword, $term) !==false) {
 				$data[]=array('label'=>$keyword->keyword,'value'=>$keyword->keyword);
 			}
 		}
 		echo json_encode($data);
	}

	public function getCurrentLang()
	{
		$lang=explode('_',Yii::app()->language);
		return ($lang[0]) ? $lang[0] : 'tr' ;
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

		if(isset($_POST['Faq']))
		{
			$model->attributes=$_POST['Faq'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->faq_id));
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Faq');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Faq('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Faq']))
			$model->attributes=$_GET['Faq'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Faq the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Faq::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Faq $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='faq-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}