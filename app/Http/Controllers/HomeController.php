<?php

namespace App\Http\Controllers;

use App\blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }
       public function about_us()
    {
        return view('pages.about_us');
    }
    public function contact_us()
    {
        return view('pages.contact_us');
    }
    public function blog()
    {
        $blog_count = DB::table('blogs')->count();
        $ran_blogs = DB::table('blogs')
                            ->inRandomOrder()
                            ->paginate(6);
        $blogs = DB::table('blogs')
                            ->paginate(6);
                            // ->get();
        $blog1 = DB::table('blogs')->find(($blog_count));
        $blog2 = DB::table('blogs')->find(($blog_count - 1));
        $blog3 = DB::table('blogs')->find(($blog_count - 2));
        $blog4 = DB::table('blogs')->find(($blog_count - 3));
        $blog5 = DB::table('blogs')->find(($blog_count - 4));
        return view('pages.blog2',
        [
            'blogs' => $blogs,
            'blog1' => $blog1,
            'blog2' => $blog2,
            'blog3' => $blog3,
            'blog4' => $blog4,
            'blog5' => $blog5,
            'ran_blogs' => $ran_blogs
        ]
    );
    }
    public function singleblog($blog)
    {
        $blog_data = blog::find($blog);
        $blog_count = DB::table('blogs')->count();
        $ran_blogs = DB::table('blogs')
                            ->inRandomOrder()
                            ->paginate(6);
        $blogs = DB::table('blogs')
                            ->paginate(6);
                            // ->get();
        $blog1 = DB::table('blogs')->find(($blog_count));
        $blog2 = DB::table('blogs')->find(($blog_count - 1));
        $blog3 = DB::table('blogs')->find(($blog_count - 2));
        $blog4 = DB::table('blogs')->find(($blog_count - 3));
        $blog5 = DB::table('blogs')->find(($blog_count - 4));
        return view('pages.single_blog',
        [
            'blog_data' => $blog_data,
            'blogs' => $blogs,
            'blog1' => $blog1,
            'blog2' => $blog2,
            'blog3' => $blog3,
            'blog4' => $blog4,
            'blog5' => $blog5,
            'ran_blogs' => $ran_blogs
        ]
    );
    }
    public function opportunities()
    {
        $count = DB::table('opportunities')->count();
        $op_ex = DB::table('opportunities')
                            ->where('status_slug', 0)
                            ->orderBy('updated_at', 'desc')
                            ->paginate(($count+10));
        $op_av = DB::table('opportunities')
                            ->where('status_slug', 1)
                            ->orderBy('updated_at', 'desc')
                            ->paginate(($count+10));
        $op_not_av = DB::table('opportunities')
                            ->where('status_slug', 2)
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10);
        return view('pages.opportunities',
        [
            'op_ex' =>  $op_ex,
            'op_av' => $op_av,
            'op_not_av' => $op_not_av
        ]
    );
    }
    public function singleopportunities(){
        return view("pages.single_opportunities");
    }
}
