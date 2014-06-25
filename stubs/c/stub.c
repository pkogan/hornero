#include <ctype.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netdb.h>
#include <netinet/in.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>

/* para copilar en linux ejecutar desde consola
> gcc stub.cpp -o ej1
 luego ejecutar desde consola con 
>./ej1
*/

int sock;
struct sockaddr_in client;
int PORT = 80;
char buffer[10024],*tokenSolicitud, *parametro[20];
void setupSocket(char* hostname) {
	struct hostent * host = gethostbyname(hostname);

	if ( (host == NULL) || (host->h_addr == NULL) ) {
		printf("Error retrieving DNS information.");
		exit(1);
	}

	bzero(&client, sizeof(client));
	client.sin_family = AF_INET;
	client.sin_port = htons( PORT );
	memcpy(&client.sin_addr, host->h_addr, host->h_length);

	sock = socket(AF_INET, SOCK_STREAM, 0);
	
	if (sock < 0) {
		printf( "Error creating socket." );
		exit(1);
	}
}

void connectToHost(char* hostname) {
	if ( connect(sock, (struct sockaddr *)&client, sizeof(client)) < 0 ) {
		close(sock);
		printf( "Could not connect to %s", hostname );
		exit(1);
	}
}

void enviarSolicitud(char* hostname, char* token,char* problema) {
        char request[1000];
        setupSocket(hostname);
        connectToHost(hostname);
	sprintf(request,"GET /index.php?r=juego/solicitud&token=%s&problema=%s HTTP/1.1\r\nHost: %s\r\n\r\n",token,problema,hostname);
	printf("se envia request: %s", request);
	if (send(sock, request, sizeof(request), 0) != (int)sizeof(request)) {
		printf( "Error sending request." );
		exit(1);
	}
        getBuffer();
        
}
/*
>telnet hornero.fi.uncoma.edu.ar 80
GET /index.php?r=juego/solicitud&token=eb1d954e6cfa2749f7624b0eda4a939f&problema=1 HTTP/1.1   
Host: hornero.fi.uncoma.edu.ar
*/
void enviarRespuesta(char* hostname,char* respuesta) {
	char request[1000];
        setupSocket(hostname);
        connectToHost(hostname);
        sprintf(request,"GET /index.php?r=juego/respuesta&tokenSolicitud=%s&solucion=%s HTTP/1.1\r\nHost: %s\r\n\r\n",tokenSolicitud,respuesta,hostname);
	printf("se envia request: %s", request);
	if (send(sock, request, sizeof(request), 0) != (int)sizeof(request)) {
		printf( "Error sending request." );
		exit(1);
	}
        getBuffer();
}
void getResponse() {
	char cur;

	while ( read(sock, &cur, 1) > 0 ) {
		printf("%c", cur);
	}

}
int getBuffer(){
	int bytes_read;     
	bzero(buffer, sizeof(buffer));
     	bytes_read = recv(sock, buffer, sizeof(buffer), 0);
     	return bytes_read;
}

void parser(int cantidadParametros){
    const char delimiters[] = "\",{}:";
    char *token, *cp;
    int i;
    	cp = buffer+15;//strdupa (buffer+155);
	token = strtok (cp, delimiters);
	printf("token:%s",token);
	while(strcmp(token,"parametrosEntrada")!=0){	
		token = strtok (NULL, delimiters);
		printf("token:%s",token);	
	}
/* copiar esta linea por cada uno de los parámetros*/	
        for(i=0;i<cantidadParametros&&i<20;i++){
            parametro[i]=strtok (NULL, delimiters);
            printf("parametro %d:%s",i+1,parametro[i]);
        }
//	parametro[0] = strtok (NULL, delimiters);
//	parametro[1] = strtok (NULL, delimiters);

	/*printf("parametro 1:%s",parametro[0]);
	printf("parametro 2:%s/n",parametro[1]);	*/

	while(strcmp(token,"token")!=0){	
		token = strtok (NULL, delimiters);
		printf("token:%s",token);	
	}
        
	tokenSolicitud = strtok(NULL, delimiters);
	printf("tokenSolicitud:%s/n",tokenSolicitud);	
}
int main(int argc, char** argv) {
 	
	int cantidadParametros=2;
     	char respuestas[1000];
	int respuesta;
	char host[255]="hornero.fi.uncoma.edu.ar";
        /* Modificar tokenTorneo y numero de Problema*/
        
	char tokenTorneo[33]="eb1d954e6cfa2749f7624b0eda4a939f";
	char problema[3]="1";	
	enviarSolicitud(host,tokenTorneo,problema);
	parser(cantidadParametros);
/* hacer el cálculo transformando los parámetros y guardando la respuesta en el *char respuestas*/
        
	respuesta=atoi(parametro[0])+atoi(parametro[1]);
		
	sprintf(respuestas,"%d",respuesta);
        
/*****************************************************************************/        
        enviarRespuesta(host,respuestas);
        printf("Respuesta %s",buffer);
	return 0;
}

