<?php
/**
 * Created by PhpStorm.
 * User: 3G
 * Date: 01.08.2019
 * Time: 20:56
 */

namespace app\components;


use yii\base\Component;
use yii\rbac\ManagerInterface;

class RbacComponent extends Component
{
    public function getAuthManager(): ManagerInterface
    {
        return \Yii::$app->authManager;
    }

    public function genRbac()
    {
        $authManager = $this->getAuthManager();
        $authManager->removeAll();

        $admin = $authManager->createRole('admin');
        $admin->description = 'Роль администратора';
        $authManager->add($admin);

        $user = $authManager->createRole('user');
        $user->description = 'Роль пользователя';
        $authManager->add($user);

        $createActivity = $authManager->createPermission('createActivity');
        $createActivity->description = 'Создание событий';
        $authManager->add($createActivity);

        $createViewOwnerActivity = $authManager->createPermission('createViewOwnerActivity');
        $createViewOwnerActivity->description = 'Просмотр и редактирвоание собственных событий';
        $authManager->add($createViewOwnerActivity);

        $createViewAllActivity = $authManager->createPermission('createViewAllActivity');
        $createViewAllActivity->description = 'Просмотр и редактирвоание любых событий';
        $authManager->add($createViewAllActivity);

        $authManager->addChild($user, $createActivity);
        $authManager->addChild($user, $createViewOwnerActivity);
        $authManager->addChild($admin, $user);
        $authManager->addChild($admin, $createViewAllActivity);

        $authManager->assign($admin, 3);
        $authManager->assign($user, 4);
    }

    public function canCreateActivity()
    {
        return \Yii::$app->user->can('createActivity');
    }

    public function canEditViewActivity(Activity $activity)
    {
        if(\Yii::$app->user->can('createViewAllActivity')){
            return true;
        }
    }

}