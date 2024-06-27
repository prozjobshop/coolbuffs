<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotaController extends Controller
{
    public function incrementQuota(Request $request)
    {
        $user = auth()->user();

        // Assuming the package information is stored in the user model
        $package = $user->package; // 'basic' or 'premium'
        $maxQuota = $package === 'premium' ? 3 : 2;

        if ($user->quota < $maxQuota) {
            $user->quota += 1;
            $user->save();

            return response()->json(['message' => 'Quota incremented successfully']);
        }

        return response()->json(['message' => 'Quota limit reached'], 403);
    }
}
