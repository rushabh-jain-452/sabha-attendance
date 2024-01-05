<?php
function calculate_age($dob) {
    $year = (date('Y') - date('Y',strtotime($dob)));
    return $year;
}
?>