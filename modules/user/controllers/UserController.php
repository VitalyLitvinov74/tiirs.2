<?php


namespace vloop\user\controllers;



use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use vloop\user\entities\common\UserException;
use vloop\user\entities\common\ModelErrors;
use vloop\user\entities\forms\CreateForm;
use vloop\user\entities\forms\decorators\PostForm;
use vloop\user\entities\forms\LoginForm;
use vloop\user\entities\user\decorators\IdentityUser;
use vloop\user\entities\user\decorators\RestUser;
use vloop\user\entities\user\decorators\UsersForRest;
use vloop\user\entities\user\decorators\RestUsers;
use vloop\user\entities\user\decorators\StaticUser;
use vloop\user\entities\user\Users;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\helpers\VarDumper;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

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
            return $user->login($form->password);
        }
        return [];
    }

    public function actionCreate(){
        $post = new PostForm(
            $form = new CreateForm()
        );
        if($post->validated()){
            $users = new RestUsers(
                new Users(),
                ['id', 'name']
            );
            return $users->registerNew(
                $form->name,
                $form->login,
                $form->password
            );
        }
        return [];
    }


}