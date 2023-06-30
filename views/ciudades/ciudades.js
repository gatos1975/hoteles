//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarciudades(e);
  });
}
$().ready(() => {
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    //"../../controllers/usuario.controller.php?op=todos",
    "../../controllers/ciudades.controller.php?op=todos",
    (listaciudades) => {
      listaciudades = JSON.parse(listaciudades);
      $.each(listaciudades, (index, ciudades) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${ciudades.ciudad}</td>` +
          `<td>${ciudades.detalle}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${ciudades.idciudad})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${ciudades.idciudad})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};
var cargaSelectRoles = () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post("../../controllers/roles.controller.php?op=todos", (listaroles) => {
    listaroles = JSON.parse(listaroles);
    $.each(listaroles, (index, rol) => {
      html += `<option value="${rol.idRoles}">${rol.Detalle}</option>`;
    });
    $("#idRoles").html(html);
  });
};
var guardayeditarciudades = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idciudad = document.getElementById("idciudad").value;
  if (idciudad === undefined || idciudad === "") {
    url = "../../controllers/ciudades.controller.php?op=insertar";
  } else {
    url = "../../controllers/ciudades.controller.php?op=actualizar";
  }
  //for (var pair of form_Data.entries()) {
  // console.log(pair[0] + ", " + pair[1]);
  //}
  //var form_data = new FormData($("#usuarios_form")[0]);
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        alert("Se guardo con exito");
        limpiar();
        cargaTablaUsuarios();
      } else {
        limpiar();
        cargaTablaUsuarios();
        //alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (idciudad) => {
  $.post(
    "../../controllers/ciudades.controller.php?op=uno",
    {
      idciudad: idciudad,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#idciudad").val(res.idciudad);
      $("#ciudad").val(res.ciudad);
      $("#detalle").val(res.detalle);
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Modificar Datos";
  $("#modalUsuarios").modal("show");
  //$("#modalUsuarios").show();
  //$("#new").show();
};
var eliminar = (idciudad) => {
  if (confirm("¿Está seguro de que desea eliminar?")) {
    $.post(
      "../../controllers/ciudades.controller.php?op=eliminar",
      {
        idciudad: idciudad,
      },
      (res) => {
        res = JSON.parse(res);
        if (res === "ok") {
          alert("CIUDAD eliminado con éxito");
          limpiar();
          cargaTablaUsuarios();
          //llenarTabla();
        } else {
          alert("No se pudo eliminar el usuario");
        }
      }
    );
  }
};

var limpiar = () => {
  document.getElementById("idciudad").value = "";
  document.getElementById("ciudad").value = "";
  $("#detalle").val("");

  cargaTablaUsuarios();
  //$("#idRoles").val("0");

  //$("#modalUsuarios").modal("hide");

  $("#modalUsuarios").hide();
};
init();
