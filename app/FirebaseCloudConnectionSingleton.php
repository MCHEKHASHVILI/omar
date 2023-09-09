<?php

namespace App;

class FirebaseCloudConnectionSingleton
{
    protected static $instance = null;

    protected $firebase;

    private function __construct()
    {
        $this->firebase = app('firebase.storage');
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getFirebaseCloudStorage()
    {
        return $this->firebase;
    }

    public function getSignedUrl($imagePath = "", $expiresAt = "")
    {
        $bucket = $this->getFirebaseCloudStorage()->getBucket();
        $object = $bucket->object($imagePath);

        if ($object->exists()) {
            return $object->signedUrl(new \DateTime($expiresAt));
        }

        return null;
    }
}
