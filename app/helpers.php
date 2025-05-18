<?php 
use App\Models\User;

function getUser($param) {
    $user = User::where('id',$param)
            ->orWhere('email',$param)
            ->first();

    return $user;
}

// function pinChecker($pin) {
//     $userId = auth()->user()->id;
//     $wallet = Wallet::where('user_id', $userId)->first();

//     if(!$wallet) return false;

//     if ($wallet->pin == $pin) {
//         return true;
//     } else {
//         return false;

//     }
// }