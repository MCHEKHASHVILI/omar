@extends('layouts.app')

@section('title')
Training
@endsection

@section('content')

@include('layouts.partials.recipe_training.nav')


<section class="form-container">

    <!-- if there is success, they will show here -->
    <x-base.success />

    <div class="wrapper" style="width: 95%;padding: 5% 0% 4% 4%;">
        <h1>Add Training </h1>
        <div class="card">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Difficulty</th>
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>No. of Workouts</th>
                        <th>Premium</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainings as $key => $training)
                    @php
                    $getUrl = (Isop::isKeyExists($training, 'image_url') != "" ? $training['image_url'] : "");
                    $imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
                    @endphp


                    <td>{{Isop::isKeyExists($training, 'id')}}</td>
                    <td>{{Isop::isKeyExists($training, 'title')}}</td>
                    <td>{{Isop::isKeyExists($training, 'difficulty')}}</td>
                    <td>{{Isop::isKeyExists($training, 'category')}}</td>
                    <td>{{Isop::isKeyExists($training, 'sub_category')}}</td>
                    <td>{{Isop::isKeyExists($training, 'number_workouts')}}</td>
                    <td>{{Isop::isKeyExists($training, 'premium')}}</td>
                    <td> <img src="{{$imageSignedUrl}}" class="menu-img"></td>
                    <td>
                        <div class="action-buttons">
                            <!-- Show -->
                            <a class="btn btn-small btn-success" href="{{ route('admin.trainings.show', $key) }}">
                                <button class="actionButton">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </a>

                            <!-- Edit -->
                            <a class="btn btn-small btn-info" href="{{ route('admin.trainings.edit', $key) }}">
                                <button class="actionButton">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>

                            <form id="delete-form" action="{{ route('admin.trainings.destroy', $key) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="actionButton" onclick="confirmDelete(event)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection


@section('pageStyle')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('pageScript')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            order: [
                [1, "desc"]
            ]
        });
    });

    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, submit the form
                document.getElementById('delete-form').submit();
            }
        })
    }
</script>
@endsection