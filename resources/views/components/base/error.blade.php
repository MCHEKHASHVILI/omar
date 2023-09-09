        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" id="error" style="width: 40%;">{{ $error }}</div>
        @endforeach
