<?php

namespace App\Nova;

use App\Nova\Classe;

use Ramsey\Uuid\Type\Time;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class EmploiDuTemps extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\EmploiDuTemps>
     */
    public static $model = \App\Models\EmploiDuTemps::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     * 
     */
    public static function uriKey()
    {
        return 'emplois-du-temps';  // Assure-toi que c'est cohérent avec l'URL de Nova
    }

    public static $title = 'matiere';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'matiere',
        'jour',
        'salle'
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

            // Association avec l'étudiant
            BelongsTo::make('Classe', 'classe', Classe::class)
                ->displayUsing(function ($classe) {
                    return $classe->name; // Remplace 'name' par le champ que tu veux récupérer (s'il s'appelle différemment)
                }),


            // Informations sur l'emploi du temps
            Select::make('Jour')->options([
                'Lundi' => 'Lundi',
                'Mardi' => 'Mardi',
                'Mercredi' => 'Mercredi',
                'Jeudi' => 'Jeudi',
                'Vendredi' => 'Vendredi',
                'Samedi' => 'Samedi',
            ])->sortable(),

            Text::make('Heure Début', 'heure_debut')
                ->sortable()
                ->rules('required', 'date_format:H:i')
                ->default(now()->format('H:i')),  // Définit l'heure actuelle comme valeur par défaut

            Text::make('Heure Fin', 'heure_fin')
                ->sortable()
                ->rules('required', 'date_format:H:i')
                ->default(now()->addHour()->format('H:i')),  // Définit l'heure actuelle + 1 heure comme valeur par défaut

            Text::make('Matière', 'matiere')->sortable(),
            Text::make('Salle', 'salle')->sortable(),
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
