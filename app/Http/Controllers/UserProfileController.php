<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    public function showApplicationForm($id)
    {
        $userProfile = User::findOrFail($id);

        $file = $userProfile->getMedia('applicationForm')->first();

        if (!$file) {
            abort(404, 'File not found.');
        }

        return response()->file($file->getPath());
    }

    public function showContract($id)
    {
        $userProfile = User::findOrFail($id);

        $file = $userProfile->getMedia('contract')->first();

        if (!$file) {
            abort(404, 'File not found.');
        }

        return response()->file($file->getPath());
    }

    public function showCor($id)
    {
        $userProfile = User::findOrFail($id);

        $file = $userProfile->getMedia('cor')->first();

        if (!$file) {
            abort(404, 'File not found.');
        }

        return response()->file($file->getPath());
    }

    public function showValidId($id)
    {
        $userProfile = User::findOrFail($id);

        $file = $userProfile->getMedia('validID')->first();

        if (!$file) {
            abort(404, 'File not found.');
        }

        return response()->file($file->getPath());
    }

    public function showVaccineCard($id)
    {
        $userProfile = User::findOrFail($id);

        $file = $userProfile->getMedia('vaccineCard')->first();

        if (!$file) {
            abort(404, 'File not found.');
        }

        return response()->file($file->getPath());
    }

}
