<?php

namespace App;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseConnection
{
    protected $database;

    public function __construct()
    {
        $this->database = app('firebase.database');
    }

    public function getFirebase()
    {
        return $this->database;
    }
}
