@if($errors->any())
<div class="alert w-50 m-auto alert-danger">
    <ul class=" text-center list-unstyled">
        @foreach ($errors->all() as $error )
            <li class="mb-3">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session()->has('addAppointment'))
        <div class="alert w-50 m-auto alert-success">
         <p>{{ session()->get('addAppointment') }}</p> 
        </div>
      @endif