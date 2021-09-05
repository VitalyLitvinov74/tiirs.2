<?php


namespace vloop\problems\controllers;

use vloop\problems\entities\forms\criteria\CriteriaIDEntity;
use vloop\problems\entities\forms\criteria\CriteriaProblemsByDates;
use vloop\problems\entities\forms\FormReport;
use vloop\problems\entities\forms\inputed\AddProblemForm;
use vloop\problems\entities\forms\inputed\ChangeStatusProblemForm;
use vloop\problems\entities\forms\inputed\InputsForChangeReport;
use vloop\problems\entities\problem\decorators\ProblemByForm;
use vloop\problems\entities\problem\decorators\ProblemsByDates;
use vloop\problems\entities\problem\ProblemByCriteriaForm;
use vloop\problems\entities\problem\ProblemsSQL;
use vloop\problems\entities\report\ReportByCriteriaForm;
use vloop\problems\entities\report\ReportSQL;
use vloop\problems\entities\report\ReportsSQL;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
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

    public function actionProblems()
    {
        $problems = new ProblemsSQL();
        $problems->all();
    }

    public function actionAddProblem()
    {
        $problems = new ProblemsSQL();
        return $problems
            ->addFromInput(new AddProblemForm())
            ->printYourself();
    }

    public function actionChangeStatus()
    {
        $problem = new ProblemByCriteriaForm(
            new ProblemsSQL(),
            new CriteriaIDEntity()
        );
        return $problem
            ->changeLineData(new ChangeStatusProblemForm())
            ->printYourself();
    }

    public function actionAddReport()
    {
        $reports = new ReportsSQL();
        return $reports
            ->addFromInput(new FormReport())
            ->printYourself();
    }

    public function actionChangeReport()
    {
        $report =
            new ReportByCriteriaForm(
                new ReportsSQL(),
                new CriteriaIDEntity()
            );
        return $report
            ->changeLineData(new InputsForChangeReport())
            ->printYourself();
    }

    public function actionProblemsByDate()
    {
        $problems = new ProblemsByDates(
            new ProblemsSQL(),
            new CriteriaProblemsByDates()
        );
        return $problems->all();
    }
}