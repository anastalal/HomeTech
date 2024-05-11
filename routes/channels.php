<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
| Examples include notifications about changes to their account, new messages, or any other personal alerts.
| Examples reset password
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
     // The function checks if the authenticated user's ID matches the ID in the channel name.
    return (int) $user->id === (int) $id;
});