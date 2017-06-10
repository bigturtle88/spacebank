<?php

namespace console\models;

use Yii;
use common\models\Certificate;
use yii\base\Model;

class CertificateGenerator extends Certificate {


    public function AddCertificates($val)
    {
        $certificate = new Certificate();
        foreach( $val as $k => $v ){
          $certificate->$k = $v;  
        }
        return $certificate->save() ? true : false;
    }
    
    public function RemoveCertificates($conditions)
    {
       return Certificate::deleteAll($conditions) ? true : false;
    }

}
