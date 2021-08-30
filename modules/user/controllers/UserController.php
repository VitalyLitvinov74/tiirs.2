<?php


namespace vloop\user\controllers;



use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use vloop\user\entities\forms\decorators\PostForm;
use vloop\user\entities\forms\LoginForm;
use vloop\user\entities\user\decorators\UserIdentity;
use vloop\user\entities\user\decorators\UsersForRest;
use vloop\user\entities\user\decorators\UserStatic;
use vloop\user\entities\user\UsersByIds;
use yii\helpers\VarDumper;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionLogin(){
        $post = new PostForm(
           $form = new LoginForm()
        );
        if($post->validated()){
            $user = new UserStatic(

            );
            $user->login($form->password);
        }
//        $this->layout = '@app/views/layouts/loginPage';
//        return $this->render("login");
        return $form->errors();
    }


}