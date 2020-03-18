<?php

use app\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch2 */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дерево категорий';
$this->params['breadcrumbs'][] = $this->title;
?>

<pre><?php print_r($items)?></pre>

<?php echo yii2mod\tree\Tree::widget([
    'items' => $items,
    'clientOptions' => [
        'autoCollapse' => true,
        'clickFolderMode' => 3,
        'activate' => new \yii\web\JsExpression('
                        function(node, data) {
                              node  = data.node;
                              // Log node title
                              console.log(node.title);
                        }
                '),
    ],
]);



