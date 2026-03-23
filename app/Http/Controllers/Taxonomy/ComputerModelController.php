<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Models\ComputerModel;
use Illuminate\Http\Request;

/**
 * Controller for ComputerModel admin pages and API endpoints.
 */
class ComputerModelController extends Controller {

  /**
   * List all computer models for the admin page.
   */
  public function index() {
    $models = ComputerModel::withCount('devices')
      ->orderBy('manufacturer')
      ->orderBy('model_name')
      ->paginate(25);

    return view('taxonomy.computer-models.index', ['models' => $models]);
  }

  /**
   * Show the form to create a new computer model.
   */
  public function create() {
    return view('taxonomy.computer-models.form');
  }

  /**
   * Store a new computer model from the admin form.
   */
  public function store(Request $request) {
    $validated = $request->validate([
      'manufacturer'  => ['required', 'string', 'max:100'],
      'model_name'    => ['required', 'string', 'max:200'],
      'release_year'  => ['nullable', 'integer', 'min:1990', 'max:' . (now()->year + 1)],
      'purchase_date' => ['nullable', 'date'],
    ]);

    $existing = ComputerModel::where('manufacturer', $validated['manufacturer'])
      ->where('model_name', $validated['model_name'])
      ->first();

    if ($existing) {
      return redirect()->back()
        ->withInput()
        ->withErrors(['model_name' => 'A model with this manufacturer and name already exists.']);
    }

    ComputerModel::create($validated);

    return redirect()->route('taxonomy.computer_models.index')
      ->with('success', 'Computer model added successfully.');
  }

  /**
   * Show the edit form for an existing computer model.
   */
  public function edit(ComputerModel $model) {
    $model->loadCount('devices');
    return view('taxonomy.computer-models.form', ['model' => $model]);
  }

  /**
   * Update an existing computer model.
   */
  public function patch(ComputerModel $model, Request $request) {
    $validated = $request->validate([
      'manufacturer'  => ['required', 'string', 'max:100'],
      'model_name'    => ['required', 'string', 'max:200'],
      'release_year'  => ['nullable', 'integer', 'min:1990', 'max:' . (now()->year + 1)],
      'purchase_date' => ['nullable', 'date'],
    ]);

    $duplicate = ComputerModel::where('manufacturer', $validated['manufacturer'])
      ->where('model_name', $validated['model_name'])
      ->where('id', '!=', $model->id)
      ->first();

    if ($duplicate) {
      return redirect()->back()
        ->withInput()
        ->withErrors(['model_name' => 'A model with this manufacturer and name already exists.']);
    }

    $model->update($validated);

    return redirect()->route('taxonomy.computer_models.index')
      ->with('success', 'Computer model updated successfully.');
  }

  /**
   * Delete a computer model. Only allowed if no devices are assigned to it.
   */
  public function delete(ComputerModel $model) {
    if ($model->devices()->exists()) {
      return redirect()->route('taxonomy.computer_models.index')
        ->with('error', 'Cannot delete a model that has devices assigned to it.');
    }

    $model->delete();

    return redirect()->route('taxonomy.computer_models.index')
      ->with('success', 'Computer model deleted.');
  }

  /**
   * Search computer models by manufacturer or model name for TomSelect.
   */
  public function search(Request $request) {
    $query = $request->get('q', '');

    $models = ComputerModel::where(function ($q) use ($query) {
      $q->where('manufacturer', 'LIKE', "%{$query}%")
        ->orWhere('model_name', 'LIKE', "%{$query}%");
    })
      ->orderBy('manufacturer')
      ->orderBy('model_name')
      ->limit(15)
      ->get();

    return response()->json(
      $models->map(fn($m) => [
        'value'         => $m->id,
        'text'          => $m->full_name,
        'manufacturer'  => $m->manufacturer,
        'model_name'    => $m->model_name,
        'release_year'  => $m->release_year,
        'purchase_date' => $m->purchase_date?->format('Y-m-d'),
      ])
    );
  }

  /**
   * Create a new computer model from the inline modal (API) for TomSelect.
   */
  public function apiStore(Request $request) {
    $validated = $request->validate([
      'manufacturer'  => ['required', 'string', 'max:100'],
      'model_name'    => ['required', 'string', 'max:200'],
      'release_year'  => ['required', 'integer', 'min:1990', 'max:' . (now()->year + 1)],
      'purchase_date' => ['nullable', 'date'],
    ]);

    $existing = ComputerModel::where('manufacturer', $validated['manufacturer'])
      ->where('model_name', $validated['model_name'])
      ->first();

    if ($existing) {
      return response()->json([
        'value'           => $existing->id,
        'text'            => $existing->full_name,
        'manufacturer'    => $existing->manufacturer,
        'model_name'      => $existing->model_name,
        'release_year'    => $existing->release_year,
        'purchase_date'   => $existing->purchase_date?->format('Y-m-d'),
        'already_existed' => TRUE,
      ], 200);
    }

    $model = ComputerModel::create($validated);

    return response()->json([
      'value'         => $model->id,
      'text'          => $model->full_name,
      'manufacturer'  => $model->manufacturer,
      'model_name'    => $model->model_name,
      'release_year'  => $model->release_year,
      'purchase_date' => $model->purchase_date?->format('Y-m-d'),
    ], 201);
  }

}
