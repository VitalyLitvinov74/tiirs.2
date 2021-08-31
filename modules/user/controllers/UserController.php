<?php


namespace vloop\user\controllers;


use http\Exception\InvalidArgumentException;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use vloop\user\entities\forms\CreateUserForm;
use vloop\user\entities\forms\decorators\PostForm;
use vloop\user\entities\forms\LoginForm;
use vloop\user\entities\user\decorators\IdentityUser;
use vloop\user\entities\user\decorators\RestUser;
use vloop\user\entities\user\decorators\RestUsers;
use vloop\user\entities\user\decorators\StaticUser;
use vloop\user\entities\user\Guest;
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
    public function actionLogin()
    {
        $post = new PostForm(
            $form = new LoginForm()
        );
        if ($post->validated()) {
            $users = new RestUsers(
                new Users(),
                ['id', 'name', 'access_token', 'errors'] //белый список полей которые можно возвращать
            );
            $user = $users->oneByCriteria(['login' => $form->login]);
            return $user->login($form->password);
        }
        return (new Guest($form->errors))->printYourself();
    }

    public function actionCreate()
    {
        $post = new PostForm(
            $form = new CreateUserForm()
        );

        if ($post->validated()) {
            $users = new RestUsers(
                new Users(),
                ['id', 'name', 'login', 'errors']
            );
            return $users
                ->registerNew(
                    $form->name,
                    $form->login,
                    $form->password
                )->printYourself();
        }
        return (new Guest($form->errors))->printYourself();
    }


}