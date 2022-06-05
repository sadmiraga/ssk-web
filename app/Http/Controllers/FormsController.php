<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Form;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class FormsController extends Controller
{
    public function index()
    {
        $forms = Form::orderBy('created_at', 'desc')->get();
        return view('admin.forms.index', compact('forms'));
    }

    public function previewForm($form_id)
    {
        $form = Form::find($form_id);
        $inputs = convertToArray($form->inputs);

        return view('admin.forms.previewForm', compact('form', 'inputs'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'formName' => 'required'
        ]);

        $form = Form::create([
            'name' => $request->input('formName')
        ]);

        return redirect()->route('forms.edit', $form->id);
    }

    public function edit($formID)
    {
        $form = Form::find($formID);
        $fields = $form->inputs;
        $fields = convertToArray($fields);
        return view('admin.forms.edit', compact('formID', 'form', 'fields'));
    }



    public function storeEdit(Request $request)
    {

        $request->validate([
            'formID' => 'required',
            'inputName' => 'required',
            'inputType' => 'required',
            'description' => 'required',
        ]);

        $form = Form::find($request->input('formID'));

        $fields = $form->inputs .
            "[" . $request->input('inputName') .
            "," . $request->input('inputType') .
            "," . $request->input('description') .
            "]";

        $form->inputs = $fields;
        $form->save();

        return redirect()->back();
    }

    public function delete($formID)
    {
        $form = Form::find($formID);
        $form->delete();
        return redirect()->back();
    }
}
