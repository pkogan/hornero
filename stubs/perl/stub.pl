#!/usr/bin/perl5  
#librerias   
use REST::Client;  
use MIME::Base64;  
use JSON;  
use Data::Dumper;

#
#modificar el token que le corresponde al equipo para el torneo
#y el numero de Problema a Trabajar

$token='eb1d954e6cfa2749f7624b0eda4a939f';
$problema=1;


#Se piden los parametros al servidor hornero NO TOCAR!!!!*/
$host='hornero.fi.uncoma.edu.ar';

# Host  
  
print "$host \n";
  
# Establece la conexion  
my $cliente = REST::Client->new( );  
  
$cliente->setHost( "http://$host" );  
  
# Realiza un HTTP GET en la URI  
$cliente->GET("http://". $host."/index.php?r=juego/solicitud&token=".$token."&problema=".$problema);  
die $cliente->responseContent() if( $cliente->responseCode() >= 300 );  


# Decodifica la respuesta JSON   
my $datos = JSON->new->utf8->decode( $cliente->responseContent() );  
print Dumper $datos ;
print "\n";


print "Nombre del Problema= $datos->{'nombreProblema'}\n";
print "Enunciado=". $datos->{"enunciado"}."\n";
@parametros =  split( ',', $datos->{"parametrosEntrada"} );
print "Parametros Entrada x= $parametros[0]  y=$parametros[1] \n";
$tokenSolicitud= $datos->{"token"};
print "Token=".$tokenSolicitud  .  "\n";
print "\n";
#******************Desarrollar la Soución**********************

$respuesta=$parametros[0]+$parametros[1];
print "Respuesta= $respuesta \n";


#*******************************************************************
#Se envía la respuesta al servidor hornero NO TOCAR!!!!*/
$urlrespuesta= $host."/index.php?r=juego/respuesta&tokenSolicitud=".$tokenSolicitud."&solucion=".$respuesta;  
$cliente->GET($urlrespuesta);
print "$urlrespuesta\n" ;  
die $cliente->responseContent() if( $cliente->responseCode() >= 300 );  

# Decodifica la respuesta JSON   
my $datos = JSON->new->utf8->decode( $cliente->responseContent() );  
print Dumper $datos ;
print "\n";


