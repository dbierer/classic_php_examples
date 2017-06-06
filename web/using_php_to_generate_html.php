<?php 
$items = ['en' => 'English', 
        'fr' => 'francais',
        'de' => 'Deutsch', 
        'es' => 'Espanol'];

function htmlSelectHtml($items)
{
    $html = '<select name="test">';
    //// loop through key / value pairs to create <option> tags
    foreach ($items as $key => $index){
        $html .= '<option value="' . $key . '">' . $items[$key] . '</option>';
    }
    $html .= '</select>';
    return $html;
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form method="post">
<?php echo htmlSelectHtml($items); ?>
<input type="submit" />
</form>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
