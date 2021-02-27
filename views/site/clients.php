<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hash_id',
            'age',
            'name',
            'city',
            [
                'attribute' => 'phones',
                'value' => function ($model) {
                    return Html::a($model->getPhones(), '#',[
                            'data-toggle'=>'modal',
                            'data-target'=>'#exampleModal',
                        'onclick' => '(function ( $event ) { 
                    $.ajax({
                        url: "'.Url::to('phones').'",
                        type: "post",
                        data: {id:'.$model->id.',"'.Yii::$app->request->csrfParam.'":"'.Yii::$app->request->getCsrfToken().'"},
                        success: function(data){
                            $(".modal-body").html(data);
                          }
                    }); })();'
                    ]);
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
