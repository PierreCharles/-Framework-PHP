<?php
namespace Validation;;

class Validation {

    /*
     * Validate connection
     */
    public static function validateConnection($user, $password) {
        return empty($user) && empty($password) ? false : true;
    }

    /*
     * Verify number
     */
    public static function isInt($nb) {
        return (!filter_var($nb, FILTER_VALIDATE_INT) || empty($nb)) ? false : true;
    }
    /*
     * Verify url
     */
    public static function isUrl($url) {
        return (!filter_var($url, FILTER_VALIDATE_URL) || empty($url)) ? false : true;
    }

    /*
     * Validate register form
     */
    public static function validationRegisterForm($user, $password, $confirm, $captcha) {
        $number = preg_match('@[0-9]@', $password);
        $upper = preg_match('@[A-Z]@', $password);
        $lower = preg_match('@[a-z]@', $password);
        $caraSpecial = preg_match('@[-!$%^&*()_+|~=`{}\[\]:";\'<>?,.\/]@', $user);
        $i = 0;

        /*
         * Verify user name
         */
        if (empty($user)) {
            $errors['user'] = 'Empty user name.';
            $i++;
        }
        if ($caraSpecial || strlen($user) < 3) {
            $errors['user'] = ' Forbidden specials characters ! > 3 characters';
            $i++;
        }
        /*
         *
         * Verify first password
         */
        if (empty($password)) {
            $errors['password'] = 'Invalid password';
            $i++;
        }
        if (!$upper || !$lower || !$number || strlen($password) < 6) {
            $errors['password'] = "1 number, 1 upper, 1 lower and 6 characters minimum !";
            $i++;
        }

        /*
         * Verify confirm password
         */
        if (empty($confirm)) {
            $errors['confirm'] = 'Invalid password.';
            $i++;
        }

        /*
         * Verify equality into two password
         */
        if ($password !== $confirm) {
            $errors['confirm'] = "Invalid password and confirmation password";
            $i++;
        }

        /*
         * Verify captcha with session
         */
       if ($_SESSION['captcha'] != $captcha) {
           $errors['captcha'] = "Invalid Captcha.";
           $i++;
       }
        $errors['nb'] = $i;
        return $errors;
    }

}
?>