<?php

namespace app\components;


use app\models\Users;
use yii\base\Component;
use yii\web\IdentityInterface;

class AuthComponent extends Component
{
    public function signIn(IdentityInterface &$model): bool
    {
        if (!$model->validate(['email', 'password'])) {
            return false;
        }

        $user = $this->getUserByEmail($model->email);

        if (!$this->validatePassword($model->password, $user->pwd_hash)) {
            $model->addError('password', 'Неверный логин или пароль');
            return false;
        }

        return \Yii::$app->user->login($user, 3600);
    }

    private function validatePassword($password, $pwd_hash)
    {
        return \Yii::$app->security->validatePassword($password, $pwd_hash);
    }

    private function getUserByEmail($email): Users
    {
        return Users::find()->andWhere(['email' => $email])->one();
    }

    public function signUp(Users &$model): bool
    {
        if (!$model->validate(['email', 'password'])) {
            return false;
        }

        $model->pwd_hash = $this->generatePasswordHash($model->password);
        $model->auth_key = $this->generateAuthKey();

        if ($model->save()) {
            $role = \Yii::$app->rbac->assignUserRole($model); //куда её совать-то?
            return true;
        }

        return false;
    }

    public function generateAuthKey(): string
    {
        return \Yii::$app->security->generateRandomString();
    }

    private function generatePasswordHash(string $password): string
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }
}