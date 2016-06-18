<html lang="en">
<head>

<meta charset='utf-8'>

  <title>Timepicker for jQuery &ndash; Demos and Documentation</title>
  <meta name="description" content="A lightweight, customizable jQuery timepicker plugin inspired by Google Calendar. Add a user-friendly javascript timepicker dropdown to your app in minutes." />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script type="text/javascript" src="jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />

  <script type="text/javascript" src="time/lib/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="time/lib/bootstrap-datepicker.css" />

  <script type="text/javascript" src="time/lib/site.js"></script>
  <link rel="stylesheet" type="text/css" href="time/lib/site.css" />

 
  <script>
  $(function() {
    $( "#timepicker" ).timepicker();
  });
  </script>
  
</head>
<body>

<br>
<br>
<br>
<br>
<br>
<br>
 
<p>Time: <input type="text" class="time" data-scroll-default="6:00am"  id="timepicker" /></p>
 
 
</body>
</html>