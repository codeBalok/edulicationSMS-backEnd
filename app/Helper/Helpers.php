<?php

function getStoragePath() {
//    return url('/') . '/public' . \Storage::url('');
    return url('/') . \Storage::url('');
    // return asset('storage/');
}

function DefaultProfileImage() {
    return url('/') . "/admin/image/" . 'default_profile.png';
}
