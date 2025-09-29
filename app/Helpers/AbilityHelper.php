<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class AbilityHelper
{
    public static function authorize(Request $request, string $ability)
    {
        if (!$request->user() || !$request->user()->tokenCan($ability)) {
            // abort(403, 'You are not authorized to perform this action.');
           abort(403, 'Unauthorized');
        }
        return $request->user();
    }
}
