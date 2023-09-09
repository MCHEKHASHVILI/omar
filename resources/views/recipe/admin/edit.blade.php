@extends('layouts.app')

@section('title')
Add Reciepe
@endsection

@section('content')

@include('layouts.partials.recipe_training.nav')

<section class="form-container">
    <div class="wrapper">
        <h1>Edit Recipe</h1>

        <!-- if there are creation errors, they will show here -->
        <x-base.error />

        {{ Form::model($data, array('route' => array('admin.recipes.update', $doc_id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
        <input type="text" placeholder="Enter the Recipe" name="title" value="{{ old('title', $data['title']) }}">
        <div class="radio">
            <p>Choose the Difficulty</p>

            <input type="radio" id="recipeEasy" name="difficulty" value="easy" {{ old('difficulty', $data['difficulty']) == "easy" ? 'checked' : '' }}>
            <label for="recipeEasy">EASY</label>

            <input type="radio" id="recipeIntermediate" name="difficulty" value="intermediate" {{ old('difficulty', $data['difficulty']) == "intermediate" ? 'checked' : '' }}>
            <label for="recipeIntermediate">INTERMEDIATE</label>

            <input type="radio" id="recipeHard" name="difficulty" value="hard" {{ old('difficulty', $data['difficulty']) == "hard" ? 'checked' : '' }}>
            <label for="recipeHard">ADVANCED</label>
        </div>

        <input type="text" placeholder="Enter the Video Length" name="video_length" value="{{ old('video_length', $data['video_length']) }}">
        <input type="text" placeholder="Enter the Category" name="category" value="{{ old('category', $data['category']) }}">
        <input type="text" placeholder="Enter the Sub Category" name="sub_category" value="{{ old('sub_category', $data['sub_category']) }}">

        <div class="main-radio">
            <div class="radio1">
                <p>High Calories</p>

                <input type="radio" id="caloriesYes" name="calories" value="yes" {{ old('calories', $data['calories']) == "yes" ? 'checked' : ''}}>
                <label for="caloriesYes">YES</label>

                <input type="radio" id="caloriesNo" name="calories" value="no" {{ old('calories', $data['calories']) == "no" ? 'checked' : ''}}>
                <label for="caloriesNo">NO</label>
            </div>

            <div class="radio2">
                <p>Premium</p>

                <input type="radio" id="PremiumYes" name="premium" value="yes" {{ old('premium', $data['premium']) == "yes" ? 'checked' : ''}}>
                <label for="PremiumYes">YES</label>

                <input type="radio" id="PremiumNo" name="premium" value="no" {{ old('premium', $data['premium']) == "no" ? 'checked' : ''}}>
                <label for="PremiumNo">NO</label>
            </div>
        </div>

        <div class="file">
            <div class="image-file">
                <label>Enter the Image</label>
                <br>
                <input type="file" name="image" />
            </div>

            <div class="video-file">
                <label>Enter the Video</label>
                <br>
                <input type="file" name="video" />
            </div>
        </div>

        <button type="submit">Update Recipe</button>
        {{ Form::close() }}
    </div>
</section>
@endsection