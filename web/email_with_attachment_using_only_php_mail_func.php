<?php
// Send an HTML email with a PDF attachment using only PHP's mail().

$to       = 'recipient@example.com';
$from     = 'sender@example.com';
$subject  = 'Your PDF document';
$pdfPath  = __DIR__ . '/document.pdf';
$html     = '<html><body><h1>Hello!</h1><p>Please find the <b>PDF</b> attached.</p></body></html>';

if (!is_readable($pdfPath)) {
    exit("Cannot read attachment: $pdfPath\n");
}

$eol      = "\r\n";
$boundary = 'b_' . bin2hex(random_bytes(16));
$fileName = basename($pdfPath);
$pdfData  = chunk_split(base64_encode(file_get_contents($pdfPath)));

// Headers
$headers  = "From: $from" . $eol;
$headers .= "Reply-To: $from" . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";

// Body: HTML part
$body  = "--$boundary" . $eol;
$body .= "Content-Type: text/html; charset=UTF-8" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol . $eol;
$body .= chunk_split(base64_encode($html)) . $eol;

// Body: PDF attachment part
$body .= "--$boundary" . $eol;
$body .= "Content-Type: application/pdf; name=\"$fileName\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment; filename=\"$fileName\"" . $eol . $eol;
$body .= $pdfData . $eol;

// Closing boundary
$body .= "--$boundary--";

// Encode subject for non-ASCII safety
$encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

if (mail($to, $encodedSubject, $body, $headers)) {
    echo "Email sent.\n";
} else {
    echo "Email failed to send.\n";
}
