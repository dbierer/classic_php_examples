<?php
// multiple recipients
$to  = 'doug@unlikelysource.com' . ', '; // note the comma
$to .= 'test@unlikelysource.com';

// subject
$month = date("M",time());
$subject = "Birthday Reminders for $month";

// message
$message = <<<EOT
<html>
<head>
  <title>Followup Reminders for $month</title>
</head>
<body>
  <p>Please be sure to followup with these individuals in $month!</p>
  <table>
    <tr>
      <th>Person</th><th>Title</th><th>Company</th>
    </tr>
    <tr>
      <td>Joe Morgan</td><td>CTO</td><td>Yahoo</td>
    </tr>
    <tr>
      <td>Sally Schmidt</td><td>VP of Development</td><td>Google</td>
    </tr>
  </table>
</body>
</html>
EOT;

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: ' . $to . "\r\n";
$headers .= 'From: Followup Reminder <followup@company.com>' . "\r\n";
$headers .= 'Cc: followuparchive@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
