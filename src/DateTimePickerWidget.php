<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 5/24/15
 * Time: 10:48
 */

namespace huijiewei\datetimepicker;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\AssetBundle;
use yii\widgets\InputWidget;

class DateTimePickerWidget extends InputWidget
{
    public $clientOptions = [];

    /* @var $_assetBundle AssetBundle */
    private $_assetBundle;

    public function init()
    {
        parent::init();

        $this->options = ArrayHelper::merge([
            'class' => 'form-control',
        ], $this->options);

        $this->clientOptions = ArrayHelper::merge([
            'language'    => 'zh-CN',
            'fontAwesome' => true,
            'autoclose'   => 'true',
            'todayBtn'    => true,
        ], $this->clientOptions);

        $this->registerAssetBundle();
        $this->registerLanguage();

        $this->registerScript();
    }

    public function run()
    {
        $html = '<div class="input-group">';

        if ($this->hasModel()) {
            $html .= Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $html .= Html::textInput($this->name, $this->value, $this->options);
        }
        $html .= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
        $html .= '</div>';

        return $html;
    }

    public function registerLanguage()
    {
        if (!isset($this->clientOptions['language']) || empty($this->clientOptions['language'])) {
            return;
        }

        $langAsset = 'js/locales/bootstrap-datetimepicker.' . $this->clientOptions['language'] . '.js';

        if (file_exists(\Yii::getAlias($this->_assetBundle->sourcePath . DIRECTORY_SEPARATOR . $langAsset))) {
            $this->_assetBundle->js[] = $langAsset;
        }
    }

    public function registerScript()
    {
        $clientOptions = Json::encode($this->clientOptions);

        $js = <<<EOD
        $('#{$this->id}').datetimepicker({$clientOptions});
EOD;

        $this->getView()->registerJs($js);
    }

    public function registerAssetBundle()
    {
        $this->_assetBundle = DateTimePickerAsset::register($this->getView());
    }

    public function getAssetBundle()
    {
        if (!($this->_assetBundle instanceof AssetBundle)) {
            $this->registerAssetBundle();
        }

        return $this->_assetBundle;
    }
}
