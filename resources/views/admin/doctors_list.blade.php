@include('admin.head')
    
@include('admin.sidebar')
      <!-- partial -->
@include('admin.navbar')
        <!-- partial -->
@include('admin.errors')
@if (session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>  
@endif
<div class="d-flex justify-content-center align-content-center">
    
    <div class="container">
        <table class="table table-dark table-striped table-responsive ">
            <thead>
              <tr>
                 <th scope="col">#</th>
                 <th scope="col">Name</th>
                 <th scope="col">phone</th>
                 <th scope="col">specialty</th>
                 <th scope="col">Room No.</th>
                 <th scope="col">Profile Picture</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor )
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>{{ $doctor->specialty }}</td>
                    <td>{{ $doctor->room_no }}</td>
                    <td> <img style="width:100px; border-radius:5%; height:90px;" src="{{ url("storage/$doctor->profile_pic")}}" alt=""></td>
                </tr>  
                @endforeach
              
            </tbody>
          </table>
          
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class=" m-5 btn bg-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add To Doctors List
  </button>
  <!-- Modal -->
  {{ $doctors->links() }}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
             <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
         </div>
         <div class="modal-body">
              <div class="d-flex justify-content-center align-content-center">
                  <div class="container w-75 p-5">
                         <form class="" action="{{ url('add_doctor') }}" method="POST" enctype="multipart/form-data">
                             @csrf
                             <div class="mb-3">
                                 <label class="form-label" for="name">Doctor Name</label>
                                 <br>
                                 <input type="text" name="name" class="text-dark form-contorl" placeholder="Doctor Name">
                             </div>
                             <div class="mb-3">
                                 <label class="form-label" for="name">Phone No.</label>
                                 <br>
                                 <input type="text" name="phone" class="text-dark form-contorl" placeholder="Phone No.">
                             </div>
                             <div class="mb-3">
                                 <label class="form-label" for="name">Room No.</label>
                                 <br>
                                 <input type="number" name="room_no" class="text-dark form-contorl" placeholder="Room No.">
                             </div>
                             <div class="mb-3">
                                 <label class="form-label" for="specialty">specialty</label>
                                 <br>
                                 <select class="text-dark w-100" name="specialty" id="">
                                     <option disabled hidden value="">--Select--</option>
                                     @foreach ($specialties as $specialty )
                                     <option value="{{ $specialty }}">{{ $specialty }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="mb-3">
                                 <label class="form-label" for="name">Profile Picture</label>
                                 <br>
                                 <input type="file" name="profile_pic" class=" bg-light text-dark form-contorl" placeholder="Profile Picture">
                             </div>
                             <div class="mt-3">
                                 <button type="submit" class="btn bg-success">Add Doctor</button>
                             </div>
                       </form>
                 </div>
             </div>
         </div>
      </div>
  </div>
</div>    
@include('admin.footer')
<!-- container-scroller -->
<!-- plugins:js -->
@include('admin.scripts')