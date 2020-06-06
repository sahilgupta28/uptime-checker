<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet">
    <title>@env('APP_NAME')</title>
  </head>
  <body>
    <center><h1>Weekly Report</h1></center>
    <table border="1px solid" width="100%">
      <caption>In-depth View</caption>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Uptime history - 7 days</th>
        <th>Uptime</th>
        <th>Total downtime</th>
      </tr>
      @foreach($weekly_report as $website)
        <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$website->title}} <small>{{$website->domain}}</small></td>
        <td>
          @foreach($website->week_report as $day)
            @if($day)
              <img src="{{asset('images/times-circle.png')}}" width="15px">
            @else
              <img src="{{asset('images/check-circle.svg.png')}}" width="15px">
            @endif
          @endforeach
        </td>
        <td>{{$website->website_uptime}}</td>
        <td>{{$website->website_downtime}} Minutes</td>
      </tr>
      @endforeach
    </table>

    <table border="1px solid" width="100%">
      <caption>Summary</caption>
      <tr>
        <th>Checks</th>
        <th>Uptime</th>
        <th>Total downtime</th>
      </tr>
        <tr>
        <td>{{count($weekly_report)}}</td>
        <td>{{$website->user_uptime}}</td>
        <td>{{$website->user_downtime}} Minutes</td>
      </tr>
    </table>
  </body>
</html>