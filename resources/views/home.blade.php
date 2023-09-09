@extends('layouts.base')

@section('title')
Home
@endsection

@section('content')


<section class="menu-container">
    <div>
        <div class="welcome-container">
            <div class="welcome-msg">
                <h1>{{trans('messages.welcome_back')}}</h1>
            </div>

            <x-base.recipe.search />
        </div>

        <div class="picks-reciepe">
            <div class="reciepe-name">
                <h2>{{trans('messages.our_picks_recipe')}}</h2>
            </div>

            <div class="showmore-btn">
                <a class="d-flex" href="{{ URL(config('constants.RECIPES.CATEGORIZED')) }}">
                    <button class="no-wrap">{{trans('messages.show_more')}}</button>
                    <div class="arrow_img_div"><img src="{{ asset('public/assets/images/left-arrow.png') }}" /></div>
                </a>
            </div>
        </div>

        <div class="menu-items scrollable-div">
            <div class="menu-card pt-5">



                @foreach ($recipes as $key => $recipe)
                @php
                $getUrl = (Isop::isKeyExists($recipe, 'image_url') != "" ? $recipe['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);

                $id = (Isop::isKeyExists($recipe, 'id') != "" ? $recipe['id'] : "");

                @endphp
                <div class="col p-1">
                    <div class="menu-card1">
                        <a href="{{ URL(config('constants.RECIPES.VIDEOS_PATH') . $id) }}">
                            <img src="{{$imageSignedUrl}}" class="menu-img">
                           
                            <h5>@if(strlen(Isop::isKeyExists($recipe, 'title')) > 30)
                                    {{\Illuminate\Support\Str::limit(Isop::isKeyExists($recipe, 'title'), 30,'...')}}
                                  @else
                                    {{Illuminate\Support\Str::limit(Isop::isKeyExists($recipe, 'title'), 30,'...')}}
    
                              @endif</h5>
                            <button class="{{Isop::isKeyExists($recipe, 'difficulty')}}">{{Str::upper(Isop::isKeyExists($recipe, 'difficulty'))}}</button>
                            <div class="time">
                                <p class="minute"><span class="min">{{Isop::isKeyExists($recipe, 'video_length')}}</span><br>Min</p>
                                <p class="kal"><span class="min">102</span><br>Kcal</p>
                                <img src="{{ asset('public/assets/images/time-icon.png') }}" class="time-img">
                            </div>
                        </a>
                    </div>
                </div>

                @endforeach


            </div>
        </div>

        <div class="picks-reciepe">
            <div class="reciepe-name">
                <h2>{{trans('messages.our_picks_workouts')}}</h2>
            </div>

            <div class="showmore-btn">
                <a class="d-flex" href="{{ URL('trainings/get/categorized') }}">
                    <button class="no-wrap">{{trans('messages.show_more')}}</button>
                    <div class="arrow_img_div"><img src="{{ asset('public/assets/images/left-arrow.png') }}" /></div>
                </a>
            </div>
        </div>


        <div class="menu-items  scrollable-div">
            <div class="menu-card pt-5">

                @foreach ($trainings as $training)
                @php
                $getUrl = (Isop::isKeyExists($training, 'image_url') != "" ? $training['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                $id = (Isop::isKeyExists($training, 'id') != "" ? $training['id'] : "");
                @endphp
                <div class="col p-1">
                    <div class="menu-card1">
                        <a href="{{ URL(config('constants.TRAININGS.VIDEOS_PATH') . $id) }}">
                            <img src="{{$imageSignedUrl}}" class="menu-img">
                            <h5>{{Isop::isKeyExists($training, 'title')}}</h5>
                            <button class="{{Isop::isKeyExists($training, 'difficulty')}}">{{Str::upper(Isop::isKeyExists($training, 'difficulty'))}}</button>
                            <div class="time">
                                <p class="minute1"><span class="min1">{{Isop::isKeyExists($training, 'video_length')}}</span> Min</p>
                                <p class="kal1"><span class="min1">{{Isop::isKeyExists($training, 'number_workouts')}}</span> Workouts</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
@endsection
