<?php


use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дерево категорий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col">
<pre><?php //print_r($data);?></pre>

<?php echo \wbraganca\fancytree\FancytreeWidget::widget([
	'options' =>[
		'source' => $data,
		'extensions' => ['dnd'],
		'dnd' => [
			'preventVoidMoves' => true,
			'preventRecursiveMoves' => true,
			'autoExpandMS' => 400,
			'dragStart' => new JsExpression('function(node, data) {
				return false;
			}'),
			'dragEnter' => new JsExpression('function(node, data) {
				return false;
			}'),
			'dragDrop' => new JsExpression('function(node, data) {
				data.otherNode.moveTo(node, data.hitMode);
			}'),
		],
        'activate' => new \yii\web\JsExpression('function(event, data) {
                              $("#cat-info .box-header>h3").text(data.node.title);
                              $("#cat-info .box-body").text(data.node.key);
                        }'),
        ],
    ]);
?>
    </div>
    <div class = "col">
        <h3>Информация о выбранной категории:</h3>
        <div class = "box box-primary" id="cat-info">
            <div class = "box-header with-border">
                <h3 class = "box-title"></h3>
                <div class = "box-body"> </div>
            </div>
        </div>
    </div>
</div>



