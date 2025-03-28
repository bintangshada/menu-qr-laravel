<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpg|max:2048'
        ]);

        $menu = Menu::create([
            'name' => $request->name,
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('menu_images', 's3');
            $menu->images()->create(['image_path' => $path]);
        }
    
        return redirect()->route('admin.dashboard')->with('success', 'Menu berhasil diunggah!');
    }

    public function index() {
        $menus = Menu::all();
        return view('admin.dashboard', compact('menus'));
    }

    public function show($id) {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }

    public function destroy($id)
    {
        $menu = Menu::with('images')->findOrFail($id);

        foreach ($menu->images as $image) {
            Storage::disk('s3')->delete($image->image_path);
        }
    
        if ($menu->qr_code_path) {
            Storage::disk('s3')->delete($menu->qr_code_path);
        }
    
        $menu->images()->delete();
        $menu->delete();
    
        return redirect()->route('admin.dashboard')->with('success', 'Menu, gambar, dan QR Code berhasil dihapus!');
    }
}
