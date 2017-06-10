<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class AdressController extends Controller
{
	/**
     * Lists all ApartmentType models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

