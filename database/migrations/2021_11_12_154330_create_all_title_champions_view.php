<?php

use App\Models\TitleChampionship;
use Illuminate\Database\Migrations\Migration;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

class CreateAllTitleChampionsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::createMergeView('all_title_champions', [
            (new TitleChampionship())->wrestler(),
            (new TitleChampionship())->tagTeam(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropView('all_title_champions');
    }
}
