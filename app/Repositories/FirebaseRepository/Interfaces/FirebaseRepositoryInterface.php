<?php

namespace App\Repositories\FirebaseRepository\Interfaces;

interface FirebaseRepositoryInterface
{
    // public function get($collection, $limit = null, $orderBy = null, $sortOrder = 'ASC', $whereId = null, $whereArray = null);
    public function get(
        $collection,
        $limit,
        $orderBy,
        $sortOrder,
        $whereId,
        $whereArray,
        $page,
        $searchKeyword
    );
    public function store($collection, $request);
    public function updateSingleDocument($collection, $id, $data);
    public function getDocument($collection, $documentId);
    public function getDocumentById($collection, $documentId);
    public function getDocumentByKeyValue($path, $key, $value);
    public function deleteDocumentById($collection, $documentId);
}
