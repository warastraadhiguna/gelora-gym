<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Benefit;
use App\Models\Building;
use App\Models\BlogCategory;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data =[
            'content' => "main/home/index",
            'buildings' => Building::where("is_active", "1")->get(),
            'benefits' => Benefit::get(),
            'questions' => Question::where("is_published", "1")->orderby('index', 'asc')->get(),
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function blog()
    {
        $shownBlogPerPage = 6;

        $page = Request()->input("page");
        $page = $page ? $page : 1;

        $search = Request()->input("search");
        $category = Request()->input("category");
        $category = $category ? $category : 0;

        $blogs = $category > 0 ?
        Blog::where("is_published", "1")->where([
            ["title", 'like', '%' . $search .'%'  ],
            ["blog_category_id", '=', $category  ]
        ])
        :
        Blog::where("is_published", "1")->where([["title", 'like', '%' . $search .'%'  ]]);

        $totalPage = count($blogs->get()) == 0 ? 0 : ceil(count($blogs->get())/$shownBlogPerPage);

        $shownBlogList = count($blogs->get()) == 0 ? null :
        $blogs->orderBy("created_at", "DESC")->offset($shownBlogPerPage * ($page - 1))->limit($shownBlogPerPage)->get();

        $choosenCategory =  $category == 0 ? null : BlogCategory::find($category);

        $data =[
            'content' => "main/blog/index",
            'blogs' => $shownBlogList ,
            'totalPage' => $totalPage,
            'page' => $page,
            'search' => $search,
            'category' => $category,
            'choosenCategory'=> $choosenCategory ,
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function searchBlog(Request $request)
    {
        $data = $request->validate([
            'category' => 'required',
            'searchBlogString' => 'sometimes',
        ]);

        return redirect("/blog?search=" . $data['searchBlogString']);
    }

    public function detailBlog($id)
    {
        $data =[
            'content' => "main/blog/detail",
            'blog' => Blog::find($id),
        ];

        return view("main.layouts.wrapper", $data);
    }
}
