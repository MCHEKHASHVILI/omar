@extends('layouts.base')

@section('title')
Recipes Listing
@endsection

@section('content')

<section class="menu-container">

    <div class="menu-items row m-0">
        @foreach ($recipes as $key => $card)
        @php
        $url = $card['image_url'];
        $getUrl = (Isop::isKeyExists($card, 'image_url') != "" ? $card['image_url'] : "");
        $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
        @endphp
        <div class="col-md-3 p-1 mt-5">
            <div class="menu-card1">
                <a href="{{ URL(config('constants.TRAININGS.VIDEOS_PATH') . Isop::isKeyExists($card, 'id')) }}">
                    <img src="{{$imageSignedUrl}}" class="menu-img">
                    <h5>{{Isop::isKeyExists($card, 'title')}}</h5>
                    <button class="{{Isop::isKeyExists($card, 'difficulty')}}">{{__('messages.'.Str::lower(Isop::isKeyExists($card, 'difficulty')))}}</button>
                    <div class="time">
                        <p class="minute"><span class="min">{{Isop::isKeyExists($card, 'video_length')}}</span><br>Min</p>
                        <p class="kal"><span class="min">102</span><br>Kcal</p>
                        <img src="{{ asset('assets/images/time-icon.png') }}" class="time-img">
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        {{Isop::customPagination($totalRecords, $searchKeyword, $currentPage, $recordsPerPage, config('constants.TRAININGS.COLLECTION'))}}
    </div>
</section>

@endsection
