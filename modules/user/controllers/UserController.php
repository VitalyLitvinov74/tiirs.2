<?php


namespace vloop\user\controllers;



use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use vloop\user\entities\forms\decorators\PostForm;
use vloop\user\entities\forms\LoginForm;
use vloop\user\entities\user\decorators\IdentityUser;
use vloop\user\entities\user\decorators\RestUser;
use vloop\user\entities\user\decorators\UsersForRest;
use vloop\user\entities\user\decorators\RestUsers;
use vloop\user\entities\user\decorators\StaticUser;
use vloop\user\entities\user\Users;
use yii\helpers\VarDumper;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionLogin(){
        $post = new PostForm(
           $form = new LoginForm()
        );
        if($post->validated()){
            $users = new RestUsers(
                new Users(),
                ['id', 'name', 'access_token']
            );
            $user = $users->oneByCriteria(['login'=>$form->login]);
            if($user->notGuest() and $user->login($form->password)){ //если не залогинит выкинет exception
                return $user->printYourself();
            }
        }
        return $form->errors();
    }


}