#!/usr/bin/ruby
# -*- coding: utf-8 -*-

# Copyright 2014 Giménez, Christian

# Author: Giménez, Christian   

# stub.rb

# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

require 'json'
require 'net/http'

token='eb1d954e6cfa2749f7624b0eda4a939f'
problema='1'

host='hornero.fi.uncoma.edu.ar'
url=URI("http://#{host}/index.php?r=juego/solicitud&token=#{token}&problema=#{problema}")

# Pedimos al hornero la información via HTTP...
puts "se conecta a #{url}"
res = Net::HTTP.get_response url
resp_1 = res.body if res.is_a?(Net::HTTPSuccess)

# Procesamos el JSON obtenido
datos_json = JSON.parse resp_1

# Datos útiles: 

# nombre_problema = datos["nombreProblema"]
# enunciado = datos["enunciado"]
# token = datos["token"]

parametros = datos_json["parametrosEntrada"].split(",")

#
#        ^^^^^^^^^^ ...De aquí para arriba NO TOCAR... ^^^^^^^^^^
# ____________________________________________________________________________________________________
#
# Resolver el ejercicio tomando los parámetros del array parametros en formato str
# y asingar la respuesta a la variable respuesta tambien en formato str
#

x = parametros[0].to_i
y = parametros[1].to_i

respuesta = (x+y).to_s

#
# ____________________________________________________________________________________________________
#
#        vvvvvvvvvv ...De aquí para abajo NO TOCAR... vvvvvvvvvv
#

# Enviar al hornero la respuesta...
#
# Generarmos la URL
#

url = URI("http://#{host}/index.php?r=juego/respuesta&&tokenSolicitud=#{datos_json['token']}&solucion=#{respuesta}")

puts "se conecta a #{url}"

# Enviamos la información al hornero
res = Net::HTTP.get_response url 
resp_2 = res.body if res.is_a?(Net::HTTPSuccess)

# Procesamos el JSON de la respuesta
json_2 = JSON.parse resp_2

# Datos útiles de la respuesta
#
# codigo = json_2['codigo']
# t_soli = json_2['tiempoSolicitud']
# t_resp = json_2['tiempoRespuesta']
# tiempo = json_2['tiempo']
puts json_2['status']
puts json_2['mensaje']

#                       -------------------------
#   
#                        :-) Happy Coding!!! :-)
# 
#                              ,= ,-_-. =.
#                             ((_/)o o(\_))
#                              `-'(. .)`-'
#                                  \_/
#                                    
#                       -------------------------
