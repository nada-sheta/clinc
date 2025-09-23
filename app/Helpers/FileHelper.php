<?php

namespace App\Helpers;

class FileHelper
{
    // public static function get_file_url(?string $path = null)
    // {
    //     return $path ? asset($path) : asset('images/major.jpg');

    // // if ($path && file_exists(public_path($path))) {
    // //     return asset($path);
    // // }
    // // else return asset('site/images/01.jpg');


    // }
    public static function profile_image(?string $path = null)
{
    // لو فاضي أو null رجّع الصورة الافتراضية
    if (!$path) {
        return asset('assets/images/profile.jpg');
    }

    // لو الرابط كامل (Cloudinary أو أي URL) رجّعه زي ما هو
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        return $path;
    }
    if (str_starts_with($path, 'storage/') || str_starts_with($path, 'assets/') || str_starts_with($path, 'images/')) {
            return asset($path);
        }

        // أي باث تاني → نعتبره متخزن في storage
        return asset('storage/' . $path);
    
}
public static function major_image(?string $path = null)
{
    // لو فاضي أو null رجّع الصورة الافتراضية
    if (!$path) {
        return asset('assets/images/banner.jpg');
    }

    // لو الرابط كامل (Cloudinary أو أي URL) رجّعه زي ما هو
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        return $path;
    }
    if (str_starts_with($path, 'storage/') || str_starts_with($path, 'assets/') || str_starts_with($path, 'images/')) {
            return asset($path);
        }

        // أي باث تاني → نعتبره متخزن في storage
        return asset('storage/' . $path);

    
}

}
