<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $data = $this->user->getAll();

        if($data) {
            return response()->json([
                'success'   => true,
                'data'      => $data,
                'message'   => 'Data successfully retrieved'
            ], 200);
        }

        return response()->json([
            'success'   => false,
            'data'      => [],
            'message'   => 'Something went wrong'
        ], 400);
    }
}
