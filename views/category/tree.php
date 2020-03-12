<?php

use app\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дерево категорий';
$this->params['breadcrumbs'][] = $this->title;
?>

<pre><?php ?></pre>

<?php

try {
    echo \wbraganca\fancytree\FancytreeWidget::widget([
        'options' => [
            'source' => $data,
            'extensions' => ['dnd'],
            'dnd' => [
                'preventVoidMoves' => true,
                'preventRecursiveMoves' => true,
                'autoExpandMS' => 400,
                'dragStart' => new JsExpression('function(node, data) {
                    return true;
                }'),
                'dragEnter' => new JsExpression('function(node, data) {
                    return true;
                }'),
                'dragDrop' => new JsExpression('function(node, data) {
                    data.otherNode.moveTo(node, data.hitMode);
                }'),
            ],
        ]
    ]);
} catch (Exception $e) {
}



