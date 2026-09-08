<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use App\Models\Announcement;
use App\Models\HomepageSection;
use App\Models\School;
use App\Models\SiteMenu;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::first();
	$sections = HomepageSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $menus = SiteMenu::query()
            ->where('site', 'school')
            ->where('location', 'navbar')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

	$news = News::query()
    	    ->where('is_active', true)
    	    ->whereNotNull('published_at')
    	    ->where('published_at', '<=', now())
    	    ->latest('published_at')
    	    ->take(3)
    	    ->get();

$announcements = Announcement::query()
    ->where('is_active', true)
    ->whereNotNull('published_at')
    ->where('published_at', '<=', now())
    ->latest('published_at')
    ->take(3)
    ->get();

        $galleries = Gallery::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with('photos')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('school.home', compact(
            'school',
	    'sections',
            'menus',
	    'news',
	    'announcements',
	    'galleries',
        ));
    }
public function profile()
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('school.profile', compact(
        'school',
        'menus'
    ));
}
public function newsIndex()
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $news = News::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->get();

    return view('school.news.index', compact(
        'school',
        'menus',
        'news',
    ));
}

public function news(string $slug)
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $news = News::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('slug', $slug)
        ->firstOrFail();

    return view('school.news.show', compact(
        'school',
        'menus',
        'news',
    ));
}
public function announcementsIndex()
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $announcements = Announcement::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->get();

    return view('school.announcements.index', compact(
        'school',
        'menus',
        'announcements',
    ));
}

public function announcement(string $slug)
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $announcement = Announcement::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('slug', $slug)
        ->firstOrFail();

    return view('school.announcements.show', compact(
        'school',
        'menus',
        'announcement',
    ));
}
public function announcementAttachment(string $slug)
{
    $announcement = Announcement::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('slug', $slug)
        ->firstOrFail();

    abort_unless($announcement->attachment, 404);

    $path = storage_path('app/public/' . $announcement->attachment);

    abort_unless(
        is_file($path),
        404
    );

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
    ]);
}
public function galleryIndex()
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $galleries = Gallery::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->with('photos')
        ->latest('published_at')
        ->get();

    return view('school.gallery.index', compact(
        'school',
        'menus',
        'galleries',
    ));
}

public function gallery(string $slug)
{
    $school = School::query()->first();

    $menus = SiteMenu::query()
        ->where('site', 'school')
        ->where('location', 'navbar')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $gallery = Gallery::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('slug', $slug)
        ->with('photos')
        ->firstOrFail();

    return view('school.gallery.show', compact(
        'school',
        'menus',
        'gallery',
    ));
}
}
