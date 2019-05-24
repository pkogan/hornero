/*
 * Este es un stub de JavaScript para jugar con el Hornero hornero.fi.uncoma.edu.ar
 * Para ejecutarlo abrir desde la consola de cualquier navegador (se recomienda Firefox)
 * 
 */
/*variable gobal*/
var json;
var host='hornero.fi.uncoma.edu.ar'
/* función que envía la solicitud de parametros al servidor*/
function pideSolicitud(problema, token) {
    var xmlhttp = new XMLHttpRequest();
    url = 'http://'+host+'/index.php?r=juego/solicitud&token=' + token + '&problema=' + problema;
    console.log(url)
    xmlhttp.open('GET', url, false);
    xmlhttp.send();
    json = JSON.parse(xmlhttp.responseText);
    console.log(json);
    parametros = json.parametrosEntrada.split(',');
    return parametros;
}
function enviaRespuesta(respuesta) {
    var xmlhttp = new XMLHttpRequest();
    url = 'http://'+host+'/index.php?r=juego/respuesta&&tokenSolicitud=' + json.token + '&solucion=' + respuesta;
    console.log(url)
    xmlhttp.open('GET', url, false);
    xmlhttp.send();
    json = JSON.parse(xmlhttp.responseText);
    console.log(json);
    console.log(json.mensaje);
    return json.mensaje;
}
/*
modificar el token que le corresponde al equipo para el torneo
y el numero de Problema a Trabajar
*/

tokenTorneo = 'eb1d954e6cfa2749f7624b0eda4a939f';
numeroProblema = 1;
/*
Se piden los parametros al servidor hornero NO TOCAR!!!!*/
parametros = pideSolicitud(numeroProblema, tokenTorneo);
console.log(parametros);
/***********************
Resolver el ejercicio tomando los parámetros del array parametros
y asingar la respuesta a la variable respuesta
*/
x = parseInt(parametros[0]);
y = parseInt(parametros[1]);
respuesta = x + y;
/************************
Se envía la respuesta al servidor hornero NO TOCAR!!!!*/
console.log(String(respuesta));
alert(enviaRespuesta(String(respuesta)));
/*
undefined
*/

/*
Exception: 
@25
*/
/*
Exception: 
@24
*/