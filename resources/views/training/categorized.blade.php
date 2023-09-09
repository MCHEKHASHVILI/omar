@extends('layouts.base')

@section('title')
Workouts
@endsection

@section('content')



<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<section class="menu-container">
    <div class="welcome-container">
        <div class="reciepe-name">
            <h2>{{trans('messages.our_picks_workouts')}}</h2>
        </div>

        <x-base.recipe.search />
    </div>

    <div class="row mt-5">
        <div class="MultiCarousel pt-5" data-items="1,3,4,5" data-slide="1" id="MultiCarousel" data-interval="1000">
            <div class="MultiCarousel-inner">




                @foreach ($trainings as $key => $training)
                @php

                $url = $training['image_url'];
                $cardType = "";
                $cardTypeVideoURL = "";
                if(strpos($url, 'recipes') !== false){
                $cardTypeVideoURL = config('constants.RECIPES.VIDEOS_PATH');
                $cardType = config('constants.RECIPES.COLLECTION');
                }else{
                $cardTypeVideoURL = config('constants.TRAININGS.VIDEOS_PATH');
                $cardType = config('constants.TRAININGS.COLLECTION');
                }

                $getUrl = (Isop::isKeyExists($training, 'image_url') != "" ? $training['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                @endphp


                <div class="item col-md-3">
                    <div class="p-1">
                        <div class="menu-card1 mb-3">
                            <a href="{{ URL($cardTypeVideoURL. Isop::isKeyExists($training, 'id')) }}">
                                <img src="{{$imageSignedUrl}}" class="menu-img">
                                <h5>{{Isop::isKeyExists($training, 'title')}}</h5>
                                <button>{{__('messages.'.Str::lower(Isop::isKeyExists($training, 'difficulty')))}}</button>
                                <div class="time">
                                    <p class="minute"><span class="min">{{Isop::isKeyExists($training, 'video_length')}}</span><br>Min</p>
                                    <p class="kal1"><span class="min1">6</span> Workouts</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
            <button class="btn btn-primary leftLst">
                < </button>
                    <button class="btn btn-primary rightLst">></button>
        </div>
    </div>


    <div class="row mt-5">
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="reciepe-name">
                    <h2>{{trans('messages.chest')}}</h2>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <span class="custom_btn easy chest-filter" data-target="chest-easy">{{trans('messages.easy')}}</span>
                <span class="custom_btn intermediate chest-filter" data-target="chest-intermediate">{{trans('messages.intermediate')}}</span>
                <span class="custom_btn hard chest-filter" data-target="chest-hard">{{trans('messages.advanced')}}</span>
                <span class="custom_btn all chest-filter" data-target="chest-all">{{trans('messages.all')}}</span>
            </div>
        </div>
        <div class="menu-items scrollable-div mb-5">
            <div class="menu-card" style="overflow: hidden;">


                @foreach ($chest as $key => $value)
                @php
                $getUrl = (Isop::isKeyExists($value, 'image_url') != "" ? $value['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                @endphp

                <div class="col-md-3 pt-5 chest-box" data-status="{{ Str::lower(Isop::isKeyExists($value, 'category')) . '-' . Str::lower(Isop::isKeyExists($value, 'difficulty')) }}">
                    <div class="menu-card1 mb-3">
                        <a href="{{ URL($cardTypeVideoURL. Isop::isKeyExists($value, 'id')) }}">
                            <img src="{{$imageSignedUrl}}" class="menu-img">
                            <h5>{{Isop::isKeyExists($value, 'title')}}</h5>
                            <button>{{__('messages.'.Str::upper(Isop::isKeyExists($value, 'difficulty')))}}</button>
                            <div class="time">
                                <p class="minute"><span class="min">{{Isop::isKeyExists($value, 'video_length')}}</span><br>Min</p>
                                <p class="kal1"><span class="min1">6</span> Workouts</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach



            </div>
        </div>

        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="reciepe-name">
                    <h2>{{trans('messages.biceps')}}</h2>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <span class="custom_btn easy biceps-filter" data-target="biceps-easy">{{trans('messages.easy')}}</span>
                <span class="custom_btn intermediate biceps-filter" data-target="biceps-intermediate">{{trans('messages.intermediate')}}</span>
                <span class="custom_btn hard biceps-filter" data-target="biceps-hard">{{trans('messages.advanced')}}</span>
                <span class="custom_btn all biceps-filter" data-target="biceps-all">{{trans('messages.all')}}</span>
            </div>
        </div>
        <div class="menu-items scrollable-div mb-5">
            <div class="menu-card" style="overflow: hidden;">

                @foreach ($biCeps as $key => $value)
                @php
                $getUrl = (Isop::isKeyExists($value, 'image_url') != "" ? $value['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                @endphp


                <div class="col-md-3 pt-5 biceps-box" data-status="{{ Str::lower(Isop::isKeyExists($value, 'category')) . '-' . Str::lower(Isop::isKeyExists($value, 'difficulty')) }}">
                    <div class="menu-card1 mb-3">
                        <a href="{{ URL($cardTypeVideoURL. Isop::isKeyExists($value, 'id')) }}">
                            <img src="{{$imageSignedUrl}}" class="menu-img">
                            <h5>{{Isop::isKeyExists($value, 'title')}}</h5>
                            <button>{{__('messages.'.Str::upper(Isop::isKeyExists($value, 'difficulty')))}}</button>
                            <div class="time">
                                <p class="minute"><span class="min">{{Isop::isKeyExists($value, 'video_length')}}</span><br>Min</p>
                                <p class="kal1"><span class="min1">6</span> Workouts</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="reciepe-name">
                    <h2>{{trans('messages.six_pack')}}</h2>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <span class="custom_btn easy six-pack-filter" data-target="six-pack-easy">{{trans('messages.easy')}}</span>
                <span class="custom_btn intermediate six-pack-filter" data-target="six-pack-intermediate">{{trans('messages.intermediate')}}</span>
                <span class="custom_btn hard six-pack-filter" data-target="six-pack-hard">{{trans('messages.advanced')}}</span>
                <span class="custom_btn all six-pack-filter" data-target="six-pack-all">{{trans('messages.all')}}</span>
            </div>
        </div>
        <div class="menu-items scrollable-div mb-5">
            <div class="menu-card" style="overflow: hidden;">
                @foreach ($sixPack as $key => $value)
                @php
                $getUrl = (Isop::isKeyExists($value, 'image_url') != "" ? $value['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                @endphp
                <div class="col-md-3 pt-5 six-pack-box" data-status="{{ Str::replace(' ', '-', Str::lower(Isop::isKeyExists($value, 'category'))) . '-' . Str::lower(Isop::isKeyExists($value, 'difficulty')) }}">
                    <div class="menu-card1 mb-3">
                        <a href="{{ URL($cardTypeVideoURL. Isop::isKeyExists($value, 'id')) }}">
                            <img src="{{$imageSignedUrl}}" class="menu-img">
                            <h5>{{Isop::isKeyExists($value, 'title')}}</h5>
                            <button>{{__('messages.'.Str::upper(Isop::isKeyExists($value, 'difficulty')))}}</button>
                            <div class="time">
                                <p class="minute"><span class="min">{{Isop::isKeyExists($value, 'video_length')}}</span><br>Min</p>
                                <p class="kal1"><span class="min1">6</span> Workouts</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="reciepe-name">
                    <h2>{{trans('messages.no_equipment')}}</h2>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <span class="custom_btn easy no-equipment-filter" data-target="no-equipment-easy">{{trans('messages.easy')}}</span>
                <span class="custom_btn intermediate no-equipment-filter" data-target="no-equipment-intermediate">{{trans('messages.intermediate')}}</span>
                <span class="custom_btn hard no-equipment-filter" data-target="no-equipment-hard">{{trans('messages.advanced')}}</span>
                <span class="custom_btn all no-equipment-filter" data-target="no-equipment-all">{{trans('messages.all')}}</span>
            </div>
        </div>
        <div class="menu-items scrollable-div mb-5">
            <div class="menu-card" style="overflow: hidden;">
                @foreach ($noEquipment as $key => $value)
                @php
                $getUrl = (Isop::isKeyExists($value, 'image_url') != "" ? $value['image_url'] : "");
                $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                @endphp

                <div class="col-md-3 pt-5 no-equipment-box" data-status="{{ Str::replace(' ', '-', Str::lower(Isop::isKeyExists($value, 'category'))) . '-' . Str::lower(Isop::isKeyExists($value, 'difficulty')) }}">
                    <div class="menu-card1 mb-3">
                        <a href="{{ URL($cardTypeVideoURL. Isop::isKeyExists($value, 'id')) }}">
                            <img src="{{$imageSignedUrl}}" class="menu-img">
                            <h5>{{Isop::isKeyExists($value, 'title')}}</h5>
                            <button>{{__('messages.'.Str::upper(Isop::isKeyExists($value, 'difficulty')))}}</button>
                            <div class="time">
                                <p class="minute"><span class="min">{{Isop::isKeyExists($value, 'video_length')}}</span><br>Min</p>
                                <p class="kal1"><span class="min1">6</span> Workouts</p>
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

@section('pageScript')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/slider.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.menu-card .chest-box').hide();
        $('.menu-card .biceps-box').hide();
        $('.menu-card .six-pack-box').hide();
        $('.menu-card .no-equipment-box').hide();


        $('.chest-filter').on('click', function() {
            $('.chest-filter').removeClass('active');
            $(this).addClass('active');
            var $target = $(this).data('target');
            if ($target !== 'chest-all') {
                $('.menu-card .chest-box').hide();
                $('.menu-card .chest-box[data-status="' + $target + '"]').show();
            } else {
                $('.menu-card .chest-box').show();
            }
        });

        $('.biceps-filter').on('click', function() {
            $('.biceps-filter').removeClass('active');
            $(this).addClass('active');
            var $target = $(this).data('target');
            if ($target !== 'biceps-all') {
                $('.menu-card .biceps-box').hide();
                $('.menu-card .biceps-box[data-status="' + $target + '"]').show();
            } else {
                $('.menu-card .biceps-box').show();
            }
        });

        $('.six-pack-filter').on('click', function() {
            $('.six-pack-filter').removeClass('active');
            $(this).addClass('active');
            var $target = $(this).data('target');
            if ($target !== 'six-pack-all') {
                $('.menu-card .six-pack-box').hide();
                $('.menu-card .six-pack-box[data-status="' + $target + '"]').show();
            } else {
                $('.menu-card .six-pack-box').show();
            }
        });

        $('.no-equipment-filter').on('click', function() {
            $('.no-equipment-filter').removeClass('active');
            $(this).addClass('active');
            var $target = $(this).data('target');
            if ($target !== 'no-equipment-all') {
                $('.menu-card .no-equipment-box').hide();
                $('.menu-card .no-equipment-box[data-status="' + $target + '"]').show();
            } else {
                $('.menu-card .no-equipment-box').show();
            }
        });
    });
</script>

@endsection
