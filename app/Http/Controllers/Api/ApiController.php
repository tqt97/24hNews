<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables;

class ApiController extends Controller
{
    public function getCategories()
    {
        $query = Category::select('id', 'name', 'is_highlight', 'status', 'created_at');
        if (request('date_filter')) {
            $filter_date = now()->subDays(request('date_filter'))->toDateString();
            $query->where('created_at', '>=', $filter_date);
        }
        return datatables($query)->toJson();
    }
    public function getPosts()
    {
        $query = Post::select('id', 'title', 'is_highlight', 'status', 'created_at');
        if (request('date_filter')) {
            $filter_date = now()->subDays(request('date_filter'))->toDateString();
            $query->where('created_at', '>=', $filter_date);
        }
        return datatables($query)->toJson();
    }
}
