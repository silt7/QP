<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Frez' );
Yii::import( 'application.models.ColorCategory' );


class FrezController extends AdminController {


    /**
     * Список цветов
     */
    public function actionView() {

        $pageCriteria = new CDbCriteria;
        //$pageCriteria->condition = 'url=:url';
        //$pageCriteria->params    = array( ':url' => "main" );
        $pageCriteria->order = 'title ASC';

        $frez = Frez::model()->findAll( $pageCriteria );


        $this->pageTitle = "Редактирование фрезеровок";
        $this->layout    = 'auth';
        $this->render( 'view', array( 'frez' => $frez ) );
    }


    /**
     * Редактирование цвета
     */
    public function actionEdit() {

        $id = Yii::app()->getRequest()->getQuery( 'id' );


        $frez        = Frez::model()->findByPk( $id );
        if($frez->title == null){
            $frez->title = 'Not Found';
        }
        $frez->title = str_replace( "\"", "&#34;", $frez->title );

        $colorCategory  = ColorCategory::model()->findAll();

        $this->pageTitle = "Редактирование Фрезеровки";
        $this->layout    = 'auth';
        $this->render( 'edit', array( 'frez' => $frez, 'colorCategory'=>$colorCategory) );
    }

    /**
     * Создание цвета
     */
    public function actionCreate() {

        $frez           = new Frez();
        $frez ->title    = "Новая фрезеровка";
        $frez ->is_show  = 0;
        $frez ->categ_color = '';
        $frez ->categ_frez = 0;
        $frez ->image    = '';
        $frez->save();

        $url = $this->createAbsoluteUrl( 'admin/frez/edit' ) . '/?id=' . $frez->id;
        $this->redirect( $url, true );

    }

    /**
     * Сохранение цвета
     */
    public function actionSave() {

        $id       = Yii::app()->request->getPost( "id" );
        $title    = Yii::app()->request->getPost( "title" );
        $category = Yii::app()->request->getPost( "category" ) ? Yii::app()->request->getPost( "category" ) : 0;
        $categ_color = Yii::app()->request->getPost( "colorCategory" ) ? Yii::app()->request->getPost( "colorCategory" ) : "";
        //$type     = isset( $_POST['type'] ) ? $_POST['type'] : "";
        $isShow      = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;

        $image       = $_FILES["image"]["name"];
        if(isset($_POST['del_img'])){
            $del_img = $_POST['del_img'];
        }else $del_img = "n";

        $title = str_replace( "\"", "&#34;", $title );

        $frez                = Frez::model()->findByPk( $id );
        $frez->title         = $title;
        $frez->categ_frez    = $category;
        $frez->categ_color   = serialize($categ_color);
        $frez->is_show = $isShow;
        if ( $frez->update() and $image != null ) {
            $image = $id.'.png';//md5( $color->title . $image );
            $path  = Yii::getPathOfAlias( 'webroot' ) . '/images/frez/' . $image;
            if(file_exists($path)){
                unlink($path);
            }
            move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
            $frez->image = $id;
            $frez->update();

        }
        if(($image == null) and $del_img == "y"){
            $image = $id . '.png';
            $path  = Yii::getPathOfAlias( 'webroot' ) . '/images/frez/' . $image;
            if(file_exists($path)){
                unlink($path);
            }
            $frez->image = "";
            $frez->update();
        }
        $url = $this->createAbsoluteUrl( 'admin/frez/view' );
        $this->redirect( $url, true );
    }

    /**
     * Удаление цвета
     */
    public function actionDelete() {

        $id = Yii::app()->getRequest()->getQuery( 'id' );

        $frez = Frez::model()->findByPk( $id );
        if ( $frez ) {
            $frez->delete();
        }

        $url = $this->createAbsoluteUrl( 'admin/frez/view' );
        $this->redirect( $url, true );

    }

}