<?php


namespace App\Support;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


abstract class ModelWithJsonFile extends Model
{
    const IMAGE = "image";
    const VIDEO = "video";

    const MEDIA_TYPES = [
        self::IMAGE,
        self::VIDEO
    ];

    public abstract function toJsonEntry(): array;

    public abstract static function getJsonName($param): string;

    public abstract static function dataFormat(array $rows, $param): array;

    public abstract static function fetch($param): Builder;

    public static function syncJsonFile($param)
    {
        $rows = static::fetch($param)->get()->map(function (self $model) {
            return $model->toJsonEntry();
        })->toArray();

        $newJsonString = json_encode(static::dataFormat($rows, $param), JSON_PRETTY_PRINT);

        $file = static::getJsonPath($param) . "/" . static::getJsonName($param);


        Log::info($file);

        if (file_exists($file) === false)
            try {
                mkdir(dirname($file), 0777, true);
            } catch (\Exception $e) {
            }


        file_put_contents($file, stripslashes($newJsonString));
    }


    public static function getJsonPath($param): string
    {
        return storage_path("app/public/json");
    }

    public static function getJsonUrl($param): string
    {
        return url("/storage/json/" . static::getJsonName($param));
    }
}