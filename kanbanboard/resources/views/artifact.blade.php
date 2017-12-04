<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
  </head>
  <body>
    <p>I see London, I see Sam's Town</p>
    <ul>
      @foreach ($artifacts as $artifact)
          <li>{{$artifact->body}}</li>
      @endforeach

    </ul>
  </body>
</html>
