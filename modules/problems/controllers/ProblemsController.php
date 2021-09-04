<?php


namespace vloop\problems\controllers;


use Symfony\Component\DomCrawler\Form;
use vloop\problems\entities\forms\AddProblemForm;
use vloop\problems\entities\forms\ChangeReportForm;
use vloop\problems\entities\forms\FormReport;
use vloop\problems\entities\problem\decorators\ProblemByForm;
use vloop\problems\entities\problem\ProblemsSQL;
use vloop\problems\entities\report\ReportsByCriteriaForm;
use vloop\problems\entities\report\ReportSQL;
use vloop\problems\entities\report\ReportsSQL;
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
        $form = new AddProblemForm();
        $problems = new ProblemsSQL();
        return $problems
            ->addFromInputForm($form)
            ->printYourself();
    }

    public function actionProblems()
    {
        $problems = new ProblemsSQL();
        return $problems->all();
    }

    public function actionAddReport()
    {
        $form = new FormReport();
        $reports = new ReportsSQL();
        return  $reports
            ->addFromInputForm($form)
            ->printYourself();
    }

    public function actionChangeReport()
    {
        $report = new ReportsByCriteriaForm(
            new ReportsSQL(),
            $inputData = new ChangeReportForm()
        );
        return $report
            ->changeDescription($inputData)
            ->printYourself();
    }

    public function actionChangeStatus()
    {
        $problems = new ProblemsSQL();
        return $problem
            ->changeStatus($form)
            ->printYourself();
    }

    public function actionProblemsByDate()
    {
        //добавить декоратор по датам и вывести.
        $problems = new ProblemsSQL();
        return $problems->all();
    }
}