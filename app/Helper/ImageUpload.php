<?php

namespace App\Helper;

use Illuminate\Http\Request;

trait ImageUpload
{
    public function upload(Request $request): string
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        return $imageName;
    }
}
