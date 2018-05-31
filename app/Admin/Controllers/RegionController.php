<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    public function cascading(Request $request)
    {
        // return Admin::content(function (Content $content) use ($request) {
        //     $content->header('Cascading select');
        //     $form = new Form($request->all());
        //     $form->method('GET');
        //     $form->action('/demo/china/cascading-select');
        //     $form->select('province')->options(
        //         Region::province()->pluck('name', 'id')
        //     )->load('city', '/demo/api/china/city');
        //     $form->select('city')->options(function ($id) {
        //         return Region::options($id);
        //     })->load('district', '/demo/api/china/district');
        //     $form->select('district')->options(function ($id) {
        //         return Region::options($id);
        //     });
        //     $content->row(new Box('Form', $form));
        //     if ($request->has('province')) {
        //         $content->row(new Box('Query', new Table(['key', 'value'], $request->only(['province', 'city', 'district']))));
        //     }
        // });
    }

    public function city(Request $request)
    {
        $provinceId = $request->get('q');
        return Region::city()->where('region_parent_id', $provinceId)->get([DB::raw('region_id as id'), DB::raw('region_name as text')]);
    }

    public function district(Request $request)
    {
        $cityId = $request->get('q');

        return Region::district()->where('region_parent_id', $cityId)->get([DB::raw('region_id as id'), DB::raw('region_name as text')]);
    }
}
