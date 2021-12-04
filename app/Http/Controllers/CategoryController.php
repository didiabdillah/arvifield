<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Resource;

class CategoryController extends Controller
{
    // CATEGORY
    public function category()
    {
        $category = Category::orderBy('category_label', 'asc')->get();

        $view_data = [
            'category' => $category,
        ];

        return view('category.category', $view_data);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $slug = Str::slug(htmlspecialchars($request->label), '-');

        //check is category exist in DB
        if (Category::where('category_label', htmlspecialchars($label))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Failed', //Alert Message 
                'Category Already Exist' //Sub Alert Message
            );

            return redirect()->route('category_create');
        }

        $category_id =  uniqid() . dechex(strtotime(now()));

        $data = [
            'category_id' => $category_id,
            'category_label' => $label,
            'category_slug' => $slug,
        ];

        //Insert Data
        Category::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Category Added' //Sub Alert Message
        );

        return redirect()->route('category');
    }

    public function edit($id)
    {
        $category = Category::where('category_id', $id)->first();

        $view_data = [
            'category' => $category,
        ];

        return view('category.update', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $slug = Str::slug(htmlspecialchars($request->label), '-');

        //check is category exist in DB
        if (Category::where('category_label', htmlspecialchars($label))->where('category_id', '!=', $id)->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Failed', //Alert Message 
                'Category Already Exist' //Sub Alert Message
            );

            return redirect()->route('admin_category_edit', $id);
        }

        $data = [
            'category_label' => $label,
            'category_slug' => $slug,
        ];

        //Update Data
        Category::where('category_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Category Updated' //Sub Alert Message
        );

        return redirect()->route('category');
    }

    public function destroy($id)
    {
        Category::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Category Deleted' //Sub Alert Message
        );

        return redirect()->route('category');
    }
    // END CATEGORY

}
