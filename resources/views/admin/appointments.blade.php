@include('admin.head')
    
@include('admin.sidebar')
      <!-- partial -->
@include('admin.navbar')
        <!-- partial -->
@include('admin.errors') 

<div class="container row">
      @if (!$appointmentList->isEmpty())
            
      
      <table class="table table-dark table-striped">
            <thead>
                  <tr>
                   <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Date</th>
                    <th scope="col">Appointment</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Send Email</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($appointmentList as $appointment)
                  <tr>
                        <th scope="row">1</th>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->appointment }}</td>
                        <td>
                            <button type="button" class="btn btn-info bg-info" data-bs-toggle="modal" data-bs-target="{{"#patientMessage".$appointment->id }}">
                              Message
                            </button>
                        </td>
                        <td>
                              {{-- Approved/Rejected Dropdown --}}
                           <div class="dropdown">
                              <a class="btn btn-info dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $appointment->status }}
                              </a>
                              <ul class="dropdown-menu">
                                <li><form method="POST" action="{{ url("status_approved/$appointment->id") }}">
                                     @csrf
                                     <button class=" dropdown-item" type="submit">Approved</button>
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><form method="POST" action="{{ url("status_rejected/$appointment->id") }}">@csrf<button class=" dropdown-item" type="submit">Rejected</button></form></li>
                              </ul>
                            </div>
                        </td>
                        <td> 
                          <form action="{{ url("/send_email/$appointment->id") }}"  method="post">
                            @csrf<button @if ($appointment->status == 'pending')disabled
                            @endif type="submit" class="btn btn-success">Send Mail</button>
                         </form>
                        </td>
                      </tr> 
                      {{-- Message Modal --}}
                      <div class="modal fade" id="{{"patientMessage".$appointment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Patient Message</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                             <p>{{ $appointment->message }}</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn bg-info bg-info btn-info" data-bs-dismiss="modal">Understood</button>
                            </div>
                          </div>
                        </div>
                      </div> 
                  @endforeach
                  
          </table>
          @else
          {{-- in case there is no appointments --}}
          <div class="w-75 m-auto alert alert-warning text-center">
            <h3>No Appointments Currently</h3>
          </div>
          @endif
</div>

@include('admin.footer')


@include('admin.scripts')