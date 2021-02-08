<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Redirect with flash message
     * @param string $status "success", "error"
     * @param string $action "created", "updated", "deleted"
     * @param string $route
     * @param int|Model|null $resource
     * @param null $tab
     * @return RedirectResponse
     */
    protected function redirectWithFlashMessage(string $status, string $action, string $route, $resource = null, $tab = null): RedirectResponse
    {
        session()->flash($status, trans("messages.$status.$action"));
        session()->flash("title", trans("messages.title.$action"));
        return $tab == null
            ? redirect($route)
            : redirect("$route?tab=$tab");
    }

    /**
     * Redirect back with flash inputs
     * @param boolean $includeInputs Whether to include previous inputs to session flash
     * @return RedirectResponse
     */
    protected function redirectBackDueToError($includeInputs = false): RedirectResponse
    {
        session()->flash("error", trans(trans("messages.error.title")));
        return redirect()->back()->withInput($includeInputs ? request()->all() : null);
    }


    /**
     * Redirect back with flash message status
     * @param string $status "success", "error"
     * @param string $action "created", "updated", "deleted"
     * @param null $prefix
     * @return RedirectResponse
     */
    protected function redirectBackWithStatus($status, $action, $prefix = null): RedirectResponse
    {
        // Redirect to indicated previous url
        if (request()->has('previousUrl') && request()->previousUrl)
            return redirect(request()->previousUrl . '#' . request()->hash);

        if ($prefix == null)
            $prefix = $status;

        session()->flash($status, trans("messages.$prefix.$action"));
        session()->flash("title", trans("messages.title.$action"));
        return redirect()->back();
    }

    /**
     * @param array $results Must be an array with fields 'id' and 'text'
     * @return JsonResponse
     */
    protected function jsonResponseForSelect2($results = []): JsonResponse
    {
        return response()->json([
            'results' => $results
        ]);
    }
}
