<?php

namespace common\components;

use yii\base\Object;

class SortList extends Object {

    public $data;
    public $prefix = '--';

    protected function getPath($category_id, $prefix = false)
    {
        foreach ($this->data as $item)
        {
            if ($category_id == $item['id'])
            {
                $prefix = $prefix ? $this->prefix . $prefix : $item['title'];
                if ($item['parent'])
                {
                    return $this->getPath($item['parent'], $prefix);
                }
                else
                {
                    return $prefix;
                }
            }
        }
        return '';
    }

    public function getList($parent_id = 0)
    {
        $data = [];

        foreach ($this->data as $item)
        {
            if ($parent_id == $item['parent'])
            {
                $data[] = [
                    'id' => $item['id'],
                    'title' => $this->getPath($item['id'])
                ];
                $data = array_merge($data, $this->getList($item['id']));
            }
        }
        return $data;
    }

}
