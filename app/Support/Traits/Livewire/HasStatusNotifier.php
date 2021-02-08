<?php


namespace App\Support\Traits\Livewire;


trait HasStatusNotifier
{
    /**
     * @param $action "created", "updated", "deleted"
     * @param string $status "success", "error"
     */
    public function alert($action, $status = "success")
    {
        session()->flash($status, trans("messages.$status.$action"));
        session()->flash("title", trans("messages.title.$action"));
    }

    public function toast($action, $status = "success", $text = "", $toast = true, $position = "bottom")
    {
        $this->emit("livewireToast", [
            "title" => $action != "error"
                ? trans("messages.title.$action")
                : trans("messages.error.title"),
            "text" => $text ?: trans("messages.$status.$action"),
            "status" => $action != "error" ? $status : "error",
            "toast" => $toast,
            "position" => $toast ? $position : "center"
        ]);
    }

    public function errorModal($text)
    {
        $this->emit("livewireToast", [
            "title" => trans("messages.error.title"),
            "text" => $text,
            "status" => "error",
            "toast" => false,
            "position" => "center"
        ]);
    }

    public function errorToast($text)
    {
        $this->emit("livewireToast", [
            "title" => trans("messages.error.title"),
            "text" => $text,
            "status" => "error",
            "toast" => true,
            "position" => "bottom"
        ]);
    }
}
