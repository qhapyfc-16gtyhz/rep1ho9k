<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
function str2html($value){
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>