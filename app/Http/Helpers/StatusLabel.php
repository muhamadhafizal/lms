<?php

if (! function_exists('getIsActiveStatus')) {
    function getIsActiveStatus(string $is_active): string
    {
        $badge = '';

        if ($is_active) {
            $badge = '<span class="badge alert alert-success mt-2">Active</span>';
        } else {
            $badge = '<span class="badge alert alert-danger mt-2">Inactive</span>';
        }

        return $badge;
    }
}

if (! function_exists('getClientSubscribed')) {
    function getClientSubscribed(string $is_subscribed): string
    {
        $badge = '';

        if ($is_subscribed) {
            $badge = '<span class="badge alert alert-success">Subscribed</span>';
        } else {
            $badge = '<span class="badge alert alert-danger">Unsubscribed</span>';
        }

        return $badge;
    }
}

if (! function_exists('getStatusYesNo')) {
    function getStatusYesNo(string $param): string
    {
        $message = '-';

        if ($param == 1) {
            $message = 'Yes';
        } elseif ($param == 0) {
            $message = 'No';
        }

        return $message;
    }
}

