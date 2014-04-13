/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validatePass(p1, p2) {
    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
        p2.setCustomValidity('Password incorrect');
    } else {
        p2.setCustomValidity('');
    }
}

function Confirmar_ProcSusc(url)
{
    if(confirm("Realmente desea Activar las suscripción de este cliente?"))
    {
            window.location=url;
    }
}