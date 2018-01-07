/**
 * Main Script
 * Funções principais da aplicação
 *
 * @author Davi Souto - 04/01/2018
 */

/**
 * Logout na aplicação
 */
function appLogout()
{
    window.location = '/auth/logout';
}

/**
 * Sobre a aplicação
 */
function appAbout()
{
    $("#about-modal").modal('show');
}