<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Source;
use App\Models\Country;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $all_news = News::all();
        return view('user.news.index')
            ->with('all_news', $all_news);
    }

    public function show($news_id)
    {
        $news = News::findOrFail($news_id);
        return view('user.news.detail')
            ->with('news', $news);
    }
    public function filter()
    {
        // tentative method
        $all_news = News::all();
        return view('user.news.filter')
            ->with('all_news', $all_news);
    }

    public function showFavoritePage()
    {
        $all_news = News::all();
        $sources = Source::all();
        $country = Country::all();
        return view('user.news.favorite')->with('all_news', $all_news)->with('sources', $sources)->with('countries', $country);
    }

    public function showNonUser()
    {
        $country = Country::all();
        return view('user.news.non_user')->with('countries', $country);
    }

    public function showSearch(Request $request)
    {
        $request->search_keyword;
        $search_keyword = $request->search_keyword;
        $all_news = News::where('description', 'like', "%{$search_keyword}%")
            ->orWhere('content', 'like',"%{$search_keyword}%")
            ->orWhere('title', 'like', "%{$search_keyword}%")->with()->get();
            dd($all_news);
            return view('user.news.search')->with('all_news', $all_news);
        
}

}