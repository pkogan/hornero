Unas consideraciones al instalar en Fedora 19:

# Configurar /etc/php.ini
Es preciso indicar la zona horaria del servidor escribiendo el valor `date.timezone`. Por ejemplo:

	date.timezone = "America/Argentina/Buenos_Aires"

# Directorios Faltantes
Es preciso crear los siguientes directorios:

* ../html/hornero/protected/runtime
* ../html/hornero/assets

# Cambiar el dueño de las carpetas

Ejecutar esto para asegurar que apache (y PHP) tendrá la posibilidad de usar el directorio de forma completa.

	cd /var/www/html
	chown -R apache hornero
	chown -R apache framework

