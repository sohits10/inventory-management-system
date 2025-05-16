<?php

namespace App\Services;


use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ItemService
{
    // Handle image upload and return the image path
    public function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('images/items');

            // Debugging
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the directory if it doesn't exist
            }
            if (!$image->isValid()) {
                return response()->json(['error' => 'Invalid image file'], 400);
            }

            try {
                // Resize and save the image
                $resizedImage = Image::make($image)
                    ->fit(300, 300) // Resize to 300x300
                    ->save($destinationPath . '/' . $imageName);

                return 'images/items/' . $imageName;
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return false;
    }

}
