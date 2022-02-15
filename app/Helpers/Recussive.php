<?php

// if (!function_exists('user_all_childs_ids')) {
//         function user_all_childs_ids(\App\User $user)
//         {
//             $all_ids = [];
//             if ($user->Childs->count() > 0) {
//                 foreach ($user->Childs as $child) {
//                     $all_ids[] = $child->id;
//                     $all_ids=array_merge($all_ids,is_array(user_all_childs_ids($child))?user_all_childs_ids($child):[] );
//                 }
//             }
//             return $all_ids;
//         }
//     }
