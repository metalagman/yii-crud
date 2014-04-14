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
                'class' => 'ext.yii-crud.CreateAction',
                'modelClass' => $this->className,
            ],
            'update' => [
                'class' => 'ext.yii-crud.UpdateAction',
                'modelClass' => $this->className,
            ],
            'delete' => [
                'class' => 'ext.yii-crud.DeleteAction',
                'modelClass' => $this->className,
            ],
            'view' => [
                'class' => 'ext.yii-crud.ViewAction',
                'modelClass' => $this->className,
            ],
            'index' => [
                'class' => 'ext.yii-crud.crud.IndexAction',
                'modelClass' => $this->className,
            ],
        ];
    }
}
```