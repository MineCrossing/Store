<?php
//Alter price display, currently not needed due to updated version of Cart.
function presentPrice($price) {
    return '£'.number_format($price / 100, 2, '.', '');
}

//Active Category Highlight.
function setActiveCategory($category, $output = 'active') {
    return request()->category == $category ? $output : '';
}

?>