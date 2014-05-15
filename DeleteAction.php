<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com> 
 */

class DeleteAction extends CAction
{
    public $modelClass;
    public $successMessage = false;
    public $errorMessage = false;
    /** @var Closure */
    public $redirectHandler;

    /**
     * @inheritdoc
     */
    public function __construct($controller,$id)
    {
        parent::__construct($controller, $id);

        if (!$this->redirectHandler instanceof Closure)
            $this->redirectHandler = function(CActiveRecord $model) {
                $this->controller->redirect(['index']);
            };
    }

    /**
     * @inheritdoc
     */
    public function run($id)
    {
        $class = $this->modelClass;
        $model = $class::loadModel($id);
        $success = false;

        $transaction = $model->dbConnection->beginTransaction();
        try {
            $success = $model->delete();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            if (defined(YII_DEBUG))
                throw $e;
        }

        if (!Yii::app()->request->isAjaxRequest) {
            if ($success) {
                if ($this->successMessage != false)
                    Yii::app()->user->setFlash('success', $this->successMessage);
            } else {
                if ($this->errorMessage != false)
                    Yii::app()->user->setFlash('error', $this->errorMessage);
            }

            $this->redirectHandler->__invoke($model);
        }
    }
}