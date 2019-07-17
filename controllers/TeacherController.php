<?php
/**
 * Created by PhpStorm.
 * User: 3G
 * Date: 16.07.2019
 * Time: 22:36
 */

namespace app\controllers;


use yii\web\Controller;

class TeacherController extends Controller
{
    public function actionStudent(){
        $studentName = '%username%';
        return $this->render('student', ['name'=>$studentName]);
    }
}//