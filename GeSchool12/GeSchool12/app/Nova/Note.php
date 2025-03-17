<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Note extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Note>
     */
    public static $model = \App\Models\Note::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'note'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Etudiant', 'etudiant', Etudiant::class)
                ->displayUsing(function ($etudiant) {
                    return $etudiant->name; // Remplace 'name' par le champ que tu veux récupérer (s'il s'appelle différemment)
                }),


            BelongsTo::make('Matiere', 'matiere', Matiere::class)
                ->displayUsing(function ($matiere) {
                    return $matiere->name; // Remplace 'name' par le champ que tu veux récupérer (s'il s'appelle différemment)
                }),


            Number::make('Note')
                ->sortable()
                ->rules('required', 'min:0', 'max:20')
                ->step(0.01), // Permet d'accepter des valeurs avec des décimales
        ];
    }

    /**
     * Get the cards available for the resource.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
