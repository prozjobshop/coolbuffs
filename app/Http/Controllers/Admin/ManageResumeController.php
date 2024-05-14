<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManageResume;
class ManageResumeController extends Controller
{
    public function index()
    {
        $templates = ManageResume::all();
        return view('admin.manage_resume.index', compact('templates'));
    }
public function updateManageResume(Request $request)
{
    $templateTypes = $request->input('template_types');

    foreach ($templateTypes as $templateId => $type) {
        $template = ManageResume::findOrFail($templateId);
        $template->status = $request->get('template_types')[$templateId];
        $template->save();
    }

    return redirect()->route('manage.resume')->with('success','Status Changed Successfully');
}


}

