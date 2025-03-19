<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;



class Etudiant extends Resource
{
    /**
     * Le modèle que cette ressource représente.
     *
     * @var class-string<\App\Models\Etudiant>
     */
    public static $model = \App\Models\Etudiant::class;

    /**
     * La clé de l'URI utilisée dans Nova pour accéder à cette ressource.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'etudiants'; // Assure-toi que le nom est correct
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            BelongsTo::make('Utilisateur', 'user', User::class)->sortable(),
            Text::make('Nom', 'name'),
            Text::make('Email', 'email'),
            // Utilise 'BelongsTo' pour afficher uniquement le nom de la classe
            BelongsTo::make('Classe', 'classe', Classe::class)
                ->displayUsing(function ($classe) {
                    return $classe->name; // Remplace 'name' par le champ que tu veux récupérer (s'il s'appelle différemment)
                }),

            //Date::make('Date de naissance'),

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
