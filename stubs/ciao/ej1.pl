#Para ejecutar generar el ejecutable Eje1 y desde la consola en la carepeta
#donde se guardaron los archvivos hacer lo siguiente:
#En el caso de linux
#- compilar el wrapper >gcc hornero.c -o hornero
#En el caso de windows utilizar el wrapper hornero.exe
#- compilar el Eje1.pl >ciaoc Eje1.pl
#- ejecutar el wrapper >./hornero 'numeroProblema' 'token' ciao Eje1
#Donde 'numeroProblma' es el numero de problema a resolver del torneo
#'token' es la clave que nos identifica como jugadores para ese torneo.
#Para obtener el token:
#- ir al sitio hornero.fi.uncoma.edu.ar
#- loguearse
#- inscribirse al torneo
#- copiar el token que nos muestra la inscripción.
#Para resolver los siguientes ejercicios generar otro programa Ej2.pl 
#y ejecutarlos de igual forma que el anterior modificando el número de Problema,
# el nombre del ejecutable pero el token dejar el mismo.

main(Argv) :-
	suma(Argv,R),
	write(R).
suma([],0).
suma([Arg|Args],S) :-
	suma(Args,R),
	atom_number(Arg,N),
	S is R+N.
	

