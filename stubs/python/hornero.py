# -*- coding: utf-8 -*-
import httplib2
import json

# modificar el token que le corresponde al equipo para el torneo
# y el numero de Problema a Trabajar

class Hornero():
  def __init__(self):
    self.tokenSolicitud=''
    self.host='hornero.fi.uncoma.edu.ar'
    
  def solicitud(self,token,problema):

    # Se piden los parametros al servidor hornero NO TOCAR!!!!
    
    url = 'http://'+self.host+'/index.php?r=juego/solicitud&token=' + token + '&problema=' + problema;
    print('se conecta a ', url)
    h = httplib2.Http()
    resp, content = h.request(url)
    print(content.decode('utf-8'))
    jsonSolicitud = json.loads(content.decode('utf-8'))
    print(resp['status'])
    print(jsonSolicitud['parametrosEntrada'])
    parametros=jsonSolicitud['parametrosEntrada'].split(',')
    self.tokenSolicitud=jsonSolicitud['token']
    return parametros

#-------------------------------------------------------------------
#Se envía la respuesta al servidor hornero NO TOCAR!!!!

  def envio(self,respuesta):
    url = 'http://'+self.host+'/index.php?r=juego/respuesta&&tokenSolicitud=' + self.tokenSolicitud + '&solucion=' + respuesta;
    print('se conecta a ', url)
    h = httplib2.Http()
    
    resp,content = h.request(url)
    print(content)
    jsonSolicitud = json.loads(content.decode('utf-8'))
    print(resp['status'])
    print(jsonSolicitud['mensaje'])
