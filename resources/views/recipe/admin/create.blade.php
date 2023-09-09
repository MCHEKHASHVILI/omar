@extends('layouts.app')

@section('title')
Add Reciepe
@endsection

@section('content')

@include('layouts.partials.recipe_training.nav')

<style>
.image-upload-container {
      margin-top: 20px;
    }

    .image-upload-label {
      display: block;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .icon-preview-container {
      display: none;
      margin-top: 20px;
    }

    .image-preview {
      width: 200px;
      height: 200px;
      margin-top: 10px;
      background: #fff;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      overflow: hidden;
    }

    .image-preview img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

</style>
<section class="form-container">
    <div class="wrapper">
        <h1>Add Recipe</h1>

        <!-- if there are creation errors, they will show here -->
        <x-base.error />

        {{ Form::open(array('url' => config('constants.RECIPES.ADMIN_RECIPES'), 'enctype' => 'multipart/form-data')) }}
        {{ csrf_field() }}
        <input type="text" placeholder="Enter the Reciepe" name="title" value="{{old('title')}}">
        <div class="radio">
            <p>Choose the Difficulty</p>

            <input type="radio" class="inter" id="recipeEasy" name="difficulty" value="easy" {{ old('difficulty') == "easy" ? 'checked' : ''}}>
            <label for="recipeEasy">EASY</label>

            <input type="radio" class="inter" id="recipeIntermediate" name="difficulty" value="intermediate" {{ old('difficulty') == "intermediate" ? 'checked' : ''}}>
            <label for="recipeIntermediate">INTERMEDIATE</label>

            <input type="radio" class="inter" id="recipeHard" name="difficulty" value="hard" {{ old('difficulty') == "hard" ? 'checked' : ''}}>
            <label for="recipeHard">Advance</label>
        </div>
        <input type="text" placeholder="Enter the Video Lenght" name="video_length" value="{{old('video_length')}}">
        <input type="text" placeholder="Enter the Category" name="category" value="{{old('category')}}">
        <input type="text" placeholder="Enter the Sub Category" name="sub_category" value="{{old('sub_cateogyr')}}">
        <!-- <input type="number" placeholder="Number of Workouts"> -->
        <div class="main-radio">
            <div class="radio1">
                <p>High Calories</p>

                <input type="radio" id="caloriesYes" name="calories" value="yes" {{ old('calories') == "yes" ? 'checked' : ''}}>
                <label for="caloriesYes">YES</label>

                <input type="radio" id="caloriesNo" name="calories" value="no" {{ old('calories') == "no" ? 'checked' : ''}}>
                <label for="caloriesNo">NO</label>
            </div>
            <div class="radio2">
                <p>Premium</p>

                <input type="radio" id="PremiumYes" name="premium" value="yes" {{ old('premium') == "yes" ? 'checked' : ''}}>
                <label for="PremiumYes">YES</label>

                <input type="radio" id="PremiumNo" name="premium" value="no" {{ old('premium') == "no" ? 'checked' : ''}}>
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
        <div class="form-group video-file">
            <label for="iconUpload">Choose the recipe Icon:</label><br>
            <input type="file" class="form-control-file" id="iconUpload" name="recipe_icon" accept="image/*">
          </div>
          <div class="form-group icon-preview-container" id="previewContainer">
            <label>Icon Preview:</label>
            <div class="image-preview">
              <img src="" id="previewIcon" class="img-fluid" alt="Preview">
            </div>
          </div>

        <button type="submit">Add Reciepe</button>
        {{ Form::close() }}
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
$(document).ready(function () {
  // Preview image on file input change
  $('#iconUpload').change(function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();

    reader.onload = function (event) {
      $('#previewIcon').attr('src', event.target.result);
      $('#previewContainer').show(); // Show the preview image
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      $('#previewContainer').hide(); // Hide the preview image if no file is selected
    }
  });
});


    </script>
    
@endsection