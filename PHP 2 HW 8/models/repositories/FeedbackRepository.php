<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Feedback;

class FeedbackRepository extends Repository
{

    protected function getTableName()
    {
        return 'feedback';
    }

    protected function getEntityClass()
    {
        return Feedback::class;
    }
}