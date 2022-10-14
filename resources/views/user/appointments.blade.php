@include('user.head')
@include('user.header')
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @if(!$userAppointments->isEmpty())
  <div class="container m-5 py-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Date</th>
            <th scope="col">Phone</th>
            <th scope="col">Appointment</th>
            <th scope="col">Doctor</th>
            <th scope="col">Message</th>
            <th scope="col">status</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($userAppointments as $userAppointment)
            
          
          <tr>
            <th scope="row">1</th>
            <td>{{ $userAppointment->name }}</td>
            <td>{{ $userAppointment->email }}</td>
            <td>{{ $userAppointment->date }}</td>
            <td>{{ $userAppointment->phone }}</td>
            <td>{{ $userAppointment->appointment }}</td>
            <td>{{ $userAppointment->doctor->name}}</td>
            <td>{{ $userAppointment->message }}</td>
           
            <td class=" @if($userAppointment->status == 'pending')
              text-warning
              @elseif ($userAppointment->status == 'approved')
              text-success 
              @else
              text-danger
              @endif
              ">{{ $userAppointment->status }}</td>
            <td>
              <form method="post" action="{{ url("/user_delete_appointment/$userAppointment->id") }}">
                @method('delete')
                @csrf
                <button onclick="return confirm('Are you sure you want to Delete? You may not be able to get the same appointment?')" class="btn btn-outline-danger">Delete</button>  
              </form>
            </td>
          </tr>
          
          @endforeach
        </tbody>
      </table>
      @else
          <div class="alert alert-warning text-center">
            <h3>No Appointments Booked <a href="{{ url('/#bookAppointment') }}">Click Here</a> to book new appointment!</h3>
          </div>
    @endif
  </div>
  @include('user.footer') 