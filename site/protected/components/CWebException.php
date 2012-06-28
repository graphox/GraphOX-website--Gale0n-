<?php

/**
 * CHttpException class file.
 *
 * @author Aaron <aaron@graphox.us>
 * @link http://graphox.us/
 * @copyright Copyright &copy; 2008-2011 GraphOX
 */

/**
 * WebException represents an exception caused by invalid operations of end-users.
 *
 * The HTTP error code can be obtained via {@link statusCode}.
 * Error handlers may use this status code to decide how to format the error page.
 *
 * @author Aaron <aaron@graphox.us>
 * @version $Id: WebException.php 2799 2011-01-01 19:31:13Z aaron $
 * @package system.protected.exceptions
 * @since 1.0
 */
class CWebException extends CException {

    /**
     * @var integer HTTP status code, such as 403, 404, 500, etc.
     */
    public $statusCode;

    /**
     * Constructor.
     * @param integer $status HTTP status code, such as 404, 500, etc.
     * @param string $message error message
     * @param integer $code error code
     */
    public function __construct($message = null) {
        parent::__construct($message);
    }

}

?>
