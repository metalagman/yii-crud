<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

class ViewAction extends CAction
{
    public $modelClass;
    public $viewFile = 'view';

    /**
     * @inheritdoc
     */
    public function run($id)
    {
        $class = $this->modelClass;
        /** @var SmartActiveRecord $model */
        $model = $class::loadModel($id);
        $this->controller->render($this->viewFile, ['model' => $model]);
    }
}