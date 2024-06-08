<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Home</title>
</head>
<style>
    .card-margin {
    margin-bottom: 1.875rem;
}

.card {
    border: 0;
    box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #ffffff;
    background-clip: border-box;
    border: 1px solid #e6e4e9;
    border-radius: 8px;
}

.card .card-header.no-border {
    border: 0;}

    .card .card-header {
    background: none;
    padding: 0 0.9375rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    min-height: 50px;
}
.card-header:first-child {
    border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
}

.widget-49 .widget-49-title-wrapper {
  display: flex;
  align-items: center;
}

.widget-49 .widget-49-title-wrapper .widget-49-date-primary {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background-color: #edf1fc;
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
}

.widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
  color: #4e73e5;
  font-weight: 500;
  font-size: 1.5rem;
  line-height: 1;
}

.widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
  color: #4e73e5;
  line-height: 1;
  font-size: 1rem;
  text-transform: uppercase;
}
.widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-day {
  color: #36afff;
  font-weight: 500;
  font-size: 1.5rem;
  line-height: 1;
}

.widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-month {
  color: #36afff;
  line-height: 1;
  font-size: 1rem;
  text-transform: uppercase;
}


.widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
  display: flex;
  flex-direction: column;
  margin-left: 1rem;
}

.widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
  color: #3c4142;
  font-size: 14px;
}

.widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
  color: #B1BAC5;
  font-size: 13px;
}

.widget-49 .widget-49-meeting-points {
  font-weight: 400;
  font-size: 13px;
  margin-top: .5rem;
}

.widget-49 .widget-49-meeting-points .widget-49-meeting-item {
  display: list-item;
  color: #727686;
}

.widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
  margin-left: .5rem;
}





</style>
<body>
<div class="container" style="margin-top: 10%">
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Adjust the column size based on your layout -->
            <div class="card card-margin">
                <div class="card-header no-border">
                    <h5 class="card-title">Tax Portal Account</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="widget-49">
                        <div class="widget-49-title-wrapper">
                            <div class="widget-49-date-primary">
                                <span id="current-date-day" class="widget-49-date-day"></span>
                                <span id="current-date-month" class="widget-49-date-month"></span>
                            </div>
                            <div class="widget-49-meeting-info">
                                <span class="widget-49-pro-title">Account Registration</span>
                                <span class="widget-49-meeting-time" id="current-time"></span>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <span>Thank you for registering</span>
                            <p>Your account is being reviewed</p>
                            <p>You will receive Email once it is done</p>
                        </div>
                        <a href="/" class="btn btnn">Back to Portal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
           
</body>
<script>
    // Get current date and time
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.toLocaleString('default', { month: 'short' });
    var hours = currentDate.getHours();
    var minutes = currentDate.getMinutes();

    // Update HTML elements with current date and time
    document.getElementById('current-date-day').textContent = day;
    document.getElementById('current-date-month').textContent = month;
    document.getElementById('current-time').textContent = hours + ':' + (minutes < 10 ? '0' : '') + minutes;
</script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</html>