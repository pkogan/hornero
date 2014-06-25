# -*- coding: utf-8 -*-
import httplib2
import json

# modificar el token que le corresponde al equipo para el torneo
# y el numero de Problema a Trabajar

token ='eb1d954e6cfa2749f7624b0eda4a939f'
problema = '1'

# Se piden los parametros al servidor hornero NO TOCAR!!!!
host='hornero.fi.uncoma.edu.ar'
url = 'http://'+host+'/index.php?r=juego/solicitud&token=' + token + '&problema=' + problema;
print 'se conecta a ', url
h = httplib2.Http()
content = h.request(url)
print content
solicitud = json.loads(json.dumps(content))
print solicitud[0]['status']
jsonSolicitud= json.loads(solicitud[1])
print jsonSolicitud['parametrosEntrada']
parametros=jsonSolicitud['parametrosEntrada'].split(',')
#-------------------------------------------------------------------
#Resolver el ejercicio tomando los parámetros del array parametros en formato str
#y asingar la respuesta a la variable respuesta tambien en formato str

x= int(parametros[0])
y= int(parametros[1])

respuesta=str(x+y)

#-------------------------------------------------------------------
#Se envía la respuesta al servidor hornero NO TOCAR!!!!
url = 'http://'+host+'/index.php?r=juego/respuesta&&tokenSolicitud=' + jsonSolicitud['token'] + '&solucion=' + respuesta;
print 'se conecta a ', url
h = httplib2.Http()
content = h.request(url)
print content
solicitud = json.loads(json.dumps(content))
print solicitud[0]['status']
jsonSolicitud= json.loads(solicitud[1])
print jsonSolicitud['mensaje']
