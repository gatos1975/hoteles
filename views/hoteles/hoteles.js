//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarHoteles(e);
  });
}
$().ready(() => {
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    //"../../controllers/usuario.controller.php?op=todos",
    "../../controllers/hoteles.controller.php?op=todos",
    (listahoteles) => {
      listahoteles = JSON.parse(listahoteles);
      $.each(listahoteles, (index, hoteles) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${hoteles.nombre}</td>` +
          `<td>${hoteles.ciudad}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${hoteles.idHotel})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${hoteles.idHotel})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};
var cargaSelectCiudades = () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post(
    "../../controllers/ciudades.controller.php?op=todos",
    (listaciudades) => {
      listaciudades = JSON.parse(listaciudades);
      $.each(listaciudades, (index, ciudad) => {
        html += `<option value="${ciudad.idciudad}">${ciudad.ciudad}</option>`;
      });
      $("#idciudad").html(html);
    }
  );
};
var guardayeditarHoteles = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idHotel = document.getElementById("idHotel").value;
  if (idHotel === undefined || idHotel === "") {
    url = "../../controllers/hoteles.controller.php?op=insertar";
  } else {
    url = "../../controllers/hoteles.controller.php?op=actualizar";
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

var uno = (idHotel) => {
  $.post(
    "../../controllers/hoteles.controller.php?op=uno",
    {
      idHotel: idHotel,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#idHotel").val(res.idHotel);
      $("#nombre").val(res.nombre);
      $("#ciudad").val(res.ciudad);
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Modificar Datos";
  $("#modalUsuarios").modal("show");
  //$("#modalUsuarios").show();
  //$("#new").show();
};
var eliminar = (idHotel) => {
  if (confirm("¿Está seguro de que desea eliminar?")) {
    $.post(
      "../../controllers/hoteles.controller.php?op=eliminar",
      {
        idHotel: idHotel,
      },
      (res) => {
        res = JSON.parse(res);
        if (res === "ok") {
          alert("Hotel eliminado con éxito");
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
  document.getElementById("idHotel").value = "";
  document.getElementById("nombre").value = "";
  $("#ciudad").val("");
  cargaTablaUsuarios();
  //$("#idRoles").val("0");

  //$("#modalUsuarios").modal("hide");

  $("#modalUsuarios").hide();
};
init();
