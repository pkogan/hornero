#include <ctype.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netdb.h>
#include <netinet/in.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>

/* para compilar en linux ejecutar desde consola
> make hornero
 luego ejecutar desde consola con 
>./hornero <numProbl> <token> <lenguaje> <prog>
*/

int sock;
struct sockaddr_in client;
int PORT = 80;
char buffer[10240], *tokenSolicitud, *parametro[20];
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
	//printf("se envia request: %s", request);
	if (send(sock, request, sizeof(request), 0) != (int)sizeof(request)) {
		printf( "Error sending request." );
		exit(1);
	}
        getBuffer();
        
}
void enviarRespuesta(char* hostname,char* respuesta) {
	char request[1000];
        setupSocket(hostname);
        connectToHost(hostname);
        sprintf(request,"GET /index.php?r=juego/respuesta&tokenSolicitud=%s&solucion=%s HTTP/1.1\r\nHost: %s\r\n\r\n",tokenSolicitud,respuesta,hostname);
        //http://hornero.fi.uncoma.edu.ar/index.php?r=juego/respuesta&&tokenSolicitud=76d7cadd3df99e06ae8c4aa580ca6900&solucion=-5933
	printf("\nse envia request: %s\n", request);
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
	//printf("token:%s",token);
	while(strcmp(token,"parametrosEntrada")!=0){	
		token = strtok (NULL, delimiters);
		//printf("token:%s",token);	
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
		//printf("token:%s",token);	
	}
        
	tokenSolicitud = strtok(NULL, delimiters);
	printf("tokenSolicitud:%s\n",tokenSolicitud);	
}

// ------------------------------------------------------------
//   Tocado a partir de aqui
// ------------------------------------------------------------
struct {
        char *lenguaje;
        char *comando;
} sistemas[] =
{
        { "bash", "/bin/bash %s" },
        { "c", "./%s" },
        { "c++", "./%s" },
        { "python", "python %s" },
        { "java", "java %s" },
	{ "ciao", "./%s"},
        { NULL, NULL}, // dejar ultimo registro NULL como centinela
};

int listaSistemas() 
{
        int i;
        fprintf(stderr, "Sistemas validos conocidos:\n");
        for(i = 0; sistemas[i].lenguaje; i++)
                fprintf(stderr, "\t%s\n", sistemas[i].lenguaje);
}

int sistemaValido(char *s)
{       
        int i = 0;
        while(sistemas[i].lenguaje) {
                if(! strcasecmp(s, sistemas[i].lenguaje))
                        return i;
                i++;
        }
        listaSistemas();
        return -1;
}

int crearComando(char *comando, int sist, char *prog, int cantParam)
{
        int i;
        char p[1024];

        sprintf(comando, sistemas[sist].comando, prog);
        for(i = 0; i < cantParam; i++) {
                strcat(comando, " ");
                strcat(comando, parametro[i]);
        }
}

int fatal(char *m) {
        fprintf(stderr, "%s\n", m);
        exit(1);
}

int ejecutar(char *comando, char *resp)
{
        FILE *p;
        if((p = popen(comando, "r")) == NULL)
                fatal("No se pudo ejecutar el programa");
        //while(! feof(p)) // si la respuesta del prog fuera mayor que size del buffer
                fread(resp, 1, 1024, p);
        pclose(p);
}
                

/* WINDOWS: c\:>hornero <numProbl> <token> <lenguaje> <prog.exe>
   LINUX:   $ ./hornero <numProbl> <token> <lenguaje> <prog>
*/

int main(int argc, char *argv[]) 
{
	int cantidadParametros=2; // esto no va a variar?
	char host[255]="hornero.fi.uncoma.edu.ar";

        char *probl = argv[1];
	char *tokenTorneo = argv[2];
        char *leng = argv[3];
        char *prog = argv[4];
        int sist;

     	char respuesta[1000];
     	char respuesta2[1000];
        char comando[1024];

        if(argc != 5) 
                fatal("Mal numero de argumentos: hornero <numProbl> <token> <lenguaje> <prog.exe>");
        if((sist = sistemaValido(leng)) < 0) 
                fatal("Lenguaje no soportado");

        // enviarSolicitud -> escribe en buffer 
	enviarSolicitud(host,tokenTorneo,probl);

        // parser analiza buffer y carga global parametros[]
	parser(cantidadParametros);

        // arma comando a lanzar en buffer comando
        crearComando(comando, sist, prog, cantidadParametros);

        fprintf(stderr,"\nCOMANDO >%s<\n", comando);

        // lanzar el comando
        ejecutar(comando, respuesta);
        //sprintf(respuesta2, "%d", atoi(respuesta));

        fprintf(stderr, "RESPUESTA: >%s<\n", respuesta);
        enviarRespuesta(host,respuesta);

        fprintf(stderr, "BUFFER: >%s<\n", buffer);
	return 0;
}

