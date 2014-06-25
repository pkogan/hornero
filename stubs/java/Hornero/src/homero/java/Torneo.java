package homero.java;

import org.json.JSONObject;


public class Torneo {
	private String host="hornero.fi.uncoma.edu.ar";
	private String tokenTorneo = "";
	private String numeroProblema = "";
	private String tokenRespuesta ="";
	private HttpURLConneccion coneccionHTTP =null; 

	public Torneo(String tokenTorneo,String numeroProblema) {
		// TODO Auto-generated constructor stub
		this.tokenTorneo = tokenTorneo;
		this.numeroProblema = numeroProblema;
		this.coneccionHTTP =  new HttpURLConneccion();

	}


	public String[] recuperarParametrosProblema(){
		String url = "http://"+this.host+"/index.php?r=juego/solicitud&token=" + this.tokenTorneo + "&problema=" + this.numeroProblema;
//	/	System.out.println(url);
		String[] rs = null;
		try {
			String respuesta = this.coneccionHTTP.sendGet(url);
			JSONObject jsonObject = new JSONObject(respuesta);
			String parametros = jsonObject.getString("parametrosEntrada");
			this.tokenRespuesta=jsonObject.getString("token");

			// System.out.println("Primer Par= " + losParametros.toString().split(",")[0] + "Seg "+losParametros.toString().split(",")[1]);
			rs = parametros.split(",");

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}	
		return rs;





	}

	public String recuperarRespuestaImplementacion(String laSolucion){
		String url = "http://"+this.host+"/index.php?r=juego/respuesta&&tokenSolicitud=" + this.tokenRespuesta + "&solucion=" + laSolucion;
		String respuesta="";
		String mensajeRta ="";
		try {
			respuesta = this.coneccionHTTP.sendGet(url);
			JSONObject jsonObject = new JSONObject(respuesta);
			mensajeRta = jsonObject.getString("mensaje");
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return mensajeRta;





	}



}
