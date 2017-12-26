<!DOCTYPE html>
<html>
  <head>
    <title>Board Log</title>
    <style>
      table {
        border-collapse: collapse;
      }

      table, th, td {
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <table border='1'>
      <tr>
        <th>Initiator</th>
        <th>Event Type</th>
        <th>Message</th>
        <th>Timestamp</th>
      <tr>
      @foreach ($events as $logEvent)
      <tr>
        <td>{{$logEvent['username']}}</td>
        <td>{{$logEvent['eventType']}}</td>
        <td>{{$logEvent['message']}}</td>
        <td>{{$logEvent['created_at']}}</td>
      </tr>
      @endforeach
    </table>
  </body>
</html>
