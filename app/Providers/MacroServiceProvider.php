<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->blueprintMacros();
    }

    protected function blueprintMacros()
    {
        if (!Blueprint::hasMacro('activitiesBy')) {
            Blueprint::macro('activitiesBy', function (bool $nullable = true, string $relatedTable = 'users', string $relatedColumn = 'id') {
                $this->unsignedBigInteger('created_by')->nullable($nullable);
                $this->unsignedBigInteger('updated_by')->nullable($nullable);
                $this->unsignedBigInteger('deleted_by')->nullable($nullable);

                $this->foreign('created_by')->references($relatedColumn)->on($relatedTable);
                $this->foreign('updated_by')->references($relatedColumn)->on($relatedTable);
                $this->foreign('deleted_by')->references($relatedColumn)->on($relatedTable);
            });
        }

        if (!Blueprint::hasMacro('dropActivitiesBy')) {
            Blueprint::macro('dropActivitiesBy', function () {
                /** @var Blueprint $this */
                $this->dropForeign(['created_by']);
                $this->dropForeign(['updated_by']);
                $this->dropForeign(['deleted_by']);

                $this->dropColumn(['updated_by', 'created_by', 'deleted_by']);
            });
        }
    }
}
