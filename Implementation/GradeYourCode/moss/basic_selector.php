<?php
// example of how to use basic selector to retrieve HTML contents
include('simple_html_dom.php');
 
// get DOM from URL or file
$html = file_get_html($_GET['link']);

// find all td tags with attribite align=center
foreach($html->find('td') as $e)
    echo $e->innertext . '<br>';

?>