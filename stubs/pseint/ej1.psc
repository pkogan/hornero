//Para enviar las respuestas al hornero:
//1- Guardar el archivo con la resolución en la carpeta donde está instalado PSeInt.
// comunmente en la carpeta C:/Archivos de Programa/PSeInt.
// Los nombres de ejercicios no deben tener espacios
//2- Ejecutar desde consola con wrapper hornero
//*****************************************************
//En Windows:
//3- Copiar archivo hornero.exe (wrapper) en la carpeta donde esta instalado PSeInt,
//comunmente en la carpeta C:/Archivos de Programa/PSeInt.
//4- Abrir la consola cmd
//5- Ubicarse en la carpeta donde esta insalado PSeInt y ejecutar:
//>hornero.exe "numeroProblema" "token" pseintwin "archivo.psc"
//"numeroProblema" es el numero de problema a resolver del torneo
//"token" es la clave que nos identifica como jugadores para ese torneo.
//"archivo.psc" ruta a donde se guardó el archivo por ejemplo c:/ejercicios/ej1.psc
//o solo el nómbre del archivo si se está trabajando en la misma carpeta


//*****************************************************
//En linux:
//3- Compilar el wrapper >gcc hornero.c -o hornero
//4- Copiar archivo compilado hornero (wrapper) en la carpeta donde esta instalado PSeInt
//5- Abrir la terminal
//6- Ubicarse en la carpeta donde esta insalado PSeInt y ejecutar:
//>.\hornero "numeroProblema" "token" pseint "archivo.psc"
//"numeroProblema" es el numero de problema a resolver del torneo
//"token" es la clave que nos identifica como jugadores para ese torneo.
//"archivo.psc" ruta a donde se guardó el archivo por ejemplo /home/usuario/ejercicios/ej1.psc
//**********************************************

//Para obtener el token:
//		- ir al sitio hornero.fi.uncoma.edu.ar
//		- loguearse
//		- inscribirse al torneo
//		- copiar el token que nos muestra la inscripcion.
//
//Para resolver los siguientes ejercicios generar otro programa ej2.psc
//y ejecutarlos de igual forma que el anterior modificando el n�mero de Problema,
//el nombre del .psc pero el token dejar el mismo.

			
Proceso ej1
	Leer a
	Leer b
	Escribir Sin Saltar a+b
Fin Proceso