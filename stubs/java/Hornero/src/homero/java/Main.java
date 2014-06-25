package homero.java;
/*****************************************************************************
 *  Esta es la clase que debe editar con la implementacion de su problema
 *  La implementacion de su problema debe estar en: laImplementacion
 ********************************************/


public class Main {

	public Main() {
		// TODO Auto-generated constructor stub
	}
	
	/********************************************************************************************************************
	 * Este es el metodo que tiene que implementar 
	 * En este caso los parametros son 2 y la operacion es la suman (OPERACION = 1)
	 * 
	 * *******/
	
	public  static String  laImplementacion(String[] losparametros){
		System.err.println("Los parametros obtenidos son:"+ losparametros[0]+","+losparametros[1]);
		String respuesta="";
		int solucion = Integer.parseInt(losparametros[0]) +Integer.parseInt(losparametros[1]) ;
		respuesta =String.valueOf(solucion);
		
	
			
		return respuesta;	
	}

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		// Editar!: con el valor del token 
		String elTokenTorneo = "eb1d954e6cfa2749f7624b0eda4a939f";
		
		//Editar!: con el valor del problema
		String elNumeroProblema ="1";
		
		Torneo elTorneo = new Torneo(elTokenTorneo,elNumeroProblema);

		// Se recuperan los parametros para la implementacion
		String[] losParametros  = elTorneo.recuperarParametrosProblema();
	
		
		// Se invoca a la implementacion que debe realizar para el torneo
		String resultado = Main.laImplementacion(losParametros);
		
		System.err.println("Resultado de la implementacion:"+ resultado);
		
		// La respuesta obtenida de su implementacion se envia al torneo
		String rta = elTorneo.recuperarRespuestaImplementacion(resultado);
		
		// Se visualizan los resultados de la solucion
		System.err.println("La respuesta del torneo es:"+ rta);
		
	    

	}

}
