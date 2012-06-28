<?php

class Logger {

    public static $_error = '';

    public static function UserIP() {
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "UNKNOWN";

        return $ip;
    }

    public static function email($subj, $msg, $from = null, $name = null, $to = null) {
        $mail = new YiiMailMessage();

        if (isset($from, $name)) {
            if (isset($to)) {
                $user = Users::model()->find('LOWER(user_mail)=?', array($to));
                $mail->setTo(array($to => $user->user_name));
            } else {
                $mail->setTo(array(Yii::app()->params['webAdminEmail'] => 'Web Admin'));
            }
            $mail->setFrom(array($from => $name));
        } else {
            if (isset($to)) {
                $user = Users::model()->find('LOWER(user_mail)=?', array($to));
                $mail->setTo(array($to => $user->user_name));
            } else {
                $mail->setTo(array(Yii::app()->params['webAdminEmail'] => 'Web Admin'));
            }
            $mail->setFrom(array(Yii::app()->params['adminEmail'] => 'Admin'));
        }
        $mail->setSubject($subj);
        $mail->setBody($msg, 'text/html','utf-8');

        if (!Yii::app()->mail->send($mail)) {
            return false;
        }
        return true;
    }

    private static function logThis($msg, $calledBy, $error = null, $file = null) {

        // open log file
        $fd = fopen(__dir__ . '/../runtime/' . (!$error ? (!$file ? 'messages.log' : $file . '.log') : 'error.log'), "a");
        if (!$fd) {
            self::$_error = 'could not open log file';
            return false;
        }
        // write log message
        $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg . $calledBy;
        fwrite($fd, $str . "\n");
        // close log file
        fclose($fd);
        // email webadmin on error
        if ($error):
            if (!self::email('[ WARNING ] Error on website!', $str)) {
                self::$_error = 'could not email admin';
                return false;
            }
        endif;
        return true;
    }

    public static function error($msg) {
        $trace = debug_backtrace();
        if (isset($trace[1])) {
            $caller = "\n      Called by {$trace[1]['class']}::{$trace[1]['function']}";
        }
        if (!self::logThis($msg, $caller, true)) {
            Exc::gen('Could not log: ' . self::$_error);
        }
    }

    public static function log($msg) {
        $trace = debug_backtrace();
        if (isset($trace[1])) {
            $caller = "(called by {$trace[1]['class']}::{$trace[1]['function']}";
        }
        if (!self::logThis($msg, $caller))
            Exc::gen('Could not log: ' . self::$_error);
    }

}

?>
