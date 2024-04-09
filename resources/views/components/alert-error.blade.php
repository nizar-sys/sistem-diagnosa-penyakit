@if (count($errors) > 0)
  <div class="alert alert-danger">
    <p class="text-center">
      <strong>ERROR!!</strong><br>
        Ada kesalahan!!
    </p> 
    <hr>
    <p class="text-center"><strong>INFO!!!</strong></p>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif