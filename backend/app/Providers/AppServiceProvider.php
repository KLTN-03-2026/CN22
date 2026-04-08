<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        Collection::macro('toDeepArray', function () {
            return $this->map(function ($value) {
                // Nếu là Collection → gọi đệ quy
                if ($value instanceof Collection) {
                    return $value->toDeepArray();
                }

                // Nếu là Eloquent Model hoặc object có toArray()
                if (is_object($value) && method_exists($value, 'toArray')) {
                    return $value->toArray();
                }

                // Nếu là array → wrap thành Collection rồi gọi đệ quy
                if (is_array($value)) {
                    return collect($value)->toDeepArray();
                }

                // Giá trị thường (string, int, bool, null...)
                return $value;
            })->all();   // <-- .all() rất quan trọng
        });
    }
}
