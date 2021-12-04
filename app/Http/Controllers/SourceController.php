<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Source;

class SourceController extends Controller
{
    public function index()
    {
        $source = Source::orderBy('source_label', 'asc')->get();

        $view_data = [
            'source' => $source,
        ];

        return view('source.source', $view_data);
    }

    public function create()
    {
        return view('source.create');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'link'  => 'max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $link = htmlspecialchars($request->link);
        $slug = Str::slug($label, '-');
        $active = $request->active;

        //check is source exist in DB
        if (Source::where('source_label', htmlspecialchars($label))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Failed', //Alert Message 
                'Source Already Exist' //Sub Alert Message
            );

            return redirect()->route('source_create');
        }

        // Cek Slug
        if (Source::where('source_slug', $slug)->count() > 0) {
            $slug = $slug . dechex(strtotime(now()));
        }

        $source_id =  uniqid() . dechex(strtotime(now()));

        $data = [
            'source_id' => $source_id,
            'source_label' => $label,
            'source_link' => $link,
            'source_slug' => $slug,
            'source_active' => ($active == 'on') ? true : false,
        ];

        //Insert Data
        Source::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Source Added' //Sub Alert Message
        );

        return redirect()->route('source');
    }

    public function edit($id)
    {
        $source = Source::where('source_id', $id)->first();

        $view_data = [
            'source' => $source,
        ];

        return view('source.update', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'link'  => 'max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $link = htmlspecialchars($request->link);
        $slug = Str::slug($label, '-');
        $active = $request->active;

        //check is source exist in DB
        if (Source::where('source_label', htmlspecialchars($label))->where('source_id', '!=', $id)->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Failed', //Alert Message 
                'Source Already Exist' //Sub Alert Message
            );

            return redirect()->route('source_edit', $id);
        }

        // Cek Slug
        if (Source::where('source_slug', $slug)->count() > 0) {
            $slug = $slug . dechex(strtotime(now()));
        }

        $data = [
            'source_label' => $label,
            'source_link' => $link,
            'source_slug' => $slug,
            'source_active' => ($active == 'on') ? true : false,
        ];

        //Update Data
        Source::where('source_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Source Updated' //Sub Alert Message
        );

        return redirect()->route('source');
    }

    public function destroy($id)
    {
        Source::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Success', //Alert Message 
            'Source Deleted' //Sub Alert Message
        );

        return redirect()->route('source');
    }
}
