<h2><i class="fa fa-film" aria-hidden="true"></i> Netflix Roulette</h2>

<div class="row row-netflix" ng-cloak>
    <div class="col-md-5">
        <div class="box-filter">
            <div class="row">
                <label for="filter-genero">Genero</label>
            </div>

            <div class="row row-space">
                <select name="filter-genero" id="filter-genero" ng-model="filter_genero" class="form-control">
                    <option value="-1" selected>Todos</option>
                    <option value="5">Action &amp; Adventure</option>
                    <option value="6">Animation</option>
                    <option value="39">Anime</option>
                    <option value="7">Biography</option>
                    <option value="8">Children</option>
                    <option value="9">Comedy</option>
                    <option value="10">Crime</option>
                    <option value="41">Cult</option>
                    <option value="11">Documentary</option>
                    <option value="12">Drama</option>
                    <option value="11">Family</option>
                    <option value="13">Fantasy</option>
                    <option value="15">Food</option>
                    <option value="16">Game Show</option>
                    <option value="37">Gay &amp; Lesbian</option>
                    <option value="17">History</option>
                    <option value="19">Horror</option>
                    <option value="18">Home &amp; Garden</option>
                    <option value="43">Independent</option>
                    <option value="22">Musical</option>
                    <option value="23">Mystery</option>
                    <option value="25">Reality</option>
                    <option value="4">Romance</option>
                    <option value="26">Science-Fiction</option>
                    <option value="29">Sport</option>
                    <option value="45">Stand-up &amp; Talk</option>
                    <option value="32">Thriller</option>
                    <option value="33">Travel</option>
                </select>
            </div>

            <div class="row">
                <label for="">Tipo</label>
            </div>

            <div class="row row-space">
                <input type="checkbox" id="cb-filter-filmes" name="cb-filter-filmes" ng-model="filter_filmes" checked />
                <label for="cb-filter-filmes">Filmes</label>

                <input type="checkbox" id="cb-filter-series" name="cb-filter-series" ng-model="filter_series" checked />
                <label for="cb-filter-series">Séries</label>
            </div>

            <div class="row">
                <label for="filter-avaliacao">Avaliação</label>
            </div>
            
            <div class="row row-space">
                <select name="filter-avaliacao" id="filter-avaliacao" ng-model="filter_avaliacao" class="form-control">
                    <option value="9">&gt; 9</option>
                    <option value="8">&gt; 8</option>
                    <option value="7">&gt; 7</option>
                    <option value="6">&gt; 6</option>
                    <option value="5">&gt; 5</option>
                    <option value="4" selected>Todas</option>
                </select>
            </div>

            <div class="row">
                <button id="btn-roll" class="btn btn-lg btn-success" ng-click="rollNetflix()" ng-disabled="loading || (! filter_filmes && ! filter_series)">
                    <i class="fa fa-search" aria-hidden="true"></i> Buscar
                </button>
            </div>
        </div>

    </div>

    <div class="col-md-7">
        <div class="netflix-block" ng-if="movie.id">
            <div class="img-block">
                <img ng-src="@{{ movie.img }}" alt="" class="img-netflix">
            </div>

            <div class="netflix-data-block">
                <h3 class="movie-title">
                    <i class="fa fa-film" aria-hidden="true"></i> @{{ movie.title }}
                    {{-- <div class="float-right">Rank</div> --}}
                </h3>

                <div class="movie-imdb-rank">
                    <strong><i class="fa fa-star-o" aria-hidden="true"></i> IMDB Rank:</strong> @{{ movie.rating }}
                </div>

                <div class="movie-overview">
                    <p>
                        @{{ movie.overview }}
                    </p>
                </div>

            </div>

            <a id="movie-link" href="@{{ movie.url }}" target="_blank" class="btn btn-lg btn-danger">
                <i class="fa fa-eye" aria-hidden="true"></i> Ver na Netflix
            </a>

        </div>

        <div class="div-loading" ng-show="loading"></div>
    </div>
</div>