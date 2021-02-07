<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    public function index()
    {
        $labels = Label::orderBy('created_at', 'desc')->paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|unique:App\Models\Label,name',
        ]);

        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->route('labels.create')->withInput();
        }

        $label = new Label([
            'name' => $request->get('name'),
        ]);
        $label->save();

        flash(__('flash.label.store.success'))->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'min:4',
                Rule::unique('labels')->ignore($label),
            ],
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->route('labels.edit', $label)->withInput();
        }

        $label->fill(['name' => $request->get('name')]);
        $label->save();

        flash(__('flash.label.update.success'))->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks->count() > 0) {
            flash(__('flash.label.destroy.error'))->error();
        } else {
            $label->tasks()->detach();
            $label->delete();
            flash(__('flash.label.destroy.success'))->success();
        }
        return redirect()->route('labels.index');
    }
}
