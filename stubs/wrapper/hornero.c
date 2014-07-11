//Comentar/Descomentar segun compilacion en Linux o en Windows ---
#define __LINUX__
//#define __WINDOWS__

#include <ctype.h>
#include <stdlib.h>
#include <sys/types.h>
//--------------------------------------------------------------------
#ifdef __LINUX__
#include <sys/socket.h>
#include <netdb.h>
#include <netinet/in.h>
//#include <json/json.h>
#endif
//--------------------------------------------------------------------
#ifdef __WINDOWS__
#include <winsock2.h>
#define bzero(p, size)     (void)memset((p), 0, (size))
//#include <json/json.h> // VER COMO SE INCLUYE LA BIBLIOTECA JSON
#endif
//--------------------------------------------------------------------------

#include <unistd.h>
#include <string.h>
#include <stdio.h>

/* para compilar en linux ejecutar desde consola
> gcc hornero.c -o hornero
 luego ejecutar desde consola con 
>./hornero <numProbl> <token> <lenguaje> <prog>
 */
/*
 * para compilar en windows XP con compilador mingw
 * > gcc hornero.c -o hornero -lws2_32
 * luego ejecutar
 * >./hornero.exe <numProbl> <token> <lenguaje> <prog>
 */

int sock;
struct sockaddr_in client;
int PORT = 80;
char buffer[1024], *tokenSolicitud, *parametro[20];
int sizeBuffer=0;
int cantidadParametros=0;

int getBuffer() {
    
    bzero(buffer, sizeof(buffer));
    sizeBuffer = recv(sock, buffer, sizeof (buffer), 0);
    //buffer[sizeBuffer]='\0';
    return sizeBuffer;
}

void getResponse() {
    char cur;

    while (read(sock, &cur, 1) > 0) {
       printf("%c", cur);
    }

}


#ifdef __WINDOWS__
WSADATA wsaData;
WORD version;
int error;
#endif

void setupSocket(char* hostname) {
    
#ifdef __WINDOWS__
    version = MAKEWORD( 2, 0 );
    error = WSAStartup( version, &wsaData );
#endif
    
    struct hostent * host = gethostbyname(hostname);
    
    if ((host == NULL) || (host->h_addr == NULL)) {
        printf("Error buscando información DNS. %s",hostname);
        exit(1);
    }

    bzero(&client, sizeof(client));
    client.sin_family = AF_INET;
    client.sin_port = htons(PORT);
    memcpy(&client.sin_addr, host->h_addr, host->h_length);

    sock = socket(AF_INET, SOCK_STREAM, 0);

    if (sock < 0) {
        printf("Error creating socket.");
        exit(1);
    }
}

void connectToHost(char* hostname) {
    if (connect(sock, (struct sockaddr *) &client, sizeof (client)) < 0) {
        close(sock);
        printf("No se puede conectar al host %s", hostname);
        exit(1);
    }
}

void enviarSolicitud(char* hostname, char* token, char* problema) {
    char request[1000];
    setupSocket(hostname);
    connectToHost(hostname);
    //sprintf(request, "GET /yii/hornero/index.php?r=juego/solicitud&token=%s&problema=%s HTTP/1.1\r\nHost: %s\r\n\r\n", token, problema, hostname);
    sprintf(request, "GET /index.php?r=juego/solicitud&token=%s&problema=%s HTTP/1.1\r\nHost: %s\r\n\r\n", token, problema, hostname);
    printf("\nSe envia request Solicitud: %s", request);
    if (send(sock, request, sizeof (request), 0) != (int) sizeof (request)) {
        printf("Error enviando request.");
        exit(1);
    }
    getBuffer();

}

void enviarRespuesta(char* hostname, char* respuesta) {
    char request[1000];
    setupSocket(hostname);
    connectToHost(hostname);
    //sprintf(request, "GET /yii/hornero/index.php?r=juego/respuesta&tokenSolicitud=%s&solucion=%s HTTP/1.1\r\nHost: %s\r\n\r\n", tokenSolicitud, respuesta, hostname);
    sprintf(request, "GET /index.php?r=juego/respuesta&tokenSolicitud=%s&solucion=%s HTTP/1.1\r\nHost: %s\r\n\r\n", tokenSolicitud, respuesta, hostname);
    //http://hornero.fi.uncoma.edu.ar/index.php?r=juego/respuesta&&tokenSolicitud=76d7cadd3df99e06ae8c4aa580ca6900&solucion=-5933
    printf("\nSe envia request Respuesta: %s\n", request);
    if (send(sock, request, sizeof (request), 0) != (int) sizeof (request)) {
        printf("Error sending request.");
        exit(1);
    }
    getBuffer();
    //getResponse();
}

/*
void parserParametros(char *parametrosEntrada){
    
    const char delimiters[] = ",";
    char *token;
    printf("antes strok");
    bzero(cp,sizeof(cp));
    sprintf(cp,"%s,FIN",parametrosEntrada);
    token = strtok(cp, delimiters);
    
    while(strcmp(token,"FIN") !=0&& token!=NULL){
        printf("token:%d %s\n",cantidadParametros,token );
        parametro[cantidadParametros++]=token;
        token= strtok(NULL, delimiters);
    }
}
*/
void parser() {
    const char delimiters[] = "\"{},:";
    char *token, *cp;
    
    int i;
    //apunta al comienzo del JSON salteando paquete http
    cp = buffer+155 ; //strdupa (buffer+155);
    
    //token de FIN
    buffer[sizeBuffer++]='{';
    buffer[sizeBuffer++]='F';
    buffer[sizeBuffer++]='I';
    buffer[sizeBuffer++]='N';
    buffer[sizeBuffer++]='}';
    
    token = strtok(cp, delimiters);
    
    //printf("token:%s",token);
    while (strcmp(token, "parametrosEntrada") != 0 && strcmp(token, "error")!=0 && token!=NULL && strcmp(token, "FIN")!=0) {
        token = strtok(NULL, delimiters);
        //printf("token:%s",token);	
    }
    
    if(strcmp(token, "error")==0){
        printf("Error: %s\n",strtok(NULL, delimiters));
        exit(1);
    }
    
    if(strcmp(token, "parametrosEntrada") == 0 ){
        token = strtok(NULL, delimiters);
        while (strcmp(token, "token") != 0 && token!=NULL && strcmp(token, "FIN")!=0) {
            parametro[cantidadParametros++]=token;
            token = strtok(NULL, delimiters);
        }
        //printf("token:%s",token);	
    }
    
//    printf("parametro 1:%s",parametro[0]);
//    printf("parametro 2:%s\n",parametro[1]);	
   
    if(strcmp(token, "token") == 0)
        tokenSolicitud = strtok(NULL, delimiters);
    
    if(token==NULL||strcmp(token, "FIN")==0){
        fatal("Error en paquete recibido\n");
    }
    //printf("tokenSolicitud:%s\n", tokenSolicitud);
}

void parserRespuesta() {
    const char delimiters[] = "\"{},:";
    char *token, *cp;
    
    int i;
    //apunta al comienzo del JSON salteando paquete http
    cp = buffer+155 ; //strdupa (buffer+155);
    
    //token de FIN
    buffer[sizeBuffer++]='{';
    buffer[sizeBuffer++]='F';
    buffer[sizeBuffer++]='I';
    buffer[sizeBuffer++]='N';
    buffer[sizeBuffer++]='}';
    
    token = strtok(cp, delimiters);
    
    //printf("token:%s",token);
    while (strcmp(token, "mensaje") != 0 && strcmp(token, "error")!=0 && token!=NULL && strcmp(token, "FIN")!=0) {
        token = strtok(NULL, delimiters);
        //printf("token:%s",token);	
    }
    
    if(strcmp(token, "error")==0){
        printf("Error: %s\n",strtok(NULL, delimiters));
        exit(1);
    }
    
    if(strcmp(token, "mensaje") == 0 ){
        token = strtok(NULL, delimiters);
        printf("**********************\nRespuesta:%s\n**********************\n",token);
        //printf("token:%s",token);	
    }
    
   
    
    if(token==NULL||strcmp(token, "FIN")==0){
        fatal("Error en paquete recibido\n");
    }
}





// ------------------------------------------------------------
//   Tocado a partir de aqui
// ------------------------------------------------------------

struct resp {
        int codigo;
        char mensaje[1024];
        long tiempoSolicitud;
        long tiempoRespuesta;
        long tiempo;
};
        
struct sist {
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
        { "pseint","./pseint %s --nouser"},
        { "pseintwin","pseint %s --nouser"},
        { "exe", "%s"},
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
        char p[1024],*separador;

        sprintf(comando, sistemas[sist].comando, prog);
        
        if(sist==6||sist==7){ //pseint o pseintwin
            separador=" --input=";
        }else{
            separador=" ";
        }
        
        for(i = 0; i < cantParam; i++) {
                strcat(comando, separador);
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
        //fread(resp, 1, 1024, p);
        //se queda solo con la última linea
        //como respuesta
        while(! feof(p)) 
                fgets(resp, 1024, p);
        
        pclose(p);
}
/*                
void json2struct(char *body, struct resp *r)
{
        json_object *jobj;
        json_object *j;

        jobj = json_tokener_parse(body);     

        if(json_object_object_get_ex(jobj, "codigo", &j))
                r->codigo = json_object_get_int(j);

        if(json_object_object_get_ex(jobj, "mensaje", &j))
                strcpy(r->mensaje, json_object_get_string(j));

        if(json_object_object_get_ex(jobj, "tiempoSolicitud", &j)) 
                r->tiempoSolicitud = atol(json_object_get_string(j));
        else fatal("tiempoSolicitud");

        if(json_object_object_get_ex(jobj, "tiempoRespuesta", &j))
                r->tiempoRespuesta = json_object_get_int(j);
        else fatal("tiempoRespuesta");

        if(json_object_object_get_ex(jobj, "tiempo", &j))
                r->tiempo = json_object_get_int(j);

}

int printResp(struct resp r)
{
        printf("             Codigo: %d\n",r.codigo);
        printf("            Mensaje: %s\n",r.mensaje);
        //printf("Tiempo de Solicitud: %ld\n",r.tiempoSolicitud);
        //printf("Tiempo de Respuesta: %ld\n",r.tiempoRespuesta);
        printf("             Tiempo: %ld\n",r.tiempo);
}
        

int analizar (char *buf)
{
        char *body, *endbody;
        struct resp r;

        body = strstr(buf, "\r\n\r\n"); 
        if(body) body += 8; // aparece un numero 91 en la respuesta (?)
        endbody = strstr(body, "}");
        if(endbody) *(endbody + 1) = 0;
        //fprintf(stderr, "BODY: >%s<\n", body);

        json2struct(body, &r);
        printResp(r);
} 
*/
int main(int argc, char *argv[]) 
{
	
	char host[255]="hornero.fi.uncoma.edu.ar";
        //char host[255]="localhost";

        char *probl = argv[1];
	char *tokenTorneo = argv[2];
        char *leng = argv[3];
        char *prog = argv[4];
        int sist;

     	char respuesta[1000];
     	//char respuesta2[1000];
        char comando[1024];

        if(argc != 5) 
                fatal("Mal numero de argumentos: hornero <numProbl> <token> <lenguaje> <prog.exe>");
        if((sist = sistemaValido(leng)) < 0) 
                fatal("Lenguaje no soportado");

        // enviarSolicitud -> escribe en buffer 
	enviarSolicitud(host,tokenTorneo,probl);
        
        //fprintf(stderr, "BUFFER: >%s<\n", buffer);
        
        // parser analiza buffer y carga global parametros[]
	parser();

        // arma comando a lanzar en buffer comando
        crearComando(comando, sist, prog, cantidadParametros);

        
        fprintf(stderr,"\nCOMANDO >%s<\n", comando);

        // lanzar el comando
        
        ejecutar(comando, respuesta);

        fprintf(stderr, "RESPUESTA: >%s<\n", respuesta);
        
        enviarRespuesta(host,respuesta);
        
        //fprintf(stderr, "BUFFER: >%s<\n", buffer);
        parserRespuesta();

        
        //analizar(buffer);
	return 0;
}




