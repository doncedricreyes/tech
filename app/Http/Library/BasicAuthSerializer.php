<?php
namespace App\Http\Library;

use Exception;

/**
 * Authorization String Base64 Serializer
 * 
 * @author zildjian <gtrmergillazildjianl@gmail.com>
 * @since 2020.01.06.
 * 
 */
class BasicAuthSerializer {

    /**
     * Serialized username
     * @var String
     */
    private $sUsername;

    /**
     * Serialized Password
     * @var String
     */
    private $sPassword;

    /**
     * Constructor
     * 
     * @param $sBase64  the string to serialize
     */
    public function __construct($sBase64 = null) {
        if ($sBase64 !== null) {
            $this->extract($sBase64);
        }
    }

    /**
     * Accessor for $sUsername
     * @return String
     */
    public function getUsername() {
        return $this->sUsername;
    }

    /**
     * Accessor for $sPassword
     * @return String
     */
    public function getPassword() {
        return $this->sPassword;
    }

    /**
     * Get the credentials in the form of an array
     * 
     * @return array
     */
    public function getCredentials() {
        return array(
            'username' => $this->sUsername,
            'password' => $this->sPassword
        );
    }

    /**
     * Set the base64 Credentials
     */
    public function setBase64($sBase64) {
        $this->extract($sBase64);
        return $this;
    }

    /**
     * Extract username and password from the base64 string
     */
    private function extract($sBase64) {
        $sString = base64_decode($sBase64);
        $mResult = strpos($sString, ':');
        if ($mResult === false) throw new Exception('Invalid Base64 String');
        $this->sUsername = substr($sString, 0, $mResult);
        $this->sPassword = strlen($sString) === $mResult + 1 ? '' : substr($sString, $mResult + 1);
    }
}