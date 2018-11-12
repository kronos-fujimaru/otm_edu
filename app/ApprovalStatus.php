<?php

namespace App;

interface ApprovalStatus {

    const STATUS_YET = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECT = 2;

    function adminStatusString();
    function managerStatusString();
    function isAdminYet();
    function isManagerYet();
    function isAdminApproved();
    function isManagerApproved();
    function isAdminReject();
    function isManagerReject();
}
