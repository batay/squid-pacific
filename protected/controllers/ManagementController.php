<?php

class ManagementController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','organisations','users','view','updateUser','delete','resetPassword','sendMail'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		echo $id;
	}

	public function actionIndex(){
		$this->render('index');

	}
	public function actionUsers(){
		 $this->render('users');
		
		$dataProvider=new CActiveDataProvider('User', array(
		    'criteria'=>array(
		        'order'=>'name ASC',
		    ),
		    'countCriteria'=>array(
		        // 'order' and 'with' clauses have no meaning for the count query
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));
		 $dataProvider->getData(); //will return a list of Post objects

		$this->widget('zii.widgets.grid.CGridView', array(
		    'dataProvider'=>$dataProvider,
		    'columns'=>array(
		    	'id',
		        'name',
		        'surname',
		        'email',
      			//'htmlOptions' => array('class' => 'datatable table table-striped table-bordered table-hover dataTable'),
		        array( 
		            'class'=>'CButtonColumn',
		            'template'=>'{reset}{email}{guncelle}{sil}',
				    'buttons'=>array(
				        'email' => array(
				            'label'=>'&nbsp;&nbsp;',
				            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
				            // 'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
				            'url'=>'"#"',
				            'options'=>array("class"=>'fa fa-envelope sendEmail management-users-buttons','title'=>'Eposta Gönder'),
				        ),
				        'guncelle' => array(
				            'label'=>'&nbsp;&nbsp;',
				            'url'=>'"#"',
				            //'visible'=>'$data->score > 0',
				            'options'=>array("class"=>'fa fa-pencil-square-o update management-users-buttons','title'=>'Düzenle'),
				        ),
				        'sil' => array(
				            'label'=>'&nbsp;&nbsp;',
				            'url'=>'"#"',
				            //'visible'=>'$data->score > 0',
				            //'options'=>array("onclick"=>'openUpdateModal(100)'),
				            'options'=>array("class"=>'fa fa-times delete management-users-buttons','title'=>'Sil'),
				        ),
				        'reset' => array(
				            'label'=>'&nbsp;&nbsp;',
				            'url'=>'"#"',
				            //'visible'=>'$data->score > 0',
				            'options'=>array("class"=>'fa fa-key resetPassword management-users-buttons','title'=>'Şifre Yenile'),
				        ),
				    ),
		        ),
		    ),
		));
	}

	public function actionSendMail(){
		$id=$_POST['id'];
		if ($id) {
			$user=User::model()->findByPk($id);
			
			$message=$_POST['message'];
			$mail=new Email;
			$mail->setTo(array($user->email));
			$mail->setSubject('OKUTUS|Yöneticiden Mesaj');
			$mail->setFile('10Admin-mails.html');
			$mail->setAttributes(array('title'=>'OKUTUS|Yöneticiden Mesaj','message'=>$message));




			if($mail->sendMail()) {
				echo "1";
			}else{
				echo "Mail gönderilemedi! Lütfen tekrar deneyin.";
			}
		}
	}

	public function actionDelete(){
		$id=$_POST['id'];
		if ($id) {
			$user=User::model()->findByPk($id);
			if ($user) {
				if ($user->delete()) {
					echo "1";
				}
				else{
					echo "Kayıt silinemedi!";
				}
			}else{
				echo "Kullanıcı Bulunamadı!";
			}
		}else{
			echo "ID Bulunamadı!";
		}
	}

	public function actionUpdateUser(){
		$id=$_POST['id'];
		if ($id) {
			$user=User::model()->findByPk($id);
			if ($user) {
				$user->name=$_POST['name'];
				$user->surname=$_POST['surname'];
				$user->email=$_POST['email'];
				if ($user->save()) {
					echo "1";
				}
				else{
					echo "Kayıt güncellenemedi!";
				}
			}else{
				echo "Kullanıcı Bulunamadı!";
			}
		}else{
			echo "ID Bulunamadı!";
		}
	}


	public function actionResetPassword(){
		$id=$_POST['id'];
		$user=User::model()->findByPk($id);
		if (!empty($user)) {
			$meta=new UserMeta;
			$meta->user_id=$user->id;
			$meta->meta_key='passwordReset';

			$resetId=functions::new_id(20);

			$link=Yii::app()->getBaseUrl(true);
			$link.='/user/forgetPassword?id=';
			$meta->meta_value=$resetId;
	        $meta->created=time();
        	$meta->save();

			$link .= $resetId;

        	$mail=new Email;
			$mail->setTo(array($user->email));
			$mail->setSubject('OKUTUS Şifre Sıfırlama');
			$mail->setFile('4password_reset.tr_TR.html');
			$mail->setAttributes(array('adsoyad'=>$user->name.' '.$user->surname,'title'=>'OKUTUS Şifre Sıfırlama','link'=>$link));
	        if($mail->sendMail()) {
	        	echo "1";
        	}
        	else
        	{
        		echo "Eposta gönderilemedi! Lütfen tekrar deneyiniz.";
        	}
		}
		else
		{
			echo "Kullanıcı Bulunamadı! Lütfen tekrar deneyiniz.";
		}
	}

	public function actionOrganisations(){
		$page =(int) (isset($_GET['page']) ? $_GET['page'] : 1);  // define the variable to “LIMIT” the query
        

        $query1 = Yii::app()->db->createCommand() //this query contains all the data
        ->select(array('*'))
        ->from(array('organisations'))
        ->order('organisation_id')
        ->limit(Yii::app()->params['listPerPage'], ($page-1)*Yii::app()->params['listPerPage'] ) // the trick is here!
        ->queryAll();
        
        $item_count = Yii::app()->db->createCommand() // this query get the total number of items,
        ->select('count(*) as count')
        ->from(array('organisations'))
        ->queryAll(); // do not LIMIT it, this must count all items!

// the pagination itself
        $pages = new CPagination($item_count[0]['count']);
        $pages->setPageSize(Yii::app()->params['listPerPage']);
        

// render
        $this->render('organisations',array(
            'query1'=>$query1,
            'item_count'=>(int)$item_count[0]['count'],
            'page_size'=>Yii::app()->params['listPerPage'],
            'pages'=>$pages,
                ));
		

	}

}