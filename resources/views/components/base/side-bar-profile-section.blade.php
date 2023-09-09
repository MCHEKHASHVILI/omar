@php

$getUrl = (Isop::isKeyExists($data, 'profile_img_url') != "" ? $data['profile_img_url'] : "");
$imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);

@endphp
<div class="image-upload">
    <label for="file-input">
        <img class="profile-image rounded-circle" src="{{ ($getUrl != '' ? $imageSignedUrl : asset('assets/images/fileinput.png')) }}" />
    </label>
    <input id="file-input" type="file" />
    <p class="file-name first_name">{{ $data['first_name'] ?? '' }}</p>
    <p class="file-membership"><a href="{{ URL('profile') }}" style="text-decoration:none;">Go Premium</a></p>
</div>