@extends('layouts.app')

@section('title')
Add Training
@endsection

@section('content')

@include('layouts.partials.recipe_training.nav')

<section class="form-container">
    <div class="wrapper">
        <h1>Add Training</h1>
        <x-base.error />
        {{ Form::model($training, array('route' => array('admin.trainings.update', $doc_id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
        {{ csrf_field() }}
        <input type="text" placeholder="Enter the Title" name="title" value="{{ old('title', $training['title']) }}">
        <div class="radio">
            <p>Choose the Difficulty</p>

            <input type="radio" id="trainingEasy" value="easy" name="difficulty" {{ old('difficulty', $training['difficulty']) == "easy" ? 'checked' : ''}}>
            <label for="trainingEasy">EASY</label>

            <input type="radio" id="trainingIntermediate" value="intermediate" name="difficulty" {{ old('difficulty', $training['difficulty']) == "intermediate" ? 'checked' : ''}}>
            <label for="trainingIntermediate">INTERMEDIATE</label>

            <input type="radio" id="trainingHard" value="hard" name="difficulty" {{ old('difficulty', $training['difficulty']) == "hard" ? 'checked' : ''}}>
            <label for="trainingHard">HARD</label>

        </div>
        <input type="text" placeholder="Enter the Video Length" name="video_length" value="{{ old('video_length', $training['video_length']) }}">
        <input type="text" placeholder="Enter the Category" name="category" value="{{ old('category', $training['category']) }}">
        <input type="text" placeholder="Enter the Sub Category" name="sub_category" value="{{ old('sub_category', $training['sub_category']) }}">
        <input type="number" placeholder="Number of Workouts" name="number_workouts" value="{{ old('number_workouts', $training['number_workouts']) }}">
        <div class="radio">
            <p>Premium</p>
            <input type="radio" id="PremiumYes" name="premium" value="yes" {{ old('premium', $training['premium']) == "yes" ? 'checked' : ''}}>
            <label for="PremiumYes">YES</label>
            <input type="radio" id="PremiumNo" name="premium" value="no" {{ old('premium', $training['premium']) == "no" ? 'checked' : ''}}>
            <label for="PremiumNo">NO</label>
        </div>
        <div class="file">
            <div class="image-file">
                <label>Enter the Image</label><br>
                <input type="file" name="image" />
            </div>

            <div class="video-file">
                <label>Enter the Video</label><br>
                <input type="file" name="video" />
            </div>

        </div>
        <button type="submit">Update Training</button>
        {{ Form::close() }}
    </div>
</section>
@endsection