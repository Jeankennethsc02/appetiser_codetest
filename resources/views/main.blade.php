
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BEEHIVE</title> 
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    
    <!-- calendar -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

</head>
<body>
    <!--Navbar -->
<nav id="top" class="mb-1 navbar navbar-expand-lg">
    <img src="{{ asset('images/bee3.png') }}">
  <p class="beehiveText">BEEHIVE</p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item avatar">
        <a class="nav-link p-0" href="#">
          <img src="{{ asset('images/resumepic.jpg') }}" class="rounded-circle z-depth-0"
            alt="avatar image" height="35">
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link logoutText" href="#">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->

<div class="container2">
    <div class="row">
        <!-- 1st Column -->
        <div class="col-4">

            <!-- start of FORM -->

            <!-- to display success when data has been saved in database -->
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success')}}</p>
                </div>
            @endif

            <form action="/create"  method="POST">
            <!-- @csrf -->
            {{csrf_field()}}

            <div class="form-group">
                <div class="eventBox">
                    <input class="event_input" type="text" placeholder="Enter an event" name="title">    
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <span class="form-label">From</span>
                        <input id="input1" class="form-control from_input" type="date" name="start_date" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <span class="form-label">To</span>
                        <input class="form-control to_input" type="date" name="end_date"required>
                    </div>
                </div>
            </div>

            <!-- select days -->
            <div class="week">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek" name="Monday" value="Monday">
                    <label class="form-check-label" for="inlineCheckbox1">Mon</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek"  name="Tuesday" value="Tuesday">
                    <label class="form-check-label" for="inlineCheckbox2">Tue</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek"  name="Wednesday" value="Wednesday">
                    <label class="form-check-label" for="inlineCheckbox3">Wed</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek"  name="Thursday" value="Thursday">
                    <label class="form-check-label" for="inlineCheckbox1">Thu</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek"  name="Friday" value="Friday">
                    <label class="form-check-label" for="inlineCheckbox2">Fri</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek"  name="Saturday" value="Saturday">
                    <label class="form-check-label" for="inlineCheckbox3">Sat</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="daysOfWeek"  name="Sunday" value="Sunday">
                    <label class="form-check-label" for="inlineCheckbox3">Sun</label>
                </div>
            </div>
            <!-- end of select days -->
        
            <div class="form-btn text-center">
                <button class="eventButton">Publish Event</button>
            </div>
            </div> 

        </form> <!-- end of FORM -->


        <!-- 2nd Column -->
        <div class="col-8 column2">
            <p>CALENDAR EVENTS</p>
            <div class="response"></div>
            <div id='calendar'></div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
      $(document).ready(function () {
         
        var myEvent = @json($allEvents);
         var calendar = $('#calendar').fullCalendar({
            defaultView: 'listMonth',

            //events as key, myEvent as value
            events: myEvent

            //for initial value (testing only)
            // events: [
            //     {
            //        title: 'myEvent.title',
            //        start: 'myEvent.start',
            //        end: 'myEvent.end'
            //     },
            //     {
            //        title: 'Meeting2',
            //        start: '2020-03-27',
            //        end: '2020-03-28'  
            //     }

            // ]
         });
   });
  

</script>
</body>


</html>