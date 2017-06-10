<?php

namespace common\components;

use Yii;
use yii\db\ActiveRecord;
use backend\models\PagesModel;

class UrlModel extends ActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_PASSIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'route'], 'required'],
            [['redirect_code', 'redirect', 'status', 'page_id'], 'integer'],
            [['slug', 'route', 'params'], 'string', 'max' => 255],
            [['page_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'route' => 'Route',
            'params' => 'Params',
            'redirect' => 'Redirect',
            'redirect_code' => 'Redirect Code',
            'status' => 'Status',
            'page_id' => 'pageID'
        ];
    }

    public function getPage()
    {
        return $this->hasOne(PagesModel::className(), ['id' => 'page_id']);
    }

    public static function getRoute($route, $params = array(), $status = self::STATUS_ACTIVE)
    {

        return self::find()->where(
                        'route = :ROUTE AND params = :PARAMS AND status = :STATUS', [
                    ':ROUTE' => $route,
                    ':PARAMS' => serialize($params),
                    ':STATUS' => $status
                        ]
                )->one();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (Yii::$app->cache->get($this->slug))
        {
            Yii::$app->cache->set(
                    $this->slug, $this
            );
        }
        else
        {
            Yii::$app->cache->add(
                    $this->slug, $this
            );
        }
    }

    public static function getRouteBySlugWithParams($slug, $params = array(), $status = self::STATUS_ACTIVE)
    {
        return self::find()->where(
                        'slug = :SLUG AND params = :PARAMS AND status = :STATUS', [
                    ':SLUG' => $slug,
                    ':PARAMS' => serialize($params),
                    ':STATUS' => $status
                        ]
                )->one();
    }

    public static function getRouteBySlug($slug, $status = self::STATUS_ACTIVE)
    {
        return self::find()->where(
                        'slug = :SLUG AND status = :STATUS', [
                    ':SLUG' => $slug,
                    ':STATUS' => $status
                        ]
                )->one();
    }

    /* public static function getPageById($id, $status = self::STATUS_ACTIVE)
      {

      return backend\models\
      });
      } */
}
