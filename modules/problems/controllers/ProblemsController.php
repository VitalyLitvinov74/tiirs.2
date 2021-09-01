<?php


namespace vloop\problems\controllers;


use Symfony\Component\DomCrawler\Form;
use vloop\problems\entities\forms\FormReport;
use vloop\problems\entities\problem\decorators\ProblemById;
use vloop\problems\entities\problem\ProblemsList;
use vloop\problems\entities\report\ReportsList;
use yii\filters\AccessControl;
use yii\rest\Controller;

class ProblemsController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['?'], //на время разработки
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionAddProblem(){
        $form = new Form();
        $problems = new ProblemsList();
        return $problems->addNew($form)->printYourself();
    }

    public function actionProblems()
    {
        $problems = new ProblemsList();
        return $problems->all();
    }

    public function actionAddReport()
    {
        $form = new FormReport();
        $reports = new ReportsList();
        $newReport = $reports->addNew($form);
        return $newReport->printYourself();
    }

    public function changeReport()
    {
        $form = new FormReport();
        $reports = new ReportsList();
        $report = $reports->oneByCriteria(['id' => $form->validatedFields()['id']]);
        $report->changeDescription($form);
        return $report->printYourself();
    }

    public function actionChangeStatus()
    {
        $problem =
            new ProblemById( //может являться NullObject
                $form = new FormReport(),
                new ProblemsList()
            );
        return $problem->changeStatus($form);
    }

    public function actionProblemsByDate()
    {
        //добавить декоратор по датам и вывести.
        $problems = new ProblemsList();
        return $problems->all();
    }
}