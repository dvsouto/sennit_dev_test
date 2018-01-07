/**
 * Angular JS Init
 *
 * @author Davi Souto
 *         05/01/2017
 */

 var app = angular.module('app', []);
 var $http_injector = angular.injector(["ng"]).get("$http");

 //////////////////////////////////////////////////////////////////////////////////////////////

 // Constantes do header HTTP
 const JSON_TYPE = {'Content-Type': 'application/json'};
 const FORM_TYPE = {'Content-Type': 'application/x-www-form-urlencoded'};
 
 //////////////////////////////////////////////////////////////////////////////////////////////


/**
 * Converter objeto para parâmetros na requisição http
 *
 * @param Object obj
 * @return string
 */
function ObjectToParams(obj) {
    var p = [];

    for (var key in obj)
        p.push(key + '=' + encodeURIComponent(obj[key]));

    return p.join('&');
};