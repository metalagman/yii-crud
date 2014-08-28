Yii CRUD Actions
========

### Usage examples

```php
class NewsController extends CController
{
    public $className = 'News';

    public function actions()
    {
        return [
            'create' => [
                'class' => 'vendor.lagman.yii-crud.CreateAction',
                'modelClass' => $this->className,
                'redirectHandler' => function(CActiveRecord $model) {
                    $this->redirect(['view', 'id' => $model->primaryKey]);
                },
            ],
            'update' => [
                'class' => 'vendor.lagman.yii-crud.UpdateAction',
                'modelClass' => $this->className,
                'redirectHandler' => function(CActiveRecord $model) {
                    $this->redirect(['view', 'id' => $model->primaryKey]);
                },
            ],
            'delete' => [
                'class' => 'vendor.lagman.yii-crud.DeleteAction',
                'modelClass' => $this->className,
            ],
            'view' => [
                'class' => 'vendor.lagman.yii-crud.ViewAction',
                'modelClass' => $this->className,
            ],
            'index' => [
                'class' => 'vendor.lagman.yii-crud.IndexAction',
                'modelClass' => $this->className,
            ],
        ];
    }
}
```