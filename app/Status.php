<?php

namespace App;

interface Status {

    const STATUS_BEFORE = 0;
    const STATUS_OPEN = 1;
    const STATUS_AFTER = 2;

    function statusString();
    function isBefore();
    function isOpen();
    function isAfter();
}
