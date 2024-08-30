<?php

if (! function_exists('getActivityLogBadge')) {
    /**
     * Get notification badge.
     *
     * @return string
     */
    function getActivityLogBadge($type)
    {
        $badge = '<span class="badge bg-warning text-dark">Update</span>';

        if ($type == 'created') {
            $badge = '<span class="badge bg-primary">Create</span>';
        }
        if ($type == 'deleted') {
            $badge = '<span class="badge bg-danger">Delete</span>';
        }

        return $badge;
    }
}
