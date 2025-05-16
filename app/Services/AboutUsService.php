<?php

namespace App\Services;

use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;

class AboutUsService
{
    /**
     * Store the About Us content, including file uploads.
     *
     * @param array $content
     * @param string $title
     * @return AboutUs
     */
    public function storeAboutUsContent(array $content, string $title)
    {
        // Handle image upload for each paragraph
        foreach ($content['paragraphs'] as &$paragraph) {
            if (isset($paragraph['image']) && $paragraph['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Store image and get the path
                $imagePath = $paragraph['image']->store('images/about-us', 'public');
                $paragraph['image'] = $imagePath;


            }
        }

        // Save the About Us section
        return AboutUs::create([
            'title' => $title,
            'content' => json_encode($content),
        ]);
    }
}
