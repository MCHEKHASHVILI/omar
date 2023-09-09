@extends('layouts.base')

@section('title')
Video
@endsection

@section('content')
@php
$getUrl = (Isop::isKeyExists($getSelectedDocDetail, 'video_url') != "" ? $getSelectedDocDetail['video_url'] : "");
$videoSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);

@endphp
<section class="w-100">



   
    <section class="video-player1" style="direction: ltr">
        <div class="video-player">
            <div class="top-left-buttons">
                <button class="top-left-button" onclick="lcoation.href='{{url()->previous()}}'"><i class="fas fa-chevron-left" style="font-size: 15px; margin: 3px;"></i>{{__('messages.back')}}</button>
                <button class="top-left-button" onclick="location.href='/home'">{{__('messages.home')}}</button>
            </div>
            <video id="my-video">
                <source src="{{ $videoSignedUrl }}" type="video/mp4">
            </video>
            <div class="play-overlay">
                <i class="fas fa-play"></i>
            </div>
            <div class="controls">
                <div class="controls-left">
                    <button id="play-pause-btn"><i class="fa fa-play"></i></button>
                </div>
                <div class="progress-bar">
                    <div class="progress-area">
                        <div class="progress"></div>
                    </div>
                    <div class="controls-right">
                        <div class="volume-btn">
                            <i class="fa fa-volume-up"></i>
                            <div class="volume-range-container">
                                <input type="range" class="volume-range" min="0" max="100" value="50">
                            </div>
                        </div>
                <!--        <button id="cc-btn"><i class="fa fa-closed-captioning"></i></button>
                        <div class="settings-dropdown">
                            <button id="settings-btn"><i class="fa fa-cog"></i></button>
                            <div class="dropdown-content">
                                <div class="playback-speed">
                                    <ul>
                                        <li class="placyback-speed-settings"><i class="fa fa-play-circle" style="margin-right: 5px;"></i> Playback Speed</li>
                                        <li class="text-right">Normal <i class="fa fa-chevron-right"></i> </li>
                                    </ul>
                                    <ul>
                                        <li class="quality-settings"><i class="fa fa-sliders" style="margin-right: 5px;"></i> Quality</li>
                                        <li class="text-right">Normal <i class="fa fa-chevron-right"></i></li>
                                    </ul>

                                </div>
                            </div>
                            <div class="playback-speed-content">
                                <div class="playback-speed-header">
                                    <i class="fa fa-chevron-left"></i>
                                    <h5>Playback Speed</h5>
                                </div>
                                <div class="playback-speed-body">
                                    <ul>
                                        <li value="0.5">0.5x</li>
                                        <li value="1">Normal</li>
                                        <li value="1.5">1.5x</li>
                                        <li value="2">2x</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="quality-content">
                                <div class="quality-header">
                                    <i class="fa fa-chevron-left"></i>
                                    <h5>Quality</h5>
                                </div>
                                <div class="quality-body">
                                    <ul>
                                        <li value="1080" class="quality-option">1080p</li>
                                        <li value="720" class="quality-option">720p</li>
                                        <li value="480" class="quality-option">480p</li>
                                        <li value="144" class="quality-option">144p</li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->
                        <button id="fullscreen-btn"><i class="fa fa-expand"></i></button>
                    </div>
                </div>
                <!--<div class="share-container">
                    <button id="share-btn"><i class="fa fa-share"></i>
                        <span class="share-text">Share</span></button>
                </div>-->
            </div>
        </div>
    </section>



  <div class="menu-container1">
        <div class="picks-reciepe">
            <div class="reciepe-name">
                <h2>{{trans('messages.' . strtolower(Isop::isKeyExists($getSelectedDocDetail, 'category')))}}</h2>
            </div>

        </div>


        <div class="menu-items row p-0 m-0 mt-5">




            @foreach ($getCategoryBasedTrainings as $key => $training)
            @php
            $getUrl = (Isop::isKeyExists($training, 'image_url') != "" ? $training['image_url'] : "");
            $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
            $id = (Isop::isKeyExists($training, 'id') != "" ? $training['id'] : "");
            @endphp
            <div class="col-md-3 p-1">
                <div class="menu-card1">
                    <a href="{{ URL(config('constants.TRAININGS.VIDEOS_PATH').$id) }}">
                        <img src="{{$imageSignedUrl}}" class="menu-img">
                        <h5>{{Isop::isKeyExists($training, 'title')}}</h5>
                        <button class="{{Isop::isKeyExists($training, 'difficulty')}}">{{__('messages.'.Str::lower(Isop::isKeyExists($training, 'difficulty')))}}</button>
                        <div class="time">
                            <p class="minute"><span class="min">{{Isop::isKeyExists($training, 'video_length')}}</span><br>Min</p>
                            <p class="kal"><span class="min">102</span><br>Kcal</p>
                            <img src="{{ asset('public/assets/images/time-icon.png') }}" class="time-img">
                        </div>
                    </a>
                </div>
            </div>

            @endforeach


        </div>
    </div>
</section>
@endsection

@section('pageStyle')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('pageScript')
<script type="text/javascript">
    const video = document.getElementById('my-video');
    const playPauseBtn = document.getElementById('play-pause-btn');
    const progressBar = document.querySelector('.progress');

    const volumeBtn = document.querySelector('.volume-btn');
    const volumeRangeContainer = document.querySelector('.volume-range-container');
    const volumeRange = document.querySelector('.volume-range');
    const volumeIcon = document.querySelector('.volume-btn i');

    const progressArea = document.querySelector(".progress-area");
    var isDragging = false;

   // const ccBtn = document.getElementById('cc-btn');
   // const settingsBtn = document.querySelector('#settings-btn i');
    const fullscreenBtn = document.getElementById('fullscreen-btn');
   // const shareBtn = document.getElementById('share-btn');
    const videoPlayer = document.querySelector('.video-player');
   // const dropdownContent = document.querySelector('.dropdown-content');

    var controls = document.querySelector('.controls');
    var isFullscreen = false; // Keeps track of fullscreen mode
    var timeoutId; // Stores the timeout ID for hiding the controls
    const playOverlay = document.querySelector('.play-overlay');
    var topLeftButtons = document.querySelector('.top-left-buttons');

    const playBackSpeedHeader = document.querySelector('.playback-speed-header');
    const qualityHeader = document.querySelector('.quality-header');

    // const managePlayBackSpeed = document.getElementById('manage-playback-speed');


    playPauseBtn.addEventListener('click', function() {
        if (video.paused) {
            video.play();
            playOverlay.style.opacity = "0"
            playPauseBtn.innerHTML = '<i class="fa fa-pause"></i>';
            
        } else {
            video.pause();
            playOverlay.style.opacity = "1"
            playPauseBtn.innerHTML = '<i class="fa fa-play"></i>';
            
        }
    });

    video.addEventListener('timeupdate', function() {
        const progress = (video.currentTime / video.duration) * 100;
        progressBar.style.width = progress + '%';
    });


    /*ccBtn.addEventListener('click', function() {
        // Add your closed captioning functionality here
    });

    settingsBtn.addEventListener('click', function() {
        event.stopPropagation();
        dropdownContent.classList.toggle('show');
    });

    const managePlaybackSpeed = document.querySelector('.placyback-speed-settings');
    const playbackSpeedOptions = document.querySelector('.playback-speed-content');

    managePlaybackSpeed.addEventListener('click', function() {
        playbackSpeedOptions.classList.toggle('show');
        dropdownContent.classList.remove('show');
        setTimeout(function() {
            controls.style.opacity = 1;
            topLeftButtons.style.opacity = 1;
        }, 0);
    });

    const manageQuality = document.querySelector('.quality-settings');
    const qualitySettingOptions = document.querySelector('.quality-content');

    manageQuality.addEventListener('click', function() {
        dropdownContent.classList.remove('show');
        qualitySettingOptions.classList.toggle('show');
        setTimeout(function() {
            controls.style.opacity = 1;
            topLeftButtons.style.opacity = 1;
        }, 0);
    });

    // Close the playback speed options when clicking outside
    // window.addEventListener('click', function(event) {
    //   if (!event.target.matches('#manage-playback-speed')) {
    //     if (playbackSpeedOptions.classList.contains('show')) {
    //       playbackSpeedOptions.classList.remove('show');
    //     }
    //   }
    // });

    playBackSpeedHeader.addEventListener('click', function() {
        dropdownContent.classList.toggle('show');
        playbackSpeedOptions.classList.remove('show');
    });

    qualityHeader.addEventListener('click', function() {
        dropdownContent.classList.toggle('show');
        qualitySettingOptions.classList.remove('show');
    });
*/

    fullscreenBtn.addEventListener('click', function() {
        if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        } else {
            if (videoPlayer.requestFullscreen) {
                videoPlayer.requestFullscreen();
            } else if (videoPlayer.mozRequestFullScreen) {
                videoPlayer.mozRequestFullScreen();
            } else if (videoPlayer.webkitRequestFullscreen) {
                videoPlayer.webkitRequestFullscreen();
            } else if (videoPlayer.msRequestFullscreen) {
                videoPlayer.msRequestFullscreen();
            }
        }
    });


  /*  shareBtn.addEventListener('click', function() {
        // Add your share functionality here
    });
*/
    // Handle exiting fullscreen mode
    document.addEventListener('fullscreenchange', handleFullscreenChange);
    document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
    document.addEventListener('mozfullscreenchange', handleFullscreenChange);
    document.addEventListener('MSFullscreenChange', handleFullscreenChange);

    function handleFullscreenChange() {
        if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
            videoPlayer.classList.add('fullscreen');

        } else {
            videoPlayer.classList.remove('fullscreen');

        }
    }




    // Close the dropdown when clicking outside
    // window.addEventListener('click', function(event) {
    //   if (!event.target.matches('#settings-btn')) {
    //     if (dropdownContent.classList.contains('show')) {
    //       dropdownContent.classList.remove('show');
    //     }
    //   }
    // });


  /*  const playbackSpeedItems = document.querySelectorAll('.playback-speed-body li');

    // Add click event listeners to each playback speed item
    playbackSpeedItems.forEach(item => {
        item.addEventListener('click', () => {

            playbackSpeedItems.forEach(speedItem => {
                speedItem.classList.remove('active');
            });

            // Add the active class to the clicked item
            item.classList.add('active');

            // Get the selected playback speed value
            const selectedSpeed = item.getAttribute('value');
            // Update the playback speed of the video
            video.playbackRate = selectedSpeed;

            playbackSpeedOptions.classList.remove('show');

            const normalSpeedItem = document.querySelector('.playback-speed .text-right');
            normalSpeedItem.innerText = item.innerText;

        });
    });
*/
    volumeBtn.addEventListener('click', function() {
        volumeRangeContainer.classList.toggle('show');
    });

    volumeRange.addEventListener('input', function() {
        const volumeLevel = volumeRange.value;
        // Handle volume change here
        console.log('Volume Level:', volumeLevel);
    });


    volumeRange.addEventListener('input', function() {
        video.volume = parseFloat(volumeRange.value);
    });

    volumeRange.addEventListener('input', function() {
        const volume = parseFloat(volumeRange.value) / 100;
        video.volume = volume;
        if (volume == 0) {
            volumeIcon.classList.remove('fa-volume-up');
            volumeIcon.classList.add('fa-volume-mute');
        } else {
            volumeIcon.classList.remove('fa-volume-mute');
            volumeIcon.classList.add('fa-volume-up');
        }
    });

    progressArea.addEventListener("mousedown", startDrag);
    progressArea.addEventListener("mousemove", dragProgress);
    window.addEventListener("mouseup", stopDrag);

    function startDrag(event) {
        isDragging = true;
        dragProgress(event);
    }

    function dragProgress(event) {
        if (isDragging) {
            var clickX = event.clientX - progressArea.getBoundingClientRect().left;
            var progressWidth = progressArea.clientWidth;
            var videoDuration = video.duration;
            var seekTime = (clickX / progressWidth) * videoDuration;

            video.currentTime = seekTime;
        }
    }

    function stopDrag() {
        isDragging = false;
    }

    video.addEventListener("timeupdate", updateProgressBar);

    function updateProgressBar() {
        var currentTime = video.currentTime;
        var videoDuration = video.duration;
        var progressPercentage = (currentTime / videoDuration) * 100;
        progressBar.style.width = progressPercentage + "%";
    }

    // Hide controls after 2 seconds of playing
    videoPlayer.addEventListener('play', function() {
        if (!videoPlayer.paused) {
            timeoutId = setTimeout(function() {
                controls.style.opacity = 0;
                topLeftButtons.style.opacity = 0;
            }, 2000);
        }
    });

    // Show controls on video player hover
    videoPlayer.addEventListener('mouseenter', function() {
        if (!videoPlayer.paused) {
            controls.style.opacity = 1;
            topLeftButtons.style.opacity = 1;
        }
    });

    // Hide controls when cursor and controls are inactive
    function hideCursorAndControls() {
        if (!videoPlayer.paused) {
            videoPlayer.style.cursor = 'none';
            controls.style.opacity = 0;
            topLeftButtons.style.opacity = 0;
        }
    }

    // Show controls when cursor is active
    function showCursorAndControls() {
        if (!videoPlayer.paused) {
            videoPlayer.style.cursor = 'auto';
            controls.style.opacity = 1;
            topLeftButtons.style.opacity = 1;
            clearTimeout(timeoutId);
           timeoutId = setTimeout(hideCursorAndControls, 3000);
        }
    }

    // Add event listeners for cursor and controls behavior
    videoPlayer.addEventListener('mousemove', showCursorAndControls);
    videoPlayer.addEventListener('mouseleave', hideCursorAndControls);
    controls.addEventListener('mouseenter', showCursorAndControls);
    controls.addEventListener('mouseleave', hideCursorAndControls);

    // Detect fullscreen change
    document.addEventListener('fullscreenchange', function() {
        isFullscreen = document.fullscreenElement !== null;
        if (isFullscreen) {
            clearTimeout(timeoutId);
            showCursorAndControls();
        } else {
            hideCursorAndControls();
        }
    });

    // Detect mouse movement on the document
    document.addEventListener('mousemove', function() {
        if (isFullscreen && !videoPlayer.paused) {
            clearTimeout(timeoutId);
            showCursorAndControls();
            timeoutId = setTimeout(hideCursorAndControls, 3000);
        }
    });

    // Prevent controls from disappearing when the video is paused
    videoPlayer.addEventListener('pause', function() {
        clearTimeout(timeoutId);
        controls.style.opacity = 1;
    });


    function togglePlayPause() {
        if (video.paused) {
            video.play();
            playOverlay.style.opacity = "0"
            playPauseBtn.innerHTML = '<i class="fa fa-pause"></i>';
            // videoPlayer.classList.remove('paused');
        } else {
            video.pause();
            playOverlay.style.opacity = "1"
            playPauseBtn.innerHTML = '<i class="fa fa-play"></i>';
            // videoPlayer.classList.add('paused');
        }
    }

    playOverlay.addEventListener('click', togglePlayPause);
    video.addEventListener('click', togglePlayPause);


  /*  const qualityOptions = document.querySelectorAll('.quality-option');

    qualityOptions.forEach(option => {
        option.addEventListener('click', function() {

            const selectedQuality = option.getAttribute('value');
            // Set the video source to the selected quality
            const videoSource = document.querySelector('#my-video source');
            // videoSource.setAttribute('src', 'path/to/your/video-' + selectedQuality + '.mp4');
            vsource = "<?php echo $videoSignedUrl; ?>";
            videoSource.setAttribute('src', vsource);

            // Reload the video element with the new source
            video.load();

            // Hide the quality options dropdown
            qualitySettingOptions.classList.remove('show');

            // Update the displayed quality
            const qualitySettings = document.querySelector('.quality-settings .text-right');
            qualitySettings.innerText = option.innerText;
        });
    });*/
</script>
@endsection
