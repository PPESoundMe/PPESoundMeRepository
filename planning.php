<html>
<head>
<link href="../css/calendar.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="photos/logo_onglet.ico">
<title> Planning </title>
</head>
<body>
<?php
include 'calendar.php';

$calendar = new Calendar();

echo $calendar->show();
?>
</body>
</html>
