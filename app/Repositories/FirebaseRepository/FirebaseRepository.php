<?php

namespace App\Repositories\FirebaseRepository;

use App\FirebaseCloudConnection;
use App\FirebaseConnection;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use Carbon\Carbon;
use Google\Rpc\Context\AttributeContext\Request;
use Illuminate\Support\Arr;

/*
 * Filename: d:\laragon\www\FitBite_website\app\Repositories\FirebaseRepository\FirebaseRepository.php
 * Path: d:\laragon\www\FitBite_website
 * Created Date: Friday, June 16th 2023, 2:45:15 pm
 * Author: Ghulam Rasool
 *
 * Copyright (c) 2023 Your Company
 */


class FirebaseRepository implements FirebaseRepositoryInterface
{

    protected $firebaseConnection;
    protected $firebaseCloudStorage;

    public function __construct(FirebaseConnection $firebaseConnection, FirebaseCloudConnection $firebaseCloudConnection)
    {
        $this->firebaseConnection = $firebaseConnection->getFirebase();
        $this->firebaseCloudStorage = $firebaseCloudConnection->getFirebaseCloudStorage();
    }

    //* collection variable is to pass collection name for Firebase
    /*    public function get($collection, $limit = null, $orderBy = null, $sortOrder = 'ASC', $whereId = null, $whereArray = null)
    {
        $query = $this->firebaseConnection->getReference($collection);

        // Apply the orderBy clause if provided
        if ($orderBy !== null) {
            // $query = $query->orderByChild($orderBy);
        }

        // Apply the whereId clause if provided
        if ($whereId !== null) {
            $query = $query->equalTo($whereId);
        }

        // Apply the whereArray clauses if provided
        if ($whereArray !== null && is_array($whereArray)) {
            foreach ($whereArray as $field => $condition) {
                $operator = $condition['operator'];
                $value = $condition['value'];

                switch ($operator) {
                    case 'startsWith':
                        $query = $query->orderByChild($field)->startAt($value)->endAt($value . "\uf8ff");
                        break;
                    case 'endsWith':
                        $query = $query->orderByChild($field)->startAt("\uf8ff" . $value)->endAt($value);
                        break;
                    case 'equals':
                        $query = $query->orderByChild($field)->equalTo($value);
                        break;
                    case 'contains':
                        $filteredData = [];
                        $snapshot = $query->getSnapshot();
                        $data = $snapshot->getValue();

                        foreach ($data as $record) {
                            if (stripos($record[$field], $value) !== false) {
                                $filteredData[] = $record;
                            }
                        }

                        return $filteredData;

                        break;
                        // Add more cases for other operators as needed
                }
            }
        }

        $snapshot = $query->getSnapshot();
        $data = $snapshot->getValue();

        // Reverse the order if sort order is 'DESC'
        if (strtoupper($sortOrder) === 'DESC') {
            $data = array_reverse($data);
        }

        // Apply the limit clause if provided
        if ($limit !== null) {
            $data = array_slice($data, 0, $limit);
        }

        return $data;
    } */


    public function get(
        $collection,
        $limit = null,
        $orderBy = null,
        $sortOrder = 'ASC',
        $whereId = null,
        $whereArray = null,
        $page = null,
        $searchKeyword = null
    ) {
        $query = $this->firebaseConnection->getReference($collection);

        // Apply the orderBy clause if provided
        if (
            $orderBy !== null
        ) {
            // $query = $query->orderByChild($orderBy);
        }

        // Apply the whereId clause if provided
        if ($whereId !== null) {
            $query = $query->equalTo($whereId);
        }

        // Apply the whereArray clauses if provided
        if ($whereArray !== null && is_array($whereArray)) {
            foreach ($whereArray as $field => $condition) {
                $operator = $condition['operator'];
                $value = $condition['value'];

                switch ($operator) {
                    case 'startsWith':
                        $query = $query->orderByChild($field)->startAt($value)->endAt($value . "\uf8ff");
                        break;
                    case 'endsWith':
                        $query = $query->orderByChild($field)->startAt("\uf8ff" . $value)->endAt($value);
                        break;
                    case 'equals':
                        $query = $query->orderByChild($field)->equalTo($value);
                        break;
                    case 'contains':
                        $filteredData = [];
                        $snapshot = $query->getSnapshot();
                        $data = $snapshot->getValue();

                        foreach ($data as $record) {
                            if (stripos($record[$field], $value) !== false) {
                                $filteredData[] = $record;
                            }
                        }

                        return $filteredData;

                        break;
                        // Add more cases for other operators as needed
                }
            }
        }

        $snapshot = $query->getSnapshot();
        $data = $snapshot->getValue();

        // If a search keyword is provided, filter the data
        if (
            $searchKeyword !== null
        ) {
            $data = array_filter($data, function ($item) use ($searchKeyword) {
                // Adjust the field name as per your data structure
                return stripos($item['field_name'], $searchKeyword) !== false;
            });
        }

        // Reverse the order if sort order is 'DESC'
        if (strtoupper($sortOrder) === 'DESC') {
            $data = array_reverse($data);
        }


        // Apply the limit and offset for pagination if provided
        if (
            $limit !== null && $page !== null
        ) {
            $offset = ($page - 1) * $limit;
            $data = array_slice($data, $offset, $limit);
        }

        return $data;
    }

    //* to store data into collection with increment
    public function store($collection, $request)
    {
        $newId = $this->getLastId($collection);
        $data = array_merge($request, [
            'id' => $newId,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => '',
            'deleted_at' => ''
        ]);
        //! insert the document into collection
        $this->firebaseConnection->getReference($collection)->push($data);
        // Update the last assigned ID
        return $newId;
    }


    public function updateSingleDocument($collection, $id, $data)
    {
        try {
            $this->firebaseConnection->getReference($collection . '/' . $id)->update($data);
            return true;
        } catch (\Exception $e) {
            // Log the exception
            error_log($e);
            return false;
        }
    }


    public function getDocument($collection, $documentId)
    {
        try {
            $snapshot = $this->firebaseConnection
                ->getReference($collection . '/' . $documentId)
                ->getSnapshot();

            if ($snapshot->exists()) {
                return $snapshot->getValue();
            } else {
                // Document doesn't exist
                return null;
            }
        } catch (\Exception $e) {
            // Log the exception
            error_log($e);
            return null;
        }
    }


    public function getDocumentById($collection, $documentId)
    {
        try {
            $query = $this->firebaseConnection
                ->getReference($collection)
                ->orderByChild('id')  // Replace 'id' with the field name of your document id
                ->equalTo((int)$documentId);

            $snapshot = $query->getSnapshot();

            if ($snapshot->exists()) {
                // getSnapshot will return an array of matches, so we get the first one.
                // Assumes documentId is unique, or that returning the first match is acceptable
                return array_values($snapshot->getValue())[0];
            } else {
                // Document doesn't exist
                return null;
            }
        } catch (\Exception $e) {
            // Log the exception
            error_log($e);
            return null;
        }
    }


    public function deleteDocumentById($collection, $documentId)
    {
        try {
            $this->firebaseConnection->getReference($collection . '/' . $documentId)->remove();
            return true;
        } catch (\Exception $e) {
            // Log the exception
            error_log($e);
            return false;
        }
    }

    public function getDocumentByKeyValue($collection, $key, $value, $onlyKey = false)
    {
        $reference = $this->firebaseConnection->getReference($collection)
            ->orderByChild($key)
            ->equalTo($value)
            ->getSnapshot();

        if ($reference->exists()) {
            $result = $reference->getValue();
            if ($onlyKey) {
                return array_keys($result);
            } else {
                return $result;
            }
        }

        return null;
    }




    // Below functions are only helper functions for firebase queries
    //* get last submitted number from last_id key value
    private function getLastId($collection)
    {

        $snapshot = $this->firebaseConnection
            ->getReference($collection)
            ->orderByKey()
            // ->limitToLast(1)
            ->getSnapshot();

        $lastChild = $snapshot->getChild($snapshot->numChildren());

        if ($lastChild !== null) {
            return $lastChild->getKey() + 1;
        }

        return 0;
    }
}
