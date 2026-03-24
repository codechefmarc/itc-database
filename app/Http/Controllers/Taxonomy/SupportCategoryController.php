<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Models\SupportCategory;
use Illuminate\Http\Request;

/**
 * Handles support category requests.
 */
class SupportCategoryController extends Controller {

  /**
   * Shows all support categories.
   */
  public function index() {
    $supportCategories = SupportCategory::orderBy('weight', 'asc')->get();
    return view('taxonomy.support-category.index', compact('supportCategories'));
  }

  public function create() {
    $returnUrl = url()->previous();
    return view('taxonomy.support-category.form', [
      'returnUrl' => $returnUrl,
    ]);
  }

  public function store(Request $request) {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'weight' => 'required|integer',
    ]);

    SupportCategory::create($validated);

    return redirect()->to(route('taxonomy.support_category.index'))->with('success', 'Support category created successfully.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SupportCategory $supportCategory) {
    $returnUrl = url()->previous();
    $supportCategory = $supportCategory->loadCount('walkInLogs');
    return view('taxonomy.support-category.form', [
      'supportCategory' => $supportCategory,
      'returnUrl' => $returnUrl,
    ]);
  }

  public function update(Request $request, SupportCategory $supportCategory) {

    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'weight' => 'required|integer',
    ]);

    $supportCategory->update($validated);

    return redirect()->to(route('taxonomy.support_category.index'))->with('success', 'Support category updated successfully.');
  }

  public function reorder(Request $request) {
    $validated = $request->validate([
      'order' => 'required|array',
      'order.*' => 'integer|exists:support_categories,id',
    ]);

    foreach ($validated['order'] as $index => $id) {
      SupportCategory::where('id', $id)->update(['weight' => ($index + 1) * 10]);
    }

    return response()->json(['success' => TRUE]);
  }

  /**
   * Delete a category. Only allowed if no walk-ins are assigned to it.
   */
  public function destroy(SupportCategory $supportCategory) {
    if ($supportCategory->walkInLogs()->exists()) {
      return redirect()->route('taxonomy.support_category.index')
        ->with('error', 'Cannot delete a support category that has walk-in\'s assigned to it.');
    }

    $supportCategory->delete();

    return redirect()->route('taxonomy.support_category.index')
      ->with('success', 'Support category deleted.');
  }

}
