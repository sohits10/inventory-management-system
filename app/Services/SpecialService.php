<?php

namespace App\Services;

use App\Models\Special;

class SpecialService
{
    // Fetch all specials
    public function getAllSpecials()
    {
        return Special::with('item')->latest()->get();
    }

    // Create a new special
    public function createSpecial(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('specials', 'public'); // Store image in public/specials
        }
        return Special::create($data);
    }

    // Update an existing special
    public function updateSpecial(Special $special, array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('specials', 'public'); // Update image
        }
        return $special->update($data);
    }

    // Delete a special
    public function deleteSpecial(Special $special)
    {
        if ($special->image) {
            \Storage::delete('public/' . $special->image); // Delete image
        }
        return $special->delete();
    }
}
