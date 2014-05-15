<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com> 
 */

class CreateAction extends CAction
{
    public $modelClass;
    public $successMessage = false;
    public $errorMessage = false;
    public $useTransaction = true;
    public $viewFile = 'create';
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
    public function run()
    {
        $class = $this->modelClass;
        /** @var SmartActiveRecord $model */
        $model = new $class('create');

        $model->performAjaxValidation();

        if ($model->isPosted) {
            $model->loadPostData();

            if ($model->validate()) {
                if ($this->useTransaction) {
                    $transaction = $model->getDbConnection()->beginTransaction();
                    try {
                        $model->trySave();
                        $transaction->commit();
                    } catch (Exception $e) {
                        $transaction->rollback();
                        if ($this->errorMessage != false)
                            Yii::app()->user->setFlash('error', $this->errorMessage);
                        throw $e;
                    }
                } else {
                    $model->trySave();
                }

                if ($this->successMessage != false)
                    Yii::app()->user->setFlash('success', $this->successMessage);

                $this->redirectHandler->__invoke($model);
            }
        }

        $this->controller->render($this->viewFile, ['model' => $model]);
    }
}