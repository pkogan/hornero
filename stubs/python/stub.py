# -*- coding: utf-8 -*-
from hornero import *
# proyecto para python3
# necesita la libreria python3-httplib2. Instalación en linux >sudo apt-get install python3-httplib2
# modificar el token que le corresponde al equipo para el torneo
# y el numero de Problema a Trabajar

token ='d3d2b9557a28de20132a112c7034379f'
problema = '1'
servidor= Hornero()
parametros= servidor.solicitud(token,problema)
# Se piden los parametros al servidor hornero NO TOCAR!!!!

#-------------------------------------------------------------------
#Resolver el ejercicio tomando los parámetros del array parametros en formato str
#y asingar la respuesta a la variable respuesta tambien en formato str

x= int(parametros[0])
y= int(parametros[1])

respuesta=str(x+y)

#-------------------------------------------------------------------
#Se envía la respuesta al servidor hornero NO TOCAR!!!!
servidor.envio(respuesta)
