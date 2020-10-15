<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;

use app\models\Contacts;
use app\models\Contacts as ContactsModel;
use app\searches\Contacts as ContactsSearch;
use app\forms\Form;


class SiteController extends Controller
{
    public function actionIndex()
    {

        return (new ContactsSearch([ 
            'query' => ContactsModel::find()

        ]))->search();
    }
    public function actionCreate()
    {
        $form = new Form();
        $form->load(Yii::$app->request->post(), '');

        if(!$form->load(Yii::$app->request->post(), '')){
            throw new \yii\web\BadRequestHttpException('was not load');
        }

        $valid = $form->validate();
        if(!$form->validate()){
            throw new \yii\web\BadRequestHttpException('your form is not validet');
        }
        if ($valid == true) {
            $Contact = new Contacts();
            $Contact->email = $form->email;
            $Contact->login = $form->login;
            $Contact->password = $form->password;
            $Contact->save(false);
            return ['messege' => 'good'];
        } else {
            Yii::$app->response->statusCode = 400;
            return ['messege' => 'shit'];
        }
    }

    public function actionView($id)
    {
        return Contacts::find()
            ->where(['id_user' => $id])

            ->one();
    }

    public function actionUpdate()
    {
        $form = new Form();
        $form->load(Yii::$app->request->post(), '');
        if(!$form->load(Yii::$app->request->post(), '')){
            throw new \yii\web\BadRequestHttpException('was not load');
        }
        $valid = $form->validate();
        if(!$form->validate()){
            throw new \yii\web\BadRequestHttpException('your form is not validet');
        }

        if ($valid == true) {
            $Contact = Contacts::findOne(Yii::$app->request->post('id'));
            $Contact->email = $form->email;
            $Contact->login = $form->login;
            $Contact->password = $form->password;
            $Contact->save(false);
            return ['messege' => 'good'];
        }

        return ['message' => 'everything is good'];
        
    }

    public function actionDelete()
    {
        $Contact = Contacts::findOne(Yii::$app->request->post('id'));



        $Contact->delete();
    }

    public function actionStroki($myValue)


    {
        return Contacts::find()
            ->where(['id_user' => $myValue])

            ->one();
    }
};
