<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WidgetPages;
use App\Models\Widgets;
use App\Models\WidgetsData;
use Str;

class WidgetDataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }*/

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = '')
    {
        $data = array();
        $data['page'] = WidgetPages::where('slug', $slug)->firstOrFail();
        $data['widgets'] = Widgets::where('widget_page_id',$data['page']->id)->get();
        return view('admin.widgets_data.index')->with($data);
    }


    public function store(Request $request,$id)
    {
        $widget_id = $id;
        $widget = Widgets::findorFail($widget_id);
        if($is_data = WidgetsData::where('widget_id',$widget_id)->first()){
            $data = WidgetsData::findorFail($is_data->id);
            $data->title = $request->title;
            $data->widget_id = $widget_id;
            $data->description = $request->description;
            $data->extra_field_1 = $request->extra_field_1;
            $data->extra_field_2 = $request->extra_field_2;
            $data->extra_field_3 = $request->extra_field_3;
            $data->extra_field_4 = $request->extra_field_4;
            $data->extra_field_5 = $request->extra_field_5;
            $data->extra_field_6 = $request->extra_field_6;
            $data->extra_field_7 = $request->extra_field_7;
            $data->extra_field_8 = $request->extra_field_8;
            $data->extra_field_9 = $request->extra_field_9;
            $data->extra_field_10 = $request->extra_field_10;
            $data->extra_field_11 = $request->extra_field_11;
            $data->extra_field_12 = $request->extra_field_12;
            $data->extra_field_13 = $request->extra_field_13;
            $data->extra_field_14 = $request->extra_field_14;
            $data->extra_field_15 = $request->extra_field_15;
            $data->extra_field_16 = $request->extra_field_16;
            $data->extra_field_17 = $request->extra_field_17;
            $data->extra_field_18 = $request->extra_field_18;
            $data->extra_field_19 = $request->extra_field_19;
            $data->extra_image_1 = $request->extra_image_1;
            $data->extra_image_2 = $request->extra_image_2;
			$data->radio_button_1 = $request->radio_button_1;
            $data->radio_button_2 = $request->radio_button_2;
            $data->radio_button_3 = $request->radio_button_3;
            $data->update();
        }else{
            $data = new WidgetsData();
            $data->title = $request->title;
            $data->widget_id = $widget_id;
            $data->description = $request->description;
            $data->extra_field_1 = $request->extra_field_1;
            $data->extra_field_2 = $request->extra_field_2;
            $data->extra_field_3 = $request->extra_field_3;
            $data->extra_field_4 = $request->extra_field_4;
            $data->extra_field_5 = $request->extra_field_5;
            $data->extra_field_6 = $request->extra_field_6;
            $data->extra_field_7 = $request->extra_field_7;
            $data->extra_field_8 = $request->extra_field_8;
            $data->extra_field_9 = $request->extra_field_9;
            $data->extra_field_10 = $request->extra_field_10;
            $data->extra_field_11 = $request->extra_field_11;
            $data->extra_field_12 = $request->extra_field_12;
            $data->extra_field_13 = $request->extra_field_13;
            $data->extra_field_14 = $request->extra_field_14;
            $data->extra_field_15 = $request->extra_field_15;
            $data->extra_field_16 = $request->extra_field_16;
            $data->extra_field_17 = $request->extra_field_17;
            $data->extra_field_18 = $request->extra_field_18;
            $data->extra_field_19 = $request->extra_field_19;
            $data->extra_image_1 = $request->extra_image_1;
            $data->extra_image_2 = $request->extra_image_2;
			$data->radio_button_1 = $request->radio_button_1;
            $data->radio_button_2 = $request->radio_button_2;
            $data->radio_button_3 = $request->radio_button_3;
            $data->save();
        }
        $request->session()->flash('message.added', 'success');
        $request->session()->flash('message.content', $widget->title.' has been successfully Updated!');
        return redirect(route('admin.widgets_data',$request->widget_page));
    }

    public function update(Request $request)
    {
         $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'slug.required' => 'Slug is required.',
        ]);
        $slug = $request->slug;
        //$slugs = unique_slug($slug, 'modules_data', $field = 'slug', $key = NULL, $value = NULL);
        $data = ModulesData::findorFail($request->id);
        $data->title = $request->title;
        $data->slug = $slug;
        $data->description = $request->description;
        $data->category = $request->category;

        $data->module_id = $request->module_id;





        if (null!==($request->category_ids)) {
            $data->category_ids = implode(",", $request->category_ids);
        }

        $data->extra_field_1 = $request->extra_field_1;
        $data->extra_field_2 = $request->extra_field_2;
        $data->extra_field_3 = $request->extra_field_3;
        $data->extra_field_4 = $request->extra_field_4;
        $data->extra_field_5 = $request->extra_field_5;
        $data->extra_field_6 = $request->extra_field_6;

        if (null!==($request->tags)) {
            $data->tag_ids = implode(",", $request->tags);
        }

        $data->meta = $request->meta;
        $data->meta_keywords = $request->meta_keywords;
        $data->meta_description = $request->meta_description;
        if($request->attached_file!=''){
            $data->image = $request->attached_file;
        }
       
        $data->update();

        $menu_types = Menu_types::select('title', 'id')->where('status','active')->pluck('title', 'id')->toArray();
        $post_menus = Menu::where('post_id',$data->id)->get();
        if(null!==($post_menus))
        {
           foreach ($post_menus as $key => $value) {
                $post_menu = Menu::findorFail($value->id);
                $post_menu->delete();
            } 
        }
        if(null!==($menu_types)){
            foreach($menu_types as $key => $menu_type){
                $field = 'menu_'.$key;
                if($request->$field){
                    $menu = new Menu();
                    $menu->title = $data->title;
                    $menu->slug = $data->slug;
                    $menu->menu_type_id = $key;
                    $menu->post_id = $data->id;
                    $menu->menu_is = 'internal';
                    $menu->save();
                }
            }
        }


        $request->session()->flash('message.added', 'success');
        $request->session()->flash('message.content', $request->module_term.' has been successfully Updated!');
        return redirect(route('admin.modules.data',$request->module_slug));
    }

    public function destroy($id)
    {
        $module = Modules::findOrFail($id);
        $module->delete();
        if ($module->save() == true) {
            $request->session()->flash('message.added', 'success');
            $request->session()->flash('message.content', 'A module has been successfully Deleted!');
        }
        return redirect(route('admin.modules'));
    }

    public function update_status($id = '', $current_staus = '')
    {
        if ($id == '') {
            echo 'error';
            exit;
        }
        if ($current_staus == '') {
            echo 'invalid current status provided.';
            exit;
        }
        if ($current_staus == 'active')
            $new_status = 'blocked';
        else
            $new_status = 'active';
        $module = ModulesData::findOrFail($id);
        $module->status = $new_status;
        $module->update();
        echo $new_status;
        exit;
    }
}
