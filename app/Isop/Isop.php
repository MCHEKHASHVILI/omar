<?php

namespace App\Isop;

use App\FirebaseCloudConnection;
use App\FirebaseConnection;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use Kreait\Firebase\Facades\FirebaseStorage;
use Google\Cloud\Storage\StorageObject;

class Isop
{


    public function greet()
    {
        echo "Hello, Custom Facade";
    }

    function isKeyExists($array, $key)
    {
        if ($array) {
            $checkKeyExist = array_key_exists($key, $array);
            return ($checkKeyExist ? $array[$key] : "");
        }
    }

    function generateFirebaseMediaUrl($objectName)
    {
        $bucketName = "stagintfitbite.appspot.com";

        // Encode the object name to replace '/' with '%2F'
        $encodedObjectName = rawurlencode($objectName);

        // Replace the encoded '/' back to '/' to maintain the structure of the object name
        // $encodedObjectName = str_replace('%2F', '/', $encodedObjectName);

        // Format the URL
        $url = "https://firebasestorage.googleapis.com/v0/b/{$bucketName}/o/{$encodedObjectName}?alt=media";
        return $url;
    }

    function customPagination($totalRecords, $searchKeyword, $currentPage, $recordsPerPage, $collection)
    {
        $appendSearch = "";
        if ($searchKeyword != "") {
            $appendSearch = '?keyword=' . urlencode($searchKeyword);
        }
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $output = '<div class="col-md-12 mt-3 d-flex justify-content-end" aria-label="..." style="height: 35px;"><ul class="pagination">';

        // Previous button
        if ($currentPage > 1) {
            $output .= '<li class="page-item"><a class="page-link" href="/' . $collection . '/' . ($currentPage - 1) . $appendSearch . '">' . trans('messages.previous') . '</a></li>';
        } else {
            $output .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">' . trans('messages.previous') . '</a></li>';
        }

        // Page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                $output .= '<li class="page-item active"><a class="page-link" href="#">' . $i . ' <span class="sr-only">(current)</span></a></li>';
            } else {
                $output .= '<li class="page-item"><a class="page-link" href="/' . $collection . '/' . $i . $appendSearch . '">' . $i . '</a></li>';
            }
        }

        // Next button
        if ($currentPage < $totalPages) {
            $output .= '<li class="page-item"><a class="page-link" href="/' . $collection . '/' . ($currentPage + 1) . $appendSearch . '">' . trans('messages.next') . '</a></li>';
        } else {
            $output .= '<li class="page-item disabled"><a class="page-link" href="#">' . trans('messages.next') . '</a></li>';
        }

        $output .= '</ul></div>';
        echo $output;
    }

    public function getUserInfo()
    {
    }
}
