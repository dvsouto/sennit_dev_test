/**
 * Angular Controller - LoginController
 * Controlar o login do usuário
 *
 * @author Davi Souto
 *         05/01/2017
 */

app.controller('AppController', function($scope, $http){
    $scope.usuario = '';
    $scope.senha = '';

    /**
     * Efetuar login na aplicação
     */
    $scope.appLogin = function(){
        $("#btn-login").addClass("disabled").attr("disabled", true);

        $http({
            url:  api + "/token",
            method: "POST",
            params: {
                "usuario": $scope.usuario,
                "senha": $scope.senha
            }
        }).then(function(data){
            var data = data.data;

            if (data.status === 'success')
            {
                $scope.saveToken(data.data);
            } else if (data.status === 'error')
            {
                toastr.error(data.message);

                $("#senha-login").focus().select();
                $("#btn-login").removeClass("disabled").removeAttr("disabled");
            }

        }, function(data){
            var data = data.data;

            if (data.status === 'error')
                toastr.error(data.message);

            $("#senha-login").focus().select();
            $("#btn-login").removeClass("disabled").removeAttr("disabled");
        });
    }

    /**
     * Salvar token na sessão e redirecionar para página principal
     * @param string token
     */
    $scope.saveToken = function(token)
    {
        $http({
            url:  "/api/access/" + token,
            method: "POST"
        }).then(function(data){
            var data = data.data;

            if (data && data.status && data.status === 'success')
            {
                window.location = "/project/home";
            } else if (data === undefined || ! data.status || data.status === 'error')
            {
                toastr.error(data.message);

                $("#senha-login").focus().select();
                $("#btn-login").removeClass("disabled").removeAttr("disabled");
            }

        }, function(data){
            var data = data.data;

            if (! data || data.status === 'error')
                toastr.error("Ocorreu um erro");

            $("#senha-login").focus().select();
            $("#btn-login").removeClass("disabled").removeAttr("disabled");
        });
    }

    /**
     * Logout na aplicação
     */
    $scope.appLogout = function()
    {
        window.location = '/auth/logout';
    }

    /**
     * Sobre a aplicação
     */
    $scope.appAbout = function()
    {
        $("#about-modal").modal('show');
    }
});
/**
 * Angular Controller - NetflixController
 * Resnposável pelo acesso a API Netflix Roulette - https://reelgood.com/roulette/netflix
 *
 * @author Davi Souto
 *         07/01/2017
 */

app.controller('NetflixController', function($scope, $http){

    $scope.netflix_api = "https://api.reelgood.com/v1";

    $scope.loading = false;

    $scope.filter_avaliacao = "4";
    $scope.filter_filmes = true;
    $scope.filter_series = true;
    $scope.filter_genero = "-1";

    $scope.movie = {
        id: false,
        title: "",
        rating: 0,
        overview: "",
        img: false,
        url: false
    }

    /**
     * Efetuar login na aplicação
     */
    $scope.rollNetflix = function(){
        if ($scope.filter_filmes && $scope.filter_series) tipo = "todos";
        else if ($scope.filter_filmes) tipo = "filmes";
        else if ($scope.filter_series) tipo = "series";

        $scope.loading = true;

        $http({
            url:  api + "/netflix/roll",
            method: "GET",
            params: {
                "tipo": tipo,
                "score_minimo": $scope.filter_avaliacao,
                "genero": $scope.filter_genero
            },
            beforeSend: function (request) {
                request.setRequestHeader("Authorization", "Negotiate");
            },
            async: true,
        }).then(function(data){
            var data = data.data;

            $scope.loading = false;

            if (data.status === 'success')
            {
                data = data.data;

                if (! data)
                {
                    toastr.error("Ocorreu um erro :(");

                    return;
                }

                $scope.movie.id = data.id;
                $scope.movie.title = data.title;
                $scope.movie.rating = data.imdb_rating;
                $scope.movie.overview = data.overview;
                $scope.movie.img = data.image;
                $scope.movie.url = "";

                var availability = false;


                if (data.availability) availability = data.availability;
                else if (data.episodes) availability = Object.values(data.episodes)[0].availability;

                if (availability)
                {
                    for(var i = 0; i < availability.length; i++)
                    {
                        if (availability[i].source_name == 'netflix')
                        {
                            $scope.movie.url = availability[i].source_data.links.web;
                            break;
                        }
                    }
                }

                if ($scope.movie.overview.length > 440)
                    $scope.movie.overview = $scope.movie.overview.substr(0, 420) + "...";
            } else if (data.status === 'error')
            {
                toastr.error(data.message);
            }

        }, function(data){
            toastr.error("Ocorreu um erro na busca :(");

            $scope.loading = false;
        });
    }
});