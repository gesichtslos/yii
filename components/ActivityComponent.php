<?php

namespace app\components;


use app\behaviors\LogBehavior;
use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
    public $classEntity;
    const EVENT_CUSTOM_EVENT = 'custom_event';

    function behaviors()
    {
        return [
            LogBehavior::class
        ];
    }

    public function init()
    {
        parent::init();
        if (empty($this->classEntity)) {
            throw new \Exception('classEntity param required');
        }
    }

    public function getEntity()
    {
        return new $this->classEntity();
    }

    public function getActivityById($id): ?Activity
    {
        return Activity::findOne($id);
    }

    public function editActivity(Activity &$model): bool
    {
        if (!$model->validate()) {
            return false;
        }

        $model->updateAttributes(['title', 'description', 'dateStart', 'dateEnd']);
        return true;
    }

    public function createActivity(Activity $model): bool
    {
        $model->image = UploadedFile::getInstances($model, 'image');
        $model->user_id = \Yii::$app->user->getId();
        if ($model->save()) {
            $this->trigger(self::EVENT_CUSTOM_EVENT);
            if ($model->image) {
                $filesArr = [];
                foreach ($model->image as $file) {
                    if ($image = $this->saveUploadedFile($file)) {
                        array_push($filesArr, $image);
                    }
                }
                $model->image = $filesArr;
            }
            return true;
        }

        return false;
    }

    private function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->getPathToSaveImage();
        $fileName = $this->genFileName($file);
        $path .= DIRECTORY_SEPARATOR . $fileName;
        if ($file->saveAs($path)) {
            return $fileName;
        } else {
            return null;
        }
    }

    private function getPathToSaveImage(): string
    {
        $path = \Yii::getAlias('@webroot/images');
        FileHelper::createDirectory($path);
        return $path;
    }

    private function genFileName(UploadedFile $file)
    {
        return time() . '_' . $file->getBaseName() . '.' . $file->getExtension();
    }

    public function getNameTableDb()
    {
        return 'activity';
    }
}