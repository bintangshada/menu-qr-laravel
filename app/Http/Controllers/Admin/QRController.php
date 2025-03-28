<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generate($id){
        $menu = Menu::findOrFail($id);
        $url = route('menu.show', ['id' => $menu->id]);
    
        $qr = QrCode::format('png')->size(200)->generate($url);
        $qrPath = "qr_codes/menu_{$menu->id}.png";
    
        Storage::disk('s3')->put($qrPath, $qr, 'public');
    
        $menu->update(['qr_code_path' => $qrPath]);
    
        $qrUrl = Storage::disk('s3')->url($qrPath);
    
        return view('admin.qr', compact('menu', 'qrUrl', 'url'));
    }

    public function download($id){
        $menu = Menu::findOrFail($id);
        $qrPath = "qr_codes/menu_{$menu->id}.png";
    
        if (!Storage::disk('s3')->exists($qrPath)) {
            return redirect()->back()->with('error', 'QR Code tidak ditemukan.');
        }
    
        $fileStream = Storage::disk('s3')->readStream($qrPath);
    
        return response()->streamDownload(function () use ($fileStream) {
            fpassthru($fileStream);
        }, "menu_{$menu->id}.png");
    }
}
