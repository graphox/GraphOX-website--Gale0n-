<?php

class Security {

    const salt = '9dJW5mht';

    public static function hash($what, $hash = null) {
        if (!$what) {
            Exc::Gen('Nothing to hash');
        } else {
            return hash(!$hash ? 'ripemd320' : $hash, self::salt . $what);
        }
    }

}

?>
