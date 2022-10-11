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
@if (session()->has('successDelete'))
<div class="alert alert-success">
    {{ session()->get('successDelete') }}
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
                 <th scope="col">Options</th>
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
                    <td>
                        <div class="dropdown">
                            <button   class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Options
                            </button>
                      
                        <ul class="dropdown-menu">
                          <li>
                            <!-- Update Doctor Button trigger modal -->
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editDoctor{{ $doctor->id }}">
                              Update
                            </button>
                          </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                           <form method="POST" action="{{ url("delete_doctor/$doctor->id") }}">
                            @csrf
                            @method('delete')  
                            <button onclick='return confirm("are you sure you want to delete")' class="dropdown-item" type="submit">Delete</button>    
                           </form>
                         </li>
                        </ul>
                      </div>
                    </td>          
                </tr>
                <!-- Update Doctor Modal -->
                <div class="modal fade" id="editDoctor{{ $doctor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Doctor</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                      </div>
                      <div class="modal-body">
                        <div class="d-flex justify-content-center align-content-center">
                          <div class="container w-75 p-5">
                                 <form class="" action="{{ url("update_doctor/$doctor->id") }}" method="POST" enctype="multipart/form-data">
                                     @csrf
                                     <div class="mb-3">
                                         <label class="form-label" for="name">Doctor Name</label>
                                         <br>
                                         <input type="text" value="{{ $doctor->name }}" name="nameUpdate" class="text-dark form-contorl" placeholder="Doctor Name">
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label" for="name">Phone No.</label>
                                         <br>
                                         <input type="text" value="{{ $doctor->phone }}" name="phoneUpdate" class="text-dark form-contorl" placeholder="Phone No.">
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label" for="name">Room No.</label>
                                         <br>
                                         <input type="number" value="{{ $doctor->room_no }}" name="room_noUpdate" class="text-dark form-contorl" placeholder="Room No.">
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label" for="specialty">specialty</label>
                                         <br>
                                         <select class="text-dark w-100" name="specialtyUpdate" id="">
                                             <option selected hidden value="{{ $doctor->specialty }}">{{ $doctor->specialty }}</option>
                                             @foreach ($specialties as $specialty )
                                             <option value="{{ $specialty }}">{{ $specialty }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label"  for="name">Profile Picture</label>
                                         <br>
                                         <input type="file"  value="{{ $doctor->profile_pic }}" name="profile_picUpdate" class=" bg-light text-dark form-contorl" placeholder="Profile Picture">
                                     </div>
                                     <div class="mt-3">
                                         <button type="submit" class="btn bg-info">Update Doctor</button>
                                     </div>
                               </form>
                         </div>
                     </div>
                      </div>

                    </div>
                  </div>
                </div>
                @endforeach
              
            </tbody>
          </table>
          
    </div>
</div>

<!-- Add Doctor Button trigger modal -->
<button type="button" class=" m-5 btn bg-info" data-bs-toggle="modal" data-bs-target="#addDoctor">
    Add To Doctors List
  </button>
  <!-- Add Doctor Modal -->
  
<div class="modal fade" id="addDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Add Doctor</h1>
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

  {{ $doctors->links() }}    
  
  

  @include('admin.footer')

  <!-- container-scroller -->
<!-- plugins:js -->
@include('admin.scripts')