<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;

class PageController extends Controller
{
    // public function index($slug, $subs = null)
    // {
    //     $page = Page::findBySlug($slug);

    //     if (!$page)
    //     {
    //         abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
    //     }

    //     $this->data['title'] = $page->title;
    //     $this->data['page'] = $page->withFakes();

    //     return view('pages.'.$page->template, $this->data);
    // }

    public function pages($name)
    {
        $pages = DB::table('pages')->where('name', $name)->get();
        if ($pages[0]->is_open != 1) {
            abort(404, 'Please go back to our <a href="' . url('') . '">homepage</a>.');
        }
        return view('pages', compact('pages'));
    }
}
