<?php

class Company {

    public static function getVar($spec = null) {
        if (array_key_exists($spec, Yii::app()->params->company)) {
            return $spec;
        } else {
            $end = end(Yii::app()->params->company);
            return $end;
            reset(Yii::app()->params->company);
        }
    }

    public static function getInfo($what, $spec = null) {
        if (!Yii::app()->params->company[self::getVar($spec)])
            Logger::error($spec . ' is not part of the "company" set');
        else if (!Yii::app()->params->company[self::getVar($spec)][$what])
            Logger::error($what . ' is not part of ' . $spec);
        else
            return Yii::app()->params->company[self::getVar($spec)][$what];
    }

    public static function getComName($com = null) {
        return self::getInfo('companyName', $com);
    }

    public static function getComURL($com = null) {
        return self::getInfo('companyURL', $com);
    }

    public static function getCR($spec = null) {
        return 'Copyright &copy; ' . date('Y') .
                ' <a href="' . self::getComURL($spec) . '" rel="external">' .
                self::getComName($spec) . '</a>';
    }

}

?>
