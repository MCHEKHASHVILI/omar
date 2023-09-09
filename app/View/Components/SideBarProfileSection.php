<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\FirebaseRepository;
use App\Repositories\FirebaseRepository\FirebaseRepository as FirebaseRepositoryFirebaseRepository;
use App\Repositories\FirebaseRepository\Interfaces\FirebaseRepositoryInterface;
use Illuminate\View\Component;

class SideBarProfileSection extends Component
{
    /**
     * @var FirebaseRepository
     */
    private $firebaseRepository;

    /**
     * Create a new component instance.
     * @param FirebaseRepository $firebaseRepository
     */
    public function __construct(FirebaseRepositoryInterface $firebaseRepository)
    {
        $this->firebaseRepository = $firebaseRepository;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->fetchData();
        return view('components.base.side-bar-profile-section', ['data' => $data]);
    }

    /**
     * Fetch the data for the component.
     *
     * @return array|null
     */
    private function fetchData()
    {
        $encryptedUid = Cookie::get('uid');
        if ($encryptedUid) {
            $documentID = "";
            $getUserDocument = $this->firebaseRepository->getDocumentByKeyValue(config('constants.USERS.COLLECTION'), 'uid', $encryptedUid, true);
            if (!empty($getUserDocument)) {
                $documentID = $getUserDocument[0];
            }

            if ($documentID) {
                return $this->firebaseRepository->getDocument(config('constants.USERS.COLLECTION'), $documentID);
            }
        }


        return null;
    }
}
