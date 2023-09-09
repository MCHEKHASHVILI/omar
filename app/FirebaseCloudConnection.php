<?php

namespace App;

class FirebaseCloudConnection
{
    protected $firebase;

    public function __construct()
    {
        $this->firebase = app('firebase.storage');
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
