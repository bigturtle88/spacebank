<?php

namespace backend\models;

use Yii;
use common\components\UrlModel;
use common\components\SortList;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 */
class PagesModel extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['status', 'parent', 'in_menu'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['parent'], 'default', 'value' => 0]
        ];
    }

    public function getUrl()
    {
        return $this->hasOne(UrlModel::className(), ['page_id' => 'id']);
    }

    public function getSub_pages()
    {
        return $this->hasMany($this::className(), ['parent' => 'id']);
    }

    public function getParent()
    {
        return $this->hasOne($this::className(), ['id' => 'parent']);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->url->delete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','ID'),
            'title' => Yii::t('backend','Title'),
            'content' => Yii::t('backend','Content'),
            'status' => Yii::t('backend','Status'),
            'parent' => Yii::t('backend','Parent'),
            'in_menu' => Yii::t('backend','In menu'),
            //'slug' => Yii::t('backend','Slug'),
            //'route'
        ];
    }

    public static function getList()
    {
        $data = self::find()
                ->select(['id', 'parent', 'title'])
                ->orderBy('parent ASC')
                ->asArray()
                ->all();

        $sort = new SortList([
            'data' => $data,
            'prefix' => '--',
        ]);
        $sortList = ArrayHelper::map($sort->getList(), 'id', 'title');

        return $sortList;
    }

}
