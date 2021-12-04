<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Resource;
use App\Models\Category;
use App\Models\Source;

class ResourceController extends Controller
{
    // RESOURCE
    public function resource()
    {
        // $resource = Resource::leftjoin('categories', 'resources.resource_category_id', '=', 'categories.category_id')
        //     ->leftjoin('sources', 'resources.resource_source_id', '=', 'sources.source_id')
        //     ->leftjoin('authors', 'resources.resource_author_id', '=', 'authors.author_id')
        //     ->orderBy('resources.created_at', 'desc')->get();

        // $view_data = [
        //     'resource' => $resource,
        // ];

        return view('resource.resource');
    }

    public function create()
    {
        // $source = Source::orderBy('source_label', 'asc')->get();
        // $category = Category::orderBy('category_label', 'asc')->get();

        // $view_data = [
        //     'source' => $source,
        //     'category' => $category,
        // ];

        return view('resource.create');
    }

    public function store(Request $request)
    {
        // Input Validation
        if ($request->file('file_preview') != NULL) {
            $request->validate(
                [
                    'label'  => 'required|max:255',
                    'files'  => 'required|array',
                    'files.*'  => 'required|max:255',
                    'files_raw'  => 'required|array',
                    'files_raw.*'  => 'required|max:255',
                    'files_version'  => 'required|array',
                    'files_version.*'  => 'max:255',
                    'files_origin_link'  => 'required|array',
                    'files_origin_link.*'  => 'max:255',
                    'file_preview'  => 'required|array',
                    'file_preview.*'  => 'required|max:8000|mimes:jpg,jpeg,png,gif',
                    'tag'  => 'required|array',
                    'tag.*'  => 'required|max:255',
                    'desc'  => 'max:65000',
                ]
            );
        } else {
            $request->validate(
                [
                    'label'  => 'required|max:255',
                    'files'  => 'required|array',
                    'files.*'  => 'required|max:255',
                    'files_raw'  => 'required|array',
                    'files_raw.*'  => 'required|max:255',
                    'files_version'  => 'required|array',
                    'files_version.*'  => 'max:255',
                    'files_origin_link'  => 'required|array',
                    'files_origin_link.*'  => 'max:255',
                    'previews'  => 'required|array',
                    'previews.*'  => 'required|max:255',
                    'tag'  => 'required|array',
                    'tag.*'  => 'required|max:255',
                    'desc'  => 'max:65000',
                ]
            );
        }

        $label = htmlspecialchars($request->label);
        $source = htmlspecialchars($request->source);
        $author = htmlspecialchars($request->author);
        $tag = $request->tag;
        $desc = $request->desc;
        $files = $request->input('files');
        $files_version = $request->input('files_version');
        $files_raw = $request->input('files_raw');
        $files_origin_link = $request->input('files_origin_link');
        $category = htmlspecialchars($request->category);
        $previews = ($request->file('file_preview') != NULL) ? $request->file('file_preview') : $request->input('previews');

        $slug = Str::slug($label, '-');

        // Cek Slug
        if (Resource::where('resource_slug', $slug)->count() > 0) {
            $slug = $slug . dechex(strtotime(now()));
        }

        $resource_id =  uniqid() . dechex(strtotime(now()));

        $data = [
            'resource_id' => $resource_id,
            'resource_category_id' => $category,
            'resource_user_id' => Session::get('user_id'),
            'resource_source_id' => ($source == "") ? NULL : $source,
            'resource_author_id' => ($author == "") ? NULL : $author,
            'resource_label' => $label,
            'resource_slug' => $slug,
            'resource_desc' => $desc,
            'resource_thumbnail' => "https://media.discordapp.net/attachments/889794209920471061/890216449870815252/image_1.jpg?width=925&height=473",
        ];

        //Insert Data
        Resource::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Resource Added' //Sub Alert Message
        );
        return redirect()->route('resource');
    }

    public function edit($id)
    {
        $source = Source::orderBy('source_label', 'asc')->get();
        $category = Category::orderBy('category_label', 'asc')->get();
        $resource = Resource::where('resource_id', $id)->first();

        $view_data = [
            'source' => $source,
            'resource' => $resource,
            'category' => $category,
        ];

        return view('ADMIN.resource.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'tag'  => 'required',
                'desc'  => 'max:65000',
                'tag'  => 'required|array',
                'tag.*'  => 'required|max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $tag = $request->tag;
        $source = htmlspecialchars($request->source);
        $author = htmlspecialchars($request->author);
        $desc = $request->desc;
        $category = htmlspecialchars($request->category);
        $change_slug = htmlspecialchars($request->change_slug);

        $slug = Str::slug($label, '-');

        // Cek Slug
        if (Resource::where('resource_slug', $slug)->where('resource_id', '!=', $id)->count() > 0) {
            $slug = $slug . dechex(strtotime(now()));
        }

        if ($change_slug != "") {
            $data = [
                'resource_category_id' => $category,
                'resource_source_id' => ($source == "") ? NULL : $source,
                'resource_author_id' => ($author == "") ? NULL : $author,
                'resource_label' => $label,
                'resource_slug' => $slug,
                'resource_desc' => $desc,
            ];

            //Update Data
            Resource::where('resource_id', $id)->update($data);
        } else {
            $data = [
                'resource_category_id' => $category,
                'resource_source_id' => ($source == "") ? NULL : $source,
                'resource_author_id' => ($author == "") ? NULL : $author,
                'resource_label' => $label,
                'resource_desc' => $desc,
            ];

            //Update Data
            Resource::where('resource_id', $id)->update($data);
        }

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Resource Updated' //Sub Alert Message
        );

        return redirect()->route('resource');
    }

    public function destroy($id)
    {
        Resource::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Resource Deleted' //Sub Alert Message
        );

        return redirect()->route('resource');
    }

    // END RESOURCE
}
