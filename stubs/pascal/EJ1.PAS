program Ej1( output );
{
Para ejecutar generar el ejecutable Ej1.exe y desde la consola en la carepeta
donde se guardaron los archvivos hacer lo siguiente:
hornero.exe 'numeroProblema' 'token' pascal Ej1.exe
Donde 'numeroProblma' es el numero de problema a resolver del torneo
'token' es la clave que nos identifica como jugadores para ese torneo.
Para obtener el token:
- ir al sitio hornero.fi.uncoma.edu.ar
- loguearse
- inscribirse al torneo
- copiar el token que nos muestra la inscripci¢n.

Para resolver los siguientes ejercicios generar otro programa Ej2.pas Ej2.exe
y ejecutarlos de igual forma que el anterior modificando el n£mero de Problema,
el nombre del .exe pero el token dejar el mismo.

}
var respuesta,x,y,error:integer;
procedure definirVariable(numero:integer;var x:integer);
begin
    Val(ParamStr(numero),x,error);
    if not(error=0) then
    begin
         writeln('Error en primer parametro');
         halt(1);
    end;

end;


begin
    definirVariable(1,x);
    definirVariable(2,y);

    respuesta:=x+y;

    write(respuesta);
end.