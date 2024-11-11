<?php

use Illuminate\Support\Facades\Session;

function displayAlert()
{
    if (Session::has('message')) {
        list($type, $message) = explode('|', Session::get('message'));

        // Map the message type to Bootstrap alert classes
        $type = match ($type) {
            'error' => 'danger',
            'message' => 'info',
            'success' => 'success',
            default => 'secondary'
        };

        return sprintf('<div class="alert alert-%s">%s</div>', $type, $message);
    }

    return '';
}
