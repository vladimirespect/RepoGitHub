<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Gallery;

class GalleryRepository extends Repository
{

    protected function getTableName()
    {
        return 'gallery';
    }

    protected function getEntityClass()
    {
        return Gallery::class;
    }
}