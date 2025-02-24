<?php

use Carbon\Carbon;

function formatDate($date, $format = 'd-m-Y')
{
    return Carbon::parse($date)->format($format);
}
