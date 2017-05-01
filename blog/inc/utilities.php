<?php
   function shortenText($text, $size) {
    if (strlen($text) > $size)
        return substr($text, 0, $size).' ...';
    return $text;
}


 $content=shortenText($aCols['posts_content'],100);