;; Existen dos formas de usar este stub:

;; Una es asignando el número del problema en el archivo mismo previo a la implementa la función, así:
(setq ho-problema 1)
(defun ho-mi-funcion (param)
  (apply '* param)
  )
;; Luego evaluar todo usando `eval-buffer' o `load-library' y llamando a la función interactiva M-x `hornero'.


;; Otra forma es escribir sólo la definición sin asignar `ho-problema' en el archivo, evaluar el buffer y llamar la función interactiva M-x `hornero-num-prob' que nos pedirá el número del problema.
