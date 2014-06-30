;;; stub.el --- 

;; Copyright 2014 Giménez, Christian
;;
;; Author: Giménez, Christian
;; Version: $Id: stub.el,v 0.0 2014/06/12 00:46:49 christian Exp $
;; Keywords: 
;; X-URL: not distributed yet

;; This program is free software: you can redistribute it and/or modify
;; it under the terms of the GNU General Public License as published by
;; the Free Software Foundation, either version 3 of the License, or
;; (at your option) any later version.

;; This program is distributed in the hope that it will be useful,
;; but WITHOUT ANY WARRANTY; without even the implied warranty of
;; MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
;; GNU General Public License for more details.

;; You should have received a copy of the GNU General Public License
;; along with this program.  If not, see <http://www.gnu.org/licenses/>.


;;; Commentary:
;;
;; Se abreviará "hornero" como "ho", así `ho-url' será interpretado como `hornero-url'.
;; 
;; Para usarse debe programarse la función `ho-mi-funcion'. El resultado de la misma será enviado al hornero.
;; Luego, deberá ejecutar M-x hornero para recibir y enviar los datos. Véase la función interactiva `hornero'.
;;
;; Variables importantes: M-x customize-group hornero
;; 


;; 

;; Put this file into your load-path and the following into your ~/.emacs:
;;   (require 'stub)

;;; Code:

(provide 'stub)
(eval-when-compile
  (require 'cl))

(require 'url)
(require 'json)

(defgroup hornero nil
  "Proyecto Hornero de la Universidad Nacional del Comahue.

Debe editar las variables `ho-token' y `ho-problema' antes de empezar."
  :group 'applications
  :link '(url-link "http://hornero.fi.uncoma.edu.ar")
  :tag "Hornero"
  )  

(defcustom ho-token "eb1d954e6cfa2749f7624b0eda4a939f"
  "Token brindado al registrar el grupo en Hornero."
  :group 'hornero
  :link '(url-link "http://hornero.fi.uncoma.edu.ar")
  :type '(string)
  )
(defcustom ho-problema 1
  "Número del problema a trabajar.

* Se puede escribir `setq' previo a la definición de la función en un archivo aparte y luego evaluar todo con `load-library' o `eval-buffer'... ó...
* Se puede escribir la implementación de la función aparte, evaluarla y usar `hornero-num-prob' para indicar el número.
"
  :group 'hornero
  :link '(url-link "http://hornero.fi.uncoma.edu.ar")
  :type '(integer)
  )
(defcustom ho-respuesta ""
  "Variable que deberá contener la respuesta a enviarse al hornero.

Debe contener un string con las respuestas separadas por comas. Puede ser customizado o simplemente asignado cual si fuera una variable."
  :group 'hornero
  :link '(url-link "http://hornero.fi.uncoma.edu.ar")
  :type '(string)
  )

					; ____________________
					;
					; API

(defun hornero ()
  "Ejecutar todo:

1.- Buscar en el servidor (el hornero) los parámetros necesarios.
2.- Ejecutar el código del usuario.
3.- Enviar al hornero las respuestas.
"
  (interactive)
  (ho-obtener-enunciado)
  )

(defun hornero-num-prob (num)
  "Ejecutar todo como `hornero' pero pedir el número del problema (Se asignará a `ho-problema' el número dado)."
  (interactive "n¿Número del problema?")

  (setq ho-problema num)
  (hornero)
  
  )
					; ____________________


(defvar ho-token-respuesta nil
  "Token usado para enviar la respuesta."  
  )


(defvar ho-host "hornero.fi.uncoma.edu.ar"
  "El nombre del host hornero de dónde obtener el resultado y enviar la respuesta."
  )

					; ____________________
					;
					; URLs

(defun ho-url-solicitud ()
  "Retornar la URL del enunciado y los parámetors del problema."
  (concat "http://" ho-host "/index.php?r=juego/solicitud&token=" 
	  (url-hexify-string ho-token)
	  "&problema=" 
	  (url-hexify-string (number-to-string ho-problema))
	  )
  )

(defun ho-url-respuesta ()
  "Retornar la URL para enviar la respuesta."
  (concat "http://" ho-host "/index.php?r=juego/respuesta&&tokenSolicitud=" 
	  (url-hexify-string ho-token-respuesta) 
	  "&solucion="
	  (url-hexify-string (cond
			      ((stringp ho-respuesta) 
			       ho-respuesta)
			      ((numberp ho-respuesta) 
			       (number-to-string ho-respuesta))
			      )
			     )
	  )
  )

					; ____________________

(defvar ho-solicitud-datos ""
  "Un string con el json obtenido de la solicitud del enunciado desde el hornero.
Esta variable la pueden usar para chequear alguna otra información más, sin embargo se recomienda las siguientes variables:

* `ho-enunciado'
* `ho-parametros'

Y la función:

* `json-read'

"
  )



(defvar ho-enunciado ""
  "Enunciado obtenido desde el hornero."
  )

(defvar ho-nombre-problema ""
  "Nombre del problema."
  )

(defvar ho-parametros nil
  "Una lista de parámetros que el usuario deberá utilizar para obtener la respuesta."
  )

(defun ho-separar-params (str-params)
  "Generar una lista de parámetros obtenido desde STR-PARAMS (un string).

El formato de los parámetros viene dado por una secuencia de números separado por comas."
  
  (mapcar (lambda (str)
	     "Traducir STR desde string a número."
	     (string-to-number str)
	     )
	   (split-string str-params ",")
	   )
  )

(defun ho-json-obtener-params (json-str)
  "Retornar un string con sólo los parámetros necesarios.

JSON-STR es un string con datos en formato JSON."

  (let ((lst-json (json-read json-str))
	)
    (cdr (assoc 'parametrosEntrada lst-json))
    ;; Otros parámetros interesantes son:
    ;;
    ;; (cdr (assoc 'token lst-json))
    )  
)

(defun ho-json-procesar-solicitud (json-str)
  "Proceso el string JSON-STR cual si tuviese el formato JSON, obteniendo y asignando las variables:

* Token de respuesta: `ho-token-respuesta'
* Parámetros de entrada: `ho-parametros'
"
  (let ((lst-json (json-read-from-string json-str))
	)
    
    (setq ho-parametros (ho-separar-params
			 (cdr (assoc 'parametrosEntrada lst-json))))
    (setq ho-token-respuesta (cdr (assoc 'token lst-json)))
    (setq ho-enunciado (cdr (assoc 'enunciado lst-json)))
    (setq ho-nombre-problema (cdr (assoc 'nombreProblema lst-json)))
    
    )
  )

(defun ho-obtener-enunciado ()
  "Buscar en el hornero el enunciado y los parámetros del ejercicio.

Luego, al terminar el HTTP request ejecutar el callback `ho-enunciado-obtenido-cb'."
  (let ((url-request-method "GET")
	)
    (message "Buscando parámetros en el hornero... Espere un momento.")
    (url-retrieve (ho-url-solicitud) 'ho-enunciado-obtenido-cb) ;; ¡Es asíncrono!
    )			 
  )

(defun ho-http-body ()
  "Del buffer actual obtener cuerpo del HTTP."
  (goto-char (point-min))
  (buffer-substring (search-forward "\n\n" nil t) (point-max))
  )

(defconst ho-buffer-name "Hornero"
  "Nombre del buffer que muestra los resultados de cada petición.")

(defun ho-enunciado-obtenido-cb (status)
  "Obtener el enuunciado y pasarlo a un string.

Si el estado de respuesta STATUS no es 200 (o sea hay un error) se muestra el buffer y se emite un error."
  (if (or (null status)
	  (equal status 200))
      (progn 
	;; Ignoramos todo el encabezado HTTP.
	(setq ho-solicitud-datos (ho-http-body))
	
	(with-current-buffer (get-buffer-create ho-buffer-name)	
	  ;; Procesamos el string (que supuestamente es un JSON)
	  (ho-json-procesar-solicitud ho-solicitud-datos)
	  
	  ;; Escribir la solicitud
	  (ho-escribir-enunciado)
	  (switch-to-buffer (current-buffer))
	  
	  (ho-procesar-parametros)
	  )
	)
    (progn
      (switch-to-buffer (current-buffer))
      (error "No se pudo obtener el enunciado desde el hornero. Aquí puede verse lo que se obtuvo desde el servidor.")
      )
    )
  )

(defun ho-escribir-enunciado ()
  "Escribir el enunciado y los datos obtenidos desde el servidor en el buffer actual."
  (insert "\nNombre del Problema: \n")
  (insert ho-nombre-problema)
  (insert "Enunciado: \n")
  (insert ho-enunciado)
  (insert "Parámetros: \n")
  (dolist (e ho-parametros)
    (insert 
     (cond 
      ((numberp e) (number-to-string e))
      ((stringp e) e)
      )
     " ")
    )
  (insert "\n--------------------\n")
  )

(defun ho-procesar-parametros ()
  "Llamar a la función del equipo y luego ejecutar la función adecuada para enviar la respuesta de vuelta al servidor."
  (ho-enviar-resps
   (progn 
     (setq ho-respuesta (ho-mi-funcion ho-parametros))	  
     (cond 
      ((stringp ho-respuesta) ho-respuesta)
      ((numberp ho-respuesta) (setq ho-respuesta (number-to-string ho-respuesta)))
      )
     )
   )
  )

					; ____________________
					;
					; Enviar Respuesta

(defun ho-enviar-resps (str-resps)
  "Enviar al hornero la respuesta STR-RESP."
  (with-current-buffer (get-buffer-create ho-buffer-name)
    (goto-char (point-max))
    (insert "\nEnviando respuesta:" ho-respuesta)
    )
  (let ((url-request-method "GET")
	)

    (message "Enviando resultados... Espere un momento.")
    (url-retrieve (ho-url-respuesta) 'ho-resp-procesar-cb) ;; ¡Es asíncrono!
    )
  )

(defvar ho-respuesta-datos ""
  "Un String con el JSON obtenido desde el hornero después de enviar los resultados del equipo.
Puede ser procesada por medio de `json-read'."
  )

(defun ho-resp-procesar-cb (status)
  "Callback para `ho-enviar-resps'. 
Procesar la respuesta y notificar al usuario si respondió bien o no."
  (if (or (null status)
	  (equal status 200))
      (progn
	(setq ho-respuesta-datos (ho-http-body))
	(let ((resp (ho-json-procesar-resp ho-respuesta-datos)))
	  (with-current-buffer (get-buffer-create ho-buffer-name)
	    (goto-char (point-max))
	    (insert "\n" (current-time-string))  
	    (insert "\nEl Hornero respondió lo siguiente:\n")
	    (insert (number-to-string (car resp)) ": " )
	    (insert (cadr resp) "\n")
	    (insert "\n--------------------\n")
	    (switch-to-buffer (current-buffer))
	    )
	  )
       )
    (progn
      (switch-to-buffer (current-buffer))
      (error "No se pudo obtener la respuesta desde el hornero. Aquí puede verse lo que se obtuvo desde el servidor.")
      )
    )	  
  )

(defun ho-json-procesar-resp (json-str)
  "Procesar la respuesta del resultado enviado. JSON-STR es un string con formato JSON.
Retornaré una dupla 

    (status message)

"
  (let ((lst-json (json-read-from-string json-str))
	)
    (if (equal (caar lst-json) 'error)
	(list -1 (cdar lst-json))
      (list (cdr (assoc 'codigo lst-json))
	    (cdr (assoc 'mensaje lst-json))
	    )
      )
    )  
  )


					;  ^^^^ De aquí hacia arriba NO TOCAR ^^^^
;; 
;; ____________________________________________________________________________________________________
;;

(defun ho-mi-funcion (parametros)
  "Aquí deberán programar la solución al problema.

Asegúrense de setear adecuadamente `ho-token' y `ho-problema' con el token y el número del problema indicado. Pueden customizar esas variables o asignarles sus valores usando `setq'.

El parámetro de la función PARAMETROS contendrá una lista de números que deberán usar en el ejercicio.

			(-: ¡Happy Coding! :-)
			     ,= ,-_-. =.
			    ((_/)o o(\_))
			     `-'(. .)`-'
				 \_/

"

  ;; ¡¡¡Vamos equipo!!! :-P
  
  (apply '+ parametros)
  )

;;; stub.el ends here
