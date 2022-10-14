<div id="bookAppointment" class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <form method="post" action="{{ url('/add_appointment') }}" class="main-form">
        @csrf
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" name="name" class="form-control" placeholder="Full name">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="email" name="email" class="form-control" placeholder="Email address..">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" name="date" class="form-control">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <select class="form-control" name="appointment" id="">
            <option disabled selected hidden value="">--Select Appointment--</option>
            @foreach ($appointmentsList as $appointment )
              <option value="{{ $appointment }}">{{ $appointment }}</option>
            @endforeach
           </select>
          </div>
          <div class="col-12 col-sm-12 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="doctor" id="departement" class="form-control">
              <option disabled selected hidden value="">--Select Doctor--</option>
              @foreach ($doctorsView as $doctor)  
              <option value="{{ $doctor->id }}">{{ $doctor->name."/".$doctor->specialty }}</option>
              @endforeach
              
            </select>
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" name="phone" class="form-control" placeholder="Number..">
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-outline-primary mt-3 wow zoomIn">Submit Request</button>
      </form>
    </div>
  </div>