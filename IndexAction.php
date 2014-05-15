<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

class IndexAction extends CAction
{
    public $modelClass;
    public $viewFile = 'index';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $class = $this->modelClass;
        /** @var SmartActiveRecord $model */
        $model = new $class('search');
        $model->unsetAttributes();

        if ($params = Yii::app()->request->getParam($this->modelClass))
            $model->attributes = $params;

        $this->controller->render($this->viewFile, array(
            'model' => $model,
        ));
    }
}