using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net;
using Newtonsoft.Json;
using System.Collections;


namespace EjemploDeUso
{

  public class solicitud {
    public string nombreProblema { get; set; }
    public string enunciado { get; set; }
    public string parametrosEntrada { get; set; }
    public string token { get; set; }
  }

  public class respuesta
  {
    public string codigo { get; set; }
    public string mensaje { get; set; }
    public string tiempoSolicitud { get; set; }
    public string tiempoRespuesta { get; set; }
    public string tiempo { get; set; }
  }

  public class ClienteRest
  {
    private static string _url = "http://hornero.fi.uncoma.edu.ar/index.php?r=juego/"; //url del servicio web    


    /* método que envía la solicitud de parametros al servidor*/
    public static solicitud pedirSolicitud(string problema, string token)
    {
      try
      {       
        string urlsolicitud = _url + "solicitud&token=" + token + "&problema=" + problema;
        System.Net.WebRequest wr = (System.Net.HttpWebRequest)System.Net.WebRequest.Create(urlsolicitud);
        wr.Method = "GET";
        wr.ContentType = "application/x-www-form-urlencoded;charset=UTF-8";
        System.IO.Stream datos;
        // Obtiene la respuesta
        System.Net.WebResponse response = wr.GetResponse();
        datos = response.GetResponseStream();       
        System.IO.StreamReader reader = new System.IO.StreamReader(datos);
        // Leemos el contenido
        string responseFromServer = reader.ReadToEnd();
        solicitud results = JsonConvert.DeserializeObject<solicitud>(responseFromServer);
              
        reader.Close();
        datos.Close();
        response.Close();
        return results;

      }
      catch (Exception ex)
      {
        return null;
      }
    }

    /* método que envía la respuesta del problema al servidor */
    public static string enviarRespuesta(string resp, string token)
    {
      try
      {
        string urlsolicitud = _url + "respuesta&&tokenSolicitud=" + token + "&solucion=" + resp;
        System.Net.WebRequest wr = (System.Net.HttpWebRequest)System.Net.WebRequest.Create(urlsolicitud);
        wr.Method = "GET";
        wr.ContentType = "application/x-www-form-urlencoded;charset=UTF-8";
        System.IO.Stream datos;
        // Obtiene la respuesta
        System.Net.WebResponse response = wr.GetResponse();
        datos = response.GetResponseStream();
        System.IO.StreamReader reader = new System.IO.StreamReader(datos);
        // Leemos el contenido
        string responseFromServer = reader.ReadToEnd();
        respuesta results = JsonConvert.DeserializeObject<respuesta>(responseFromServer);
        
        reader.Close();
        datos.Close();
        response.Close();

        return results.mensaje;

      }
      catch (Exception ex)
      {
        return ex.Message;
      }
    }

  }
}
