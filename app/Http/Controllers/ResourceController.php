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
        $resource = Resource::leftjoin('categories', 'resources.resource_category_id', '=', 'categories.category_id')
            ->leftjoin('sources', 'resources.resource_source_id', '=', 'sources.source_id')
            ->orderBy('resources.created_at', 'desc')->get();

        $view_data = [
            'resource' => $resource,
        ];

        return view('resource.resource', $view_data);
    }

    public function create()
    {
        $source = Source::orderBy('source_label', 'asc')->get();
        $category = Category::orderBy('category_label', 'asc')->get();

        $view_data = [
            'source' => $source,
            'category' => $category,
        ];

        return view('resource.create', $view_data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'label'  => 'required|max:255',
                'desc'  => 'max:65000',
                'link'  => 'required|max:66666',
                'preview'  => 'max:66666',
            ]
        );

        $label = htmlspecialchars($request->label);
        $source = htmlspecialchars($request->source);
        $category = htmlspecialchars($request->category);
        $desc = $request->desc;
        $link = htmlspecialchars($request->link);
        $preview = htmlspecialchars($request->preview);
        $active = $request->active;
        $slug = Str::slug($label, '-');

        // Cek Slug
        if (Resource::where('resource_slug', $slug)->count() > 0) {
            $slug = $slug . dechex(strtotime(now()));
        }

        $resource_id =  uniqid() . dechex(strtotime(now()));

        // Link JSON String
        $split_link = explode(";", $link);
        $new_link = [];
        foreach ($split_link as $data) {
            $fetch_link = str_replace(" ", "", $data);
            if ($fetch_link) {
                $new_link[] = $fetch_link;
            }
        }
        $json_link = json_encode($new_link, JSON_UNESCAPED_SLASHES);

        // Preview JSON String
        $split_preview = explode(";", $preview);
        $new_preview = [];
        foreach ($split_preview as $data) {
            $fetch_preview = str_replace(" ", "", $data);
            if ($fetch_preview) {
                $new_preview[] = $fetch_preview;
            }
        }
        $json_preview = json_encode($new_preview, JSON_UNESCAPED_SLASHES);

        $data = [
            'resource_id' => $resource_id,
            'resource_category_id' => ($category == "") ? NULL : $category,
            'resource_source_id' => ($source == "") ? NULL : $source,
            'resource_label' => $label,
            'resource_slug' => $slug,
            'resource_desc' => $desc,
            'resource_active' => ($active == 'on') ? true : false,
            'resource_link' => "$json_link",
            'resource_preview' => "$json_preview",
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

        return view('resource.update', $view_data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'label'  => 'required|max:255',
                'desc'  => 'max:65000',
                'link'  => 'required|max:66666',
                'preview'  => 'max:66666',
            ]
        );

        $label = htmlspecialchars($request->label);
        $source = htmlspecialchars($request->source);
        $category = htmlspecialchars($request->category);
        $desc = $request->desc;
        $link = htmlspecialchars($request->link);
        $preview = htmlspecialchars($request->preview);
        $active = $request->active;
        $slug = Str::slug($label, '-');

        // Cek Slug
        if (Resource::where('resource_slug', $slug)->where('resource_id', '!=', $id)->count() > 0) {
            $slug = $slug . dechex(strtotime(now()));
        }

        // Link JSON String
        $split_link = explode(";", $link);
        $new_link = [];
        foreach ($split_link as $data) {
            $fetch_link = str_replace(" ", "", $data);
            if ($fetch_link) {
                $new_link[] = $fetch_link;
            }
        }
        $json_link = json_encode($new_link, JSON_UNESCAPED_SLASHES);

        // Preview JSON String
        $split_preview = explode(";", $preview);
        $new_preview = [];
        foreach ($split_preview as $data) {
            $fetch_preview = str_replace(" ", "", $data);
            if ($fetch_preview) {
                $new_preview[] = $fetch_preview;
            }
        }
        $json_preview = json_encode($new_preview, JSON_UNESCAPED_SLASHES);

        $data = [
            'resource_category_id' => $category,
            'resource_category_id' => ($category == "") ? NULL : $category,
            'resource_source_id' => ($source == "") ? NULL : $source,
            'resource_label' => $label,
            'resource_slug' => $slug,
            'resource_desc' => $desc,
            'resource_active' => ($active == 'on') ? true : false,
            'resource_link' => "$json_link",
            'resource_preview' => "$json_preview",
        ];

        //Update Data
        Resource::where('resource_id', $id)->update($data);

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
