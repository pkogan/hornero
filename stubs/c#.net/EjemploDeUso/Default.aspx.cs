using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace EjemploDeUso
{
  public partial class _Default : System.Web.UI.Page
  {
    protected void Page_Load(object sender, EventArgs e)
    {
      /*
      modificar el token que le corresponde al equipo para el torneo
      y el numero de Problema a Trabajar
      */
      string _problema = "1";
      string _token = "eb1d954e6cfa2749f7624b0eda4a939f";

      /* Se piden los parametros al servidor hornero */
      solicitud sol = ClienteRest.pedirSolicitud(_problema, _token);

      if (sol != null)
      {
        lblRespuesta.Text = "Problema: " + sol.nombreProblema;
        lblRespuesta.Text += "<br />" + sol.enunciado;
        lblRespuesta.Text += "<br /> Parámetros: " + sol.parametrosEntrada;

        string solucion = this.resolverProblema(sol);
        lblRespuesta.Text += "<br /> Respuesta a enviar: " + solucion;
        
        /************************
        Se envía la respuesta al servidor hornero */
        string mensaje = ClienteRest.enviarRespuesta(solucion, sol.token);
        lblRespuesta.Text += "<br /> Respuesta del servidor hornero: " + mensaje;
        
      }
      else
      {
        lblRespuesta.Text = "Error al pedir la Solicitud";
      } 
    }

    private string resolverProblema(solicitud sol)
    {
      /***********************
        Resolver el ejercicio tomando los parámetros del array parametros
        y asingar la respuesta a la variable respuesta
        */
      string[] parametros = sol.parametrosEntrada.Split(',');
      int x = Convert.ToInt32(parametros[0]);
      int y = Convert.ToInt32(parametros[1]);
      int respuesta = x + y;

      return respuesta.ToString();     
     

    }





  }
}
