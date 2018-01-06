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
            method: "PUT",
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