@extends('layouts.base')

@section('title')
Search Recipies/Trainings
@endsection

@section('content')
<section class="menu-container">
    <div class="welcome-container">
        <div class="d-flex">
            <div class="search-filter">
                <span>{{trans('messages.filters')}}:</span>
    
                <?php
                $arrayFilter = array();
                foreach ($cards as $key => $card) {
                    $category = Isop::isKeyExists($card, 'category');

                    if (!in_array($category, $arrayFilter)) {
                        array_push($arrayFilter, $category);
                    }
                }
                ?>
                <select class="filter-dropdown">
                    @foreach($arrayFilter as $filter)
                    <option>{{$filter}}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-filter ml-3">
                <span>{{trans('messages.filters')}}:</span>
                <select class="filter-dropdown">
                    <option>Recipe Videos</option>
                    <option>Workout Videos</option>
                </select>
            </div>
        </div>


        <x-search-component :query="$keyword" />

    </div>

    <div class="menu-items row m-0">
        @foreach ($cards as $key => $card)
        @php

        $url = $card['image_url'];
        $cardType = "";
        $cardTypeVideoURL = "";
        if(strpos($url, 'recipes') !== false){
        $cardTypeVideoURL = config('constants.RECIPES.VIDEOS_PATH');
        $cardType = config('constants.RECIPES.COLLECTION');
        }else{
        $cardTypeVideoURL = config('constants.TRAININGS.VIDEOS_PATH');
        $cardType = config('constants.TRAININGS.COLLECTION');
        }


        $getUrl = (Isop::isKeyExists($card, 'image_url') != "" ? $card['image_url'] : "");
        $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
        @endphp
        <div class="col-md-3 p-1 mt-5">
            <div class="menu-card1">
                <a href="{{ URL($cardTypeVideoURL. Isop::isKeyExists($card, 'id')) }}">
                    <img src="{{$imageSignedUrl}}" class="menu-img">
                    <h5>{{Isop::isKeyExists($card, 'title')}}</h5>
                    <button class="{{Isop::isKeyExists($card, 'difficulty')}}">{{Str::upper(Isop::isKeyExists($card, 'difficulty'))}}</button>
                    <button class="">{{ Str::upper($cardType) }}</button>
                    <div class="time">
                        <p class="minute"><span class="min">{{Isop::isKeyExists($card, 'video_length')}}</span><br>Min</p>
                        <p class="kal"><span class="min">102</span><br>Kcal</p>
                        <img src="{{ asset('assets/images/time-icon.png') }}" class="time-img">
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="pagination-wrap">
        <ul class="pagination">
            @include('layouts.partials.pagination')
            
        </ul>
    </div>
    

</section>
@endsection