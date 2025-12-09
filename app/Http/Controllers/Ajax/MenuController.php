<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function searchRouter(Request $request)
    {
        $keyword = trim((string)$request->keyword);
        $module = $request->get('module', 'all');
        $limit = 30;
        $keywordLike = $keyword ? '%' . $keyword . '%' : null;
        switch ($module) {
            case 'categories':
                $query = DB::table('routers as r')
                    ->join('categories as c', function ($join) {
                        $join->on('c.id', '=', 'r.object_id')
                            ->whereNull('c.deleted_at');
                    })
                    ->where('r.module', 'categories')
                    ->select('r.id', 'r.canonical', 'r.module', 'c.name as name');

                if ($keywordLike) {
                    $query->where(function ($q) use ($keywordLike) {
                        $q->where('r.canonical', 'like', $keywordLike)
                            ->orWhere('c.name', 'like', $keywordLike);
                    });
                }
                break;

            case 'products':
                $query = DB::table('routers as r')
                    ->join('products as p', function ($join) {
                        $join->on('p.id', '=', 'r.object_id')
                            ->whereNull('p.deleted_at');
                    })
                    ->where('r.module', 'products')
                    ->select('r.id', 'r.canonical', 'r.module', 'p.name as name');

                if ($keywordLike) {
                    $query->where(function ($q) use ($keywordLike) {
                        $q->where('r.canonical', 'like', $keywordLike)
                            ->orWhere('p.name', 'like', $keywordLike);
                    });
                }
                break;

            case 'brands':
                $query = DB::table('routers as r')
                    ->join('brands as b', function ($join) {
                        $join->on('b.id', '=', 'r.object_id')
                            ->whereNull('b.deleted_at');
                    })
                    ->where('r.module', 'brands')
                    ->select('r.id', 'r.canonical', 'r.module', 'b.name as name');

                if ($keywordLike) {
                    $query->where(function ($q) use ($keywordLike) {
                        $q->where('r.canonical', 'like', $keywordLike)
                            ->orWhere('b.name', 'like', $keywordLike);
                    });
                }
                break;

            case 'posts':
                $query = DB::table('routers as r')
                    ->join('posts as po', function ($join) {
                        $join->on('po.id', '=', 'r.object_id')
                            ->whereNull('po.deleted_at');
                    })
                    ->where('r.module', 'posts')
                    ->select('r.id', 'r.canonical', 'r.module', 'po.name as name');

                if ($keywordLike) {
                    $query->where(function ($q) use ($keywordLike) {
                        $q->where('r.canonical', 'like', $keywordLike)
                            ->orWhere('po.name', 'like', $keywordLike);
                    });
                }
                break;

            case 'post_catalogues':
                $query = DB::table('routers as r')
                    ->join('post_catalogues as pc', function ($join) {
                        $join->on('pc.id', '=', 'r.object_id')
                            ->whereNull('pc.deleted_at');
                    })
                    ->where('r.module', 'post_catalogue')
                    ->select('r.id', 'r.canonical', 'r.module', 'pc.name as name');

                if ($keywordLike) {
                    $query->where(function ($q) use ($keywordLike) {
                        $q->where('r.canonical', 'like', $keywordLike)
                            ->orWhere('pc.name', 'like', $keywordLike);
                    });
                }
                break;

            default:
                $query = DB::table('routers as r')
                    ->leftJoin('categories as c', function ($join) {
                        $join->on('c.id', '=', 'r.object_id')
                            ->whereNull('c.deleted_at');
                    })
                    ->leftJoin('products as p', function ($join) {
                        $join->on('p.id', '=', 'r.object_id')
                            ->whereNull('p.deleted_at');
                    })
                    ->leftJoin('brands as b', function ($join) {
                        $join->on('b.id', '=', 'r.object_id')
                            ->whereNull('b.deleted_at');
                    })
                    ->leftJoin('posts as po', function ($join) {
                        $join->on('po.id', '=', 'r.object_id')
                            ->whereNull('po.deleted_at');
                    })
                    ->leftJoin('post_catalogues as pc', function ($join) {
                        $join->on('pc.id', '=', 'r.object_id')
                            ->whereNull('pc.deleted_at');
                    })
                    ->select(
                        'r.id',
                        'r.canonical',
                        'r.module',
                        DB::raw("
                            COALESCE(
                                c.name,
                                p.name,
                                b.name,
                                po.name,
                                pc.name,
                                r.canonical
                            ) AS name
                        ")
                    );
                if ($keywordLike) {
                    $query->where(function ($q) use ($keywordLike) {
                        $q->where('r.canonical', 'like', $keywordLike)
                            ->orWhere('c.name', 'like', $keywordLike)
                            ->orWhere('p.name', 'like', $keywordLike)
                            ->orWhere('b.name', 'like', $keywordLike)
                            ->orWhere('po.name', 'like', $keywordLike)
                            ->orWhere('pc.name', 'like', $keywordLike);
                    });
                }
                break;
        }
        $routers = $query->orderByDesc('r.id')->limit($limit)->get();
        return response()->json([
            'status' => true,
            'data' => $routers,
        ]);
    }
}
