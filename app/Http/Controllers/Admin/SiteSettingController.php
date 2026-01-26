<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        
        // Default settings structure
        $defaultGroups = [
            'general' => [
                'site_name' => SiteSetting::get('site_name', 'Hostal Real La Molina'),
                'site_description' => SiteSetting::get('site_description', ''),
                'site_tagline' => SiteSetting::get('site_tagline', ''),
                'site_logo' => SiteSetting::get('site_logo', ''),
            ],
            'contact' => [
                'contact_email' => SiteSetting::get('contact_email', ''),
                'contact_phone' => SiteSetting::get('contact_phone', ''),
                'contact_address' => SiteSetting::get('contact_address', ''),
                'contact_whatsapp' => SiteSetting::get('contact_whatsapp', ''),
            ],
            'social' => [
                'social_facebook' => SiteSetting::get('social_facebook', ''),
                'social_instagram' => SiteSetting::get('social_instagram', ''),
                'social_twitter' => SiteSetting::get('social_twitter', ''),
                'social_linkedin' => SiteSetting::get('social_linkedin', ''),
            ],
            'seo' => [
                'seo_title' => SiteSetting::get('seo_title', ''),
                'seo_description' => SiteSetting::get('seo_description', ''),
                'seo_keywords' => SiteSetting::get('seo_keywords', ''),
                'seo_google_analytics' => SiteSetting::get('seo_google_analytics', ''),
            ],
            'email' => [
                'email_from_name' => SiteSetting::get('email_from_name', 'Hostal Real La Molina'),
                'email_from_address' => SiteSetting::get('email_from_address', ''),
                'email_smtp_host' => SiteSetting::get('email_smtp_host', ''),
                'email_smtp_port' => SiteSetting::get('email_smtp_port', '587'),
                'email_smtp_username' => SiteSetting::get('email_smtp_username', ''),
                'email_smtp_password' => SiteSetting::get('email_smtp_password', ''),
            ],
            'notifications' => [
                'notify_new_reservation' => SiteSetting::get('notify_new_reservation', '1'),
                'notify_reservation_confirmed' => SiteSetting::get('notify_reservation_confirmed', '1'),
                'notify_reservation_cancelled' => SiteSetting::get('notify_reservation_cancelled', '1'),
                'notify_new_review' => SiteSetting::get('notify_new_review', '1'),
            ],
            'appearance' => [
                'primary_color' => SiteSetting::get('primary_color', '#C9A24D'),
                'secondary_color' => SiteSetting::get('secondary_color', '#F5EFE6'),
                'footer_text' => SiteSetting::get('footer_text', ''),
            ],
        ];
        
        return view('admin.settings.index', compact('settings', 'defaultGroups'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Aumentado a 10MB y agregado webp
        ]);

        // Validar campos requeridos en el servidor
        if (empty($request->settings['site_name'])) {
            return redirect()->back()->withErrors(['settings.site_name' => 'El nombre del hostal es obligatorio.'])->withInput();
        }

        if (empty($request->settings['contact_email']) || !filter_var($request->settings['contact_email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withErrors(['settings.contact_email' => 'El email de contacto es obligatorio y debe ser válido.'])->withInput();
        }

        // Handle logo upload with automatic resizing
        $logoSaved = false;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logo = $request->file('logo');
            
            try {
                // Get image info
                $imageInfo = @getimagesize($logo->getRealPath());
                if (!$imageInfo) {
                    // If getimagesize fails, try simple storage
                    throw new \Exception('Invalid image file or unsupported format');
                }
                
                list($originalWidth, $originalHeight, $imageType) = $imageInfo;
                
                // Define max dimensions (logo should be max 500x500, maintaining aspect ratio)
                $maxSize = 500;
                
                // Calculate new dimensions maintaining aspect ratio
                $ratio = min($maxSize / $originalWidth, $maxSize / $originalHeight);
                $newWidth = (int)($originalWidth * $ratio);
                $newHeight = (int)($originalHeight * $ratio);
                
                // Create image resource based on type
                $sourceImage = null;
                switch ($imageType) {
                    case IMAGETYPE_JPEG:
                        $sourceImage = @imagecreatefromjpeg($logo->getRealPath());
                        break;
                    case IMAGETYPE_PNG:
                        $sourceImage = @imagecreatefrompng($logo->getRealPath());
                        break;
                    case IMAGETYPE_GIF:
                        $sourceImage = @imagecreatefromgif($logo->getRealPath());
                        break;
                    case IMAGETYPE_WEBP:
                        if (function_exists('imagecreatefromwebp')) {
                            $sourceImage = @imagecreatefromwebp($logo->getRealPath());
                        }
                        break;
                }
                
                if (!$sourceImage) {
                    throw new \Exception('Could not create image resource');
                }
                
                // Create new image with calculated dimensions
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                
                // Preserve transparency for PNG and GIF
                if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
                    imagealphablending($newImage, false);
                    imagesavealpha($newImage, true);
                    $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                    imagefill($newImage, 0, 0, $transparent);
                }
                
                // Resize image
                imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
                
                // Generate filename
                $extension = strtolower($logo->getClientOriginalExtension());
                $filename = 'logo_' . time() . '.' . $extension;
                $logoPath = 'logos/' . $filename;
                $fullPath = storage_path('app/public/' . $logoPath);
                
                // Ensure directory exists
                $logoDir = storage_path('app/public/logos');
                if (!file_exists($logoDir)) {
                    mkdir($logoDir, 0755, true);
                }
                
                // Save resized image
                $saved = false;
                switch ($imageType) {
                    case IMAGETYPE_JPEG:
                        $saved = @imagejpeg($newImage, $fullPath, 90);
                        break;
                    case IMAGETYPE_PNG:
                        $saved = @imagepng($newImage, $fullPath, 9);
                        break;
                    case IMAGETYPE_GIF:
                        $saved = @imagegif($newImage, $fullPath);
                        break;
                    case IMAGETYPE_WEBP:
                        if (function_exists('imagewebp')) {
                            $saved = @imagewebp($newImage, $fullPath, 90);
                        }
                        break;
                }
                
                // Free memory
                if ($sourceImage) imagedestroy($sourceImage);
                if ($newImage) imagedestroy($newImage);
                
                if (!$saved) {
                    throw new \Exception('Could not save resized image');
                }
                
                // Delete old logo if exists
                $oldLogo = SiteSetting::get('site_logo');
                if ($oldLogo && \Storage::disk('public')->exists($oldLogo)) {
                    \Storage::disk('public')->delete($oldLogo);
                }
                
                // Save to database
                SiteSetting::updateOrCreate(
                    ['key' => 'site_logo'],
                    [
                        'value' => $logoPath,
                        'type' => 'image',
                        'group' => 'general',
                    ]
                );
                
                $logoSaved = true;
            } catch (\Exception $e) {
                // Fallback to simple storage if resizing fails
                try {
                    $logoPath = $logo->store('logos', 'public');
                    
                    // Delete old logo if exists
                    $oldLogo = SiteSetting::get('site_logo');
                    if ($oldLogo && \Storage::disk('public')->exists($oldLogo)) {
                        \Storage::disk('public')->delete($oldLogo);
                    }
                    
                    // Save to database
                    SiteSetting::updateOrCreate(
                        ['key' => 'site_logo'],
                        [
                            'value' => $logoPath,
                            'type' => 'image',
                            'group' => 'general',
                        ]
                    );
                    
                    $logoSaved = true;
                } catch (\Exception $e2) {
                    \Log::error('Logo upload failed: ' . $e2->getMessage());
                }
            }
        } elseif ($request->has('settings') && isset($request->settings['site_logo']) && empty($request->settings['site_logo'])) {
            // If logo is being removed (empty value)
            $oldLogo = SiteSetting::get('site_logo');
            if ($oldLogo && \Storage::disk('public')->exists($oldLogo)) {
                \Storage::disk('public')->delete($oldLogo);
            }
            SiteSetting::where('key', 'site_logo')->delete();
        }

        // Define groups for settings
        $groups = [
            'site_name' => 'general',
            'site_description' => 'general',
            'site_tagline' => 'general',
            'site_logo' => 'general',
            'contact_email' => 'contact',
            'contact_phone' => 'contact',
            'contact_address' => 'contact',
            'contact_whatsapp' => 'contact',
            'social_facebook' => 'social',
            'social_instagram' => 'social',
            'social_twitter' => 'social',
            'social_linkedin' => 'social',
            'seo_title' => 'seo',
            'seo_description' => 'seo',
            'seo_keywords' => 'seo',
            'seo_google_analytics' => 'seo',
            'email_from_name' => 'email',
            'email_from_address' => 'email',
            'email_smtp_host' => 'email',
            'email_smtp_port' => 'email',
            'email_smtp_username' => 'email',
            'email_smtp_password' => 'email',
            'notify_new_reservation' => 'notifications',
            'notify_reservation_confirmed' => 'notifications',
            'notify_reservation_cancelled' => 'notifications',
            'notify_new_review' => 'notifications',
            'primary_color' => 'appearance',
            'secondary_color' => 'appearance',
            'footer_text' => 'appearance',
        ];

        foreach ($request->settings as $key => $value) {
            // Skip site_logo - it's handled separately above
            if ($key === 'site_logo') {
                continue;
            }
            
            $group = $groups[$key] ?? 'general';
            $type = in_array($key, ['seo_description', 'site_description', 'contact_address', 'footer_text']) ? 'textarea' : 'text';
            
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value ?? '',
                    'type' => $type,
                    'group' => $group,
                ]
            );
        }

        // Clear cache to ensure logo updates immediately
        \Cache::forget('site_settings');
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
        
        $message = 'Configuración actualizada exitosamente.';
        if ($logoSaved) {
            $message .= ' El logo se ha actualizado correctamente y se mostrará en el sitio.';
        }
        
        return redirect()->route('admin.settings.index')->with('success', $message);
    }
}
