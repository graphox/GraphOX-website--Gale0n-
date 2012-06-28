<?php

class Exc {

    function HTTP($code, $msg) {
        if (isset($code, $msg)) {
            throw new CHttpException($code, $msg);
        } else
            throw new CException('Exc::HTTP($msg); <= $code or $msg missing');
    }

    function Gen($msg) {
        if (isset($msg)) {
            throw new CException($msg);
        } else
            throw new CException('Exc::Gen($msg); <= $msg missing.');
    }

    function DB($msg) {
        if (isset($msg)) {
            throw new CDbException($msg);
        } else
            throw new CException('Exc::DB($msg); <= $msg missing');
    }

}

?>
